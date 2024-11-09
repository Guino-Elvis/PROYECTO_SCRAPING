<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Confirme su dirección de correo electrónico')
            ->line('Haga clic en el botón a continuación para verificar su dirección de correo electrónico.')
            ->action('Confirme su dirección de correo electrónico', $verificationUrl)
            ->line('Si no creó una cuenta, no es necesario realizar ninguna otra acción.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    /**
     * Get the verification URL for the given notifiable entity.
     *
     * @return string
     */
    protected function verificationUrl(object $notifiable): string
    {
        // Obtener la información del usuario de la sesión
        $name = session('verification_user_name');
        $email = session('verification_user_email');
        $password = session('verification_user_password');

        // Crear el usuario sin verificación
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => null, // Marcar como no verificado inicialmente
        ]);

        // Verificar si el usuario existe y no está verificado
        if ($user && !$user->hasVerifiedEmail()) {
            // Marcamos el correo electrónico como verificado
            $user->markEmailAsVerified();

            // Lógica adicional, por ejemplo, registrar al usuario si no está registrado
            if (!$user->exists) {
                // Registro del usuario
                // Puedes agregar la lógica de registro aquí o redirigir a la página de registro
            }

            // Generar la URL firmada
            return URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $user->getKey(),
                    'hash' => sha1($user->getEmailForVerification()),
                ]
            );
        }

        // Si no hay información válida en la sesión, devolver una URL vacía o manejar el caso según tus necesidades
        return '';
    }
}
