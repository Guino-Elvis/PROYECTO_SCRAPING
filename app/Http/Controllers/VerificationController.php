<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;
class VerificationController extends Controller
{
    public function notice()
    {
        $user = Auth::user();

        // Verificar si el usuario está autenticado y su correo ya está verificado
        if (auth()->check() && auth()->user()->email_verified_at) {
            $existingUser = User::where('email', $user['email'])->first();

            // Verifica si el usuario ya tiene un rol asociado, si no, crea uno
            if (!$existingUser->roles->count()) {
                $role = Role::where('name', 'Usuario')->first();
                if ($role) {
                    $existingUser->roles()->attach($role);
                } else {
                    // Si el rol no existe, maneja este caso de acuerdo a tus necesidades
                    // Puede ser lanzar una excepción, registrar un mensaje de error, etc.
                }
            }
            Auth::login($existingUser);
            $viewFromLR = session('fromLRV');
            if ($viewFromLR === 'login-register') {
                session()->forget('fromLR');
                session()->forget('new_user_data');
                return redirect()->route('inicio')->with('success', 'Su cuenta ha sido verificada exitosamente.');
            } else {
                session()->forget('fromLR');
                session()->forget('new_user_data');
                return redirect('/')->with('success', 'Su cuenta ha sido verificada exitosamente.');
            }
        }

        // Si el correo no está verificado o el usuario no está autenticado,
        // simplemente muestra la vista de verificación de correo electrónico
        return view('auth.verify-email');
    }

    public function verify()
    {
        $userData = session('new_user_data');
        //dd($userData);
        if (!$userData) {
            return redirect('/')->with('success', 'Su cuenta ya ha sido verificada exitosamente.');
        }
        // Buscar el usuario por su correo electrónico
        $existingUser = User::where('email', $userData['email'])->first();

        // Si el usuario ya existe, actualizarlo
        if ($existingUser) {
            $existingUser->update([
                'name' => $userData['name'],
                'names' => $userData['names'],
                'apellido_p' => $userData['apellido_p'],
                'apellido_m' => $userData['apellido_m'],
                'dni' => $userData['dni'],
                'direccion' => $userData['direccion'],
                'telefono' => $userData['telefono'],
                'password' => $userData['password'],
                'remember_token' => $userData['remember_token'],
                'email_verified_at' => now(),
            ]);

            // Verifica si el usuario ya tiene un rol asociado, si no, crea uno
            if (!$existingUser->roles->count()) {
                $role = Role::where('name', 'Postulante')->first();
                if ($role) {
                    $existingUser->roles()->attach($role);
                } else {
                    // Si el rol no existe, maneja este caso de acuerdo a tus necesidades
                    // Puede ser lanzar una excepción, registrar un mensaje de error, etc.
                }
            }

            Auth::login($existingUser);

            // $existingUser->update([
            //     'roles' => [
            //         'name' => 'Usuario'
            //     ],
            // ]);
            $viewFromLR = session('fromLRV');
            if ($viewFromLR === 'login-register') {
                session()->forget('fromLR');
                session()->forget('new_user_data');
                return redirect()->route('inicio')->with('success', 'Su cuenta ha sido verificada exitosamente.');
            } else {
                session()->forget('fromLR');
                session()->forget('new_user_data');
                return redirect('/')->with('success', 'Su cuenta ha sido verificada exitosamente.');
            }
        } else {
            // Si no existe, crear un nuevo usuario
            $useNew = User::create([
                'name' => $userData['name'],
                'names' => $userData['names'],
                'apellido_p' => $userData['apellido_p'],
                'apellido_m' => $userData['apellido_m'],
                'dni' => $userData['dni'],
                'direccion' => $userData['direccion'],
                'telefono' => $userData['telefono'],
                'email' => $userData['email'],
                'password' => $userData['password'],
                'remember_token' => $userData['remember_token'],
                'email_verified_at' => now(),
            ]);

            // Verifica si el usuario ya tiene un rol asociado, si no, crea uno
            if (!$useNew->roles->count()) {
                $role = Role::where('name', 'Postulante')->first();
                if ($role) {
                    $useNew->roles()->attach($role);
                } else {
                    // Si el rol no existe, maneja este caso de acuerdo a tus necesidades
                    // Puede ser lanzar una excepción, registrar un mensaje de error, etc.
                }
            }
            Auth::login($useNew);

            $viewFromLR = session('fromLRV');
            if ($viewFromLR === 'login-register') {
                session()->forget('fromLR');
                session()->forget('new_user_data');
                return redirect()->route('inicio')->with('success', 'Su cuenta ha sido verificada exitosamente.');
            } else {
                session()->forget('fromLR');
                session()->forget('new_user_data');
                return redirect('/')->with('success', 'Su cuenta ha sido verificada exitosamente.');
            }
        }
    }

    public function resend(Request $request)
    {
        $user = session('new_user_data');
        $userAuth = Auth::user();

        // Verificar si el usuario no está en sesión ni autenticado
        if (!$user && !$userAuth) {
            return Redirect::back()->with('error', 'No hay datos de usuario para reenviar la verificación.');
        }

        try {
            // Reenviar el correo de verificación
            $email = $user ? $user->email : $userAuth->email;
            Mail::to($email)->send(new RegisterMail($user ? $user : $userAuth));

            // Establecer la clave de sesión 'status' en 'verification-link-sent'
            $request->session()->flash('status', 'verification-link-sent');

            return redirect('/email/verify-notice')->with('success', 'Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.');
        } catch (\Exception $e) {
            // Manejar cualquier excepción que pueda ocurrir durante el envío del correo
            return redirect('/email/verify-notice')->with('error', 'Se produjo un error al intentar enviar el correo de verificación.');
        }
    }
}
