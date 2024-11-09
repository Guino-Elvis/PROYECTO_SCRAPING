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
                <h1 class="header_h1">Se ha realizo una venta !!!</h1>
                <img class="header_img" src="{{ $message->embed($imagePathLogo) }}" alt="Icono INFOTELPerú">
            </div>
            <div class="comentario_pago">Se hizo una venta al usuario :
                <strong>{{ $cliente->name }} {{ $cliente->paterno }} {{ $cliente->materno }}</strong>
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
            {{-- <div class="header">
                <img class="header_img" src="{{ $message->embed($qrcodePath) }}" alt="QR Code">
            </div> --}}
            <a href="{{ route('voucher.visualizar') }}?id={{ $voucher['id'] }}" target="_blank"
                class="btndesvista btn btn-primary">Visualizar voucher</a>
            {{-- <a href="{{ route('voucher.visualizar', ['id' => $voucher['id']]) }}" target="_blank"
                class="btn btn-primary">Generar PDF</a> --}}
        </div>
      @else
      <div style="font-family: Poppins">
        <!--   HEADER   -->
        <table role="header" width="100%">
          <tr>
            <td bgcolor="#003BB3" style="padding: 40px 64px; font-size: 14px;">
                <img class="header_img" src="{{ $message->embed($imagePathLogo) }}" alt="Icono INFOTELPerú">
            </td>
          </tr>
        </table>

        <table role="content" style="padding: 80px 64px; color: #363740;">
            <tr>
              <td style="font-weight: 600; font-size: 32px; line-height: 48px; color: #003BB3; padding-bottom: 56px">
                <span>Se necesita confirmación de una venta</span>
              </td>
            </tr>

            <tr>
                <td style="padding-bottom: 30px;">
                  El cliente <strong>{{ $cliente->name }} {{ $cliente->paterno }} {{ $cliente->materno }}</strong> ha realizado un pago por YAPE, por lo que se necesita la confirmación lo mas pronto posible.
                </td>
              </tr>

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
            </div>

            <!-- Pasos a seguir -->
            <tr>
                <td style="padding-bottom: 24px;">
                    <h2 style="font-size: 24px; font-weight: 600; color: #003BB3;">Pasos a seguir:</h2>
                    <ol style="margin-top: 16px;">
                    <li>Ingresa a la página de BOLSALABORAL.</li>
                    <li>Busca la opción de confirmar venta.</li>
                    <li>Completa el proceso de confirmación.</li>
                    </ol>
                </td>
            </tr>


            <tr>
                <td style="padding-bottom: 24px;">
                  Para hacer la confirmación, ingrese a la pagina BOLSALABORAL para realizar la confirmación.
                </td>
              </tr>

            <tr>
                <td style="padding-bottom: 40px">
                  <a href="#" style="text-decoration: none; color: #fff; padding: 12px 32px; background: #003BB3;
                    box-shadow: 0px 14px 14px rgba(0, 0, 0, 0.1); border-radius: 4px;">
                    Ingrese aqui
                  </a>
                </td>
              </tr>

              <tr>
                <td style="line-height: 40px">
                  <span>Thanks</span> <br />
                  <span style="font-weight: 600">The BOLSALABORAL</span>
                </td>
              </tr>

          </table>


        <!--    FOOTER    -->
           <table role="footer" width="100%">
          <tr align="center">
            <td  style="background: #003BB3; padding: 40px 0;">
              <div style="padding-bottom: 34px">
                <a href="#">
                    <img style="padding-right: 40px" src="https://res.cloudinary.com/dtsjiqrgd/image/upload/v1636711876/facebook_yl5wto.png" alt="facebook-icon">
                  </a>
                <a href="#">
                <img style="padding-right: 40px" src="https://res.cloudinary.com/dtsjiqrgd/image/upload/v1636711926/instagram_vfnpyx.png" alt="instagram-icon">
                </a>
                <a href="#">
                  <img style="padding-right: 40px" src="https://res.cloudinary.com/dtsjiqrgd/image/upload/v1636712047/twitter_kfu6bd.png" alt="twitter-icon">
                </a>
                <a href="#">
                <img src="https://res.cloudinary.com/dtsjiqrgd/image/upload/v1636712011/linked-in_gkbnuo.png" alt="linked-in-icon">
                </a>
              </div>

              <div style="color: #fff; font-weight: 300; padding-bottom: 34px">
                <span>You are receiving this email <br />
                © 2024, ToNote . All rights reserved.
                </span>
              </div>

              <div style="color: #fff; font-weight: 300;">
                <a href="#" style="text-decoration: none; color: #fff;">Unsubscribe</a>
                <span style="padding: 0 16px;">|</span>
                <a href="#" style="text-decoration: none; color: #fff;">Privacy Policy</a>
                <span style="padding: 0 16px;">|</span>
                <a href="#" style="text-decoration: none; color: #fff;">Help Center</a>
              </div>
            </td>
          </tr>
        </table>
      </div>

      @endif

    </div>
</body>

</html>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <title>Pending Payment Email Template</title>
</head>

</html>
