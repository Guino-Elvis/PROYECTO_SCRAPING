<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper;
use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cache;
use Yoeunes\Toastr\Facades\Toastr;
class AuthController extends Controller
{
    public function logout_user(Request $request)
    {
        $registeredIds = session('registered_ids', []);

        // Verificar la expiración del carrito para todos los productos
        foreach ($registeredIds as $productIds) {
            Helper::verificarSinExpiracionCarrito($productIds);
        }

        $registeredId = session('registered_cart', []);

        // Verificar la expiración del carrito para el producto
        foreach ((array)$registeredId as $productId) {
            Helper::verificarSnExpiracionCarritoOne($productId);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')
            ->withSuccess('¡Has cerrado sesión correctamente!');
    }

    public function create_user(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'names' => 'required|string|max:50',
            'apellido_p' => 'required|string|max:50',
            'apellido_m' => 'required|string|max:50',
            'dni' => 'required|string|max:50',
            'direccion' => 'required|string|max:50',
            'telefono' => 'required|string|max:50',
            'email' => 'required|string|email:rfc,dns|max:250|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crear una instancia de User y establecer sus propiedades
        $user = new User();
        $user->name = $request->name;
        $user->names = $request->names;
        $user->apellido_p = $request->apellido_p;
        $user->apellido_m = $request->apellido_m;
        $user->dni = $request->dni;
        $user->direccion = $request->direccion;
        $user->telefono = $request->telefono;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(40);

        // Guardar los datos del usuario en la sesión
        Session::put('new_user_data', $user);

        // Envía el correo electrónico de registro
        Mail::to($user->email)->send(new RegisterMail($user));

        return redirect()->route('verificacion.notice')->with('success', 'Por favor revise su correo electrónico para verificar su cuenta.');
    }

    public function login_user(Request $request)
    {
        // Incrementa el contador de intentos fallidos solo si las credenciales son incorrectas
        $this->incrementLoginAttempts($request);

        // Lanza una excepción indicando que las credenciales proporcionadas son inválidas
        throw ValidationException::withMessages([
            'email' => 'Las credenciales proporcionadas son inválidas.',
        ]);
    }

    protected function incrementLoginAttempts(Request $request)
    {
        $key = $this->throttleKey($request);
        $attempts = RateLimiter::attempts($key);

        $maxAttempts = 1; // Número máximo de intentos permitidos
        $decayMinutes = 1; // Tiempo de espera antes de que los intentos se reseteen
        $lockoutTime = now()->addMinutes($decayMinutes);

        // Obtenemos el tiempo en el que se bloqueó al usuario por última vez
        $blockedAt = Cache::get($key . ':lockout');

        if ($blockedAt !== null && $blockedAt > now()->subMinutes($decayMinutes)) {
            $remainingTime = now()->diffInSeconds($blockedAt);
            throw ValidationException::withMessages([
                'email' => 'Demasiados intentos de inicio de sesión. espera ' . $remainingTime . ' segundos antes de intentarlo nuevamente.',
            ])->status(429);
        }

        // Verifica la validez de las credenciales proporcionadas
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Restablece el contador de intentos de inicio de sesión
            $this->clearLoginAttempts($request);
            // Autenticación exitosa, redirige al usuario a su área de inicio

            Toastr::success(
                'El usuario inició sesión exitosamente
                ',
                'Acceso exitoso',
            );
            return redirect()->route('inicio');
        }

        // Si no hay intento de inicio de sesión exitoso, registramos el intento fallido
        RateLimiter::hit($key, $decayMinutes * 60);

        // Si alcanzamos el número máximo de intentos, bloqueamos al usuario
        if ($attempts >= $maxAttempts) {
            Cache::put($key . ':lockout', $lockoutTime, $lockoutTime);
            $remainingTime = $decayMinutes * 60;
            throw ValidationException::withMessages([
                'email' => 'Demasiados intentos de inicio de sesión. espera ' . $remainingTime . ' segundos antes de intentarlo nuevamente.',
            ])->status(429);
        }
    }

    protected function throttleKey(Request $request)
    {
        return mb_strtolower($request->input('email')) . '|' . $request->ip();
    }

    protected function clearLoginAttempts(Request $request)
    {
        RateLimiter::clear($this->throttleKey($request));
    }
}
