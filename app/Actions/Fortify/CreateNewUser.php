<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Yoeunes\Toastr\Facades\Toastr;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'apellido_p' => ['required'],
            'apellido_m' => ['required'],
            'dni' => ['required'],
            'direccion' => ['required'],
            'telefono' => ['required'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();


        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'apellido_p' => $input['apellido_p'],
            'apellido_m' => $input['apellido_m'],
            'dni' => $input['dni'],
            'direccion' => $input['direccion'],
            'telefono' => $input['telefono'],
            'password' => Hash::make($input['password']),
        ]);

        // Mostrar notificación Toastr de éxito
        Toastr::success('¡Registro exitoso! Ahora puedes iniciar sesión.', '¡Bienvenido!');

        return $user;
    }
}
