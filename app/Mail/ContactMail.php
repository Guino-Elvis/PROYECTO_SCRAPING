<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
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
            ->from('elioth.condori759@gmail.com', 'INFOTELPerú')
            ->to($cliente->email, $cliente->name)
            ->subject('INFOTELPerú - Confirmación de compra');
    }

    public function build()
    {
        $cliente = session('client');
        $voucher = session('voucher');

        // Formatear la fecha en el formato deseado en español
        $fechaFormateada = Carbon::parse($voucher['updated_at'])->format('M d Y g:iA');

        return $this->view('emails.contactMail', [
            'cliente' => $cliente,
            'voucher' => $voucher,
            'fechaFormateada' => $fechaFormateada,
            'imagePathLogo' => public_path('img/infotel.png'),
            'qrcodePath' => public_path('images/qrcode_' . $voucher['id'] . '.png'),
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
