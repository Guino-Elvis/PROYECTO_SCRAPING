<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail_yape extends Mailable
{
    use Queueable, SerializesModels;

    public $proforma;

    /**
     * Create a new message instance.
     */
    public function __construct($proforma)
    {
        $this->proforma = $proforma;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $cliente = session('client');

        return (new Envelope)
            ->from('ginoyujra38@gmail.com', 'BolsaLaboral')
            ->to($cliente->email, $cliente->name)
            ->subject('BolsaLaboral - Confirmación de postulacion');
    }

    public function build()
    {
        $cliente = session('client');
        $postulacion = session('postulacion');

        // Formatear la fecha en el formato deseado en español
        $fechaFormateada = Carbon::parse($postulacion['updated_at'])->format('M d Y g:iA');

        return $this->view('emails.contactMail_yape', [
            'cliente' => $cliente,
            'postulacion' => $postulacion,
            'fechaFormateada' => $fechaFormateada,
            // 'imagePathLogo' => public_path('img/infotel.png'),
            // 'qrcodePath' => public_path('images/qrcode_' . $postulacion['id'] . '.png'),
        ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
