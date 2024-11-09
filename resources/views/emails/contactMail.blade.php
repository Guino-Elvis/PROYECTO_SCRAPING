<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Nuevo Mensaje</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            margin: 0;
        }

        .container_01 {
            background-color: rgba(255, 255, 255, 0.9);
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header_h1 {
            color: #2258d5;
            font-size: 16px;
            font-weight: bold;
        }

        .header_img {
            max-width: 10rem;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .comentario_pago {
            font-size: 12px;
            padding: 1rem 2rem;
            text-align: center;
        }

        .ticket_pago_h1 {
            font-size: 13px;
            color: #2258d5;
            margin-bottom: 10px;
        }

        .ticket_pago_div {
            background-color: #2258d5;
            text-align: center;
            padding: 10px;
            color: white;
            border-radius: 5px;
        }

        .ticket_pago_div_h1 {
            margin: 0;
            font-size: 13px;
            font-weight: normal;
        }

        .ticket_pago_div_h2 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
        }

        .monto_pago {
            text-align: center;
        }

        .monto_pago_01 {
            text-align: justify;
            padding: 2rem;
        }

        .mp_titles_01_h1 {
            font-size: 12px;
            position: relative;
            color: #527cdb;
            float: left;
            bottom: 2.5rem;
            right: 15px;
        }

        .mp_titles_01_h2 {
            position: relative;
            font-size: 12px;
            color: #1b55db;
            font-weight: 800;
            float: right;
            bottom: 2.5rem;
            left: 15px;
        }

        .monto_pago_02 {
            background-color: #b5c6ed96;
            padding: 1rem;
        }

        .mp_titles_02_h1 {
            margin: 0;
            font-size: 12px;
            color: #3468e2b7;
        }

        .mp_titles_02_h2 {
            margin: 0;
            font-size: 16px;
            color: #3468e2;
        }
    </style>
</head>

<body>
    <div
        style="
        background-image: url('https://drive.google.com/uc?export=view&id=1JJdpzGtm0WNbLtIvIT0GZ92wZk3t46eO&rl');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        padding: 20px;
      ">
      @if ($voucher['status'] == 'PA')
        <div class="container_01">
            <div class="header">
                <h1 class="header_h1">¡Tu Pago ha sido Exitoso!</h1>
                <img class="header_img" src="{{ $message->embed($imagePathLogo) }}" alt="Icono INFOTELPerú">
            </div>
            <div class="comentario_pago">
                <strong>{{ $cliente->name }} {{ $cliente->paterno }} {{ $cliente->materno }}</strong>, tu compra se
                realizó exitosamente, espero disfrutes del producto, te esperamos, hasta la próxima.
            </div>
            <div class="ticket_pago">
                <h1 class="ticket_pago_h1">Ticket de Pago</h1>
                <div class="ticket_pago_div">
                    <h1 class="ticket_pago_div_h1">Código de Pago</h1>
                    <h2 class="ticket_pago_div_h2">{{ $voucher['numero'] }}</h2>
                </div>
            </div>
            <div class="ticket_pago">
                <h1 class="ticket_pago_h1">Estado de Pago</h1>
                <div class="ticket_pago_div">
                    <h1 class="ticket_pago_div_h1">Estado</h1>
                    <h2 class="ticket_pago_div_h2">
                        @if ($voucher['status'] == 'PA')
                            PAGADO
                        @elseif ($voucher['status'] == 'PE')
                            PENDIENTE
                        @elseif ($voucher['status'] == 'RE')
                            EN REVISION
                        @endif
                    </h2>
                </div>
            </div>
            <div class="monto_pago">
                <div class="monto_pago_01">
                    <h1 class="mp_titles_01_h1">Monto Pagado</h1>
                    <h2 class="mp_titles_01_h2">S/. {{ $voucher['total'] }}</h2>
                </div>
                <div class="monto_pago_02">
                    <h1 class="mp_titles_02_h1">Tu Pago ha sido procesado el</h1>
                    <h2 class="mp_titles_02_h2">{{ $fechaFormateada }}</h2>
                </div>
            </div>
            <div class="header">
                <img class="header_img" src="{{ $message->embed($qrcodePath) }}" alt="QR Code">
            </div>
            <a href="{{ route('voucher.visualizar') }}?id={{ $voucher['id'] }}" target="_blank"
                class="btndesvista btn btn-primary">Visualizar voucher</a>
            {{-- <a href="{{ route('voucher.visualizar', ['id' => $voucher['id']]) }}" target="_blank"
                class="btn btn-primary">Generar PDF</a> --}}
        </div>
      @else
      <div class="container_01">
        <div class="header">
            <h1 class="header_h1">¡Tu Pago esta en proceso de revisión!</h1>
            <img class="header_img" src="{{ $message->embed($imagePathLogo) }}" alt="Icono INFOTELPerú">
        </div>
        <div class="comentario_pago">
            <strong>{{ $cliente->name }} {{ $cliente->paterno }} {{ $cliente->materno }}</strong>, tu compra  se
            realizó exitosamente por yape , estamos validando el pago.
        </div>
        <div class="ticket_pago">
            <h1 class="ticket_pago_h1">Ticket de Pago</h1>
            <div class="ticket_pago_div">
                <h1 class="ticket_pago_div_h1">Código de Pago</h1>
                <h2 class="ticket_pago_div_h2">{{ $voucher['numero'] }}</h2>
            </div>
        </div>
        <div class="ticket_pago">
            <h1 class="ticket_pago_h1">Estado de Pago</h1>
            <div class="ticket_pago_div">
                <h1 class="ticket_pago_div_h1">Estado</h1>
                <h2 class="ticket_pago_div_h2">{{ $voucher['status'] }}</h2>
            </div>
        </div>
        <div class="monto_pago">
            <div class="monto_pago_01">
                <h1 class="mp_titles_01_h1">Monto Pagado</h1>
                <h2 class="mp_titles_01_h2">S/. {{ $voucher['total'] }}</h2>
            </div>
            <div class="monto_pago_02">
                <h1 class="mp_titles_02_h1">Tu Pago ha sido procesado el</h1>
                <h2 class="mp_titles_02_h2">{{ $fechaFormateada }}</h2>
            </div>
        </div>


    </div>
      @endif

    </div>
</body>

</html>
