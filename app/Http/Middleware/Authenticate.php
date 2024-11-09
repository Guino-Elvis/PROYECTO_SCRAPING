<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr as FacadesToastr;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        FacadesToastr::warning(
            // 'Contraseña actualizada correctamente, vuelva a iniciar sesión',
            'Acceso no autorizado vuelva a iniciar sesión',
            [
                'timeOut' => 5000,
                'progressBar' => true,
                'closeButton' => true,
                'positionClass' => 'toast-top-right',
            ],
        );
        return $request->expectsJson() ? null : route('inicio');
    }
}
