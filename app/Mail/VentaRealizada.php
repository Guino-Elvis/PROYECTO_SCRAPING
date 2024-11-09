<?php
namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VentaRealizada extends Mailable
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
        // Obtener la información del cliente desde la sesión
        $cliente = session('client');

        return (new Envelope)
            ->from('elioth.condori759@gmail.com', 'INFOTELPerú')
            ->to('elioth.condori759@gmail.com', 'Administrador')
            ->subject('INFOTELPerú - Notificación de venta');
    }

    public function build()
    {
        // Obtener la información de la proforma desde el objeto $proforma
        $proforma = $this->proforma;

        $cliente = session('client');
        $voucher = session('voucher');

        $fechaFormateada = Carbon::parse($voucher['updated_at'])->format('M d Y g:iA');

        // Aquí puedes agregar cualquier lógica adicional que necesites para construir el correo electrónico de notificación de venta

        return $this->view('emails.venta_realizada', [
            'proforma' => $proforma,
            'cliente' => $cliente,
            'voucher' => $voucher,
            'fechaFormateada' => $fechaFormateada,
            'imagePathLogo' => public_path('img/infotel.png'),
            // Puedes agregar más datos necesarios para la vista aquí
        ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        // Aquí puedes especificar los archivos adjuntos que deseas enviar con el correo electrónico de notificación de venta, si es necesario
        return [];
    }
}
