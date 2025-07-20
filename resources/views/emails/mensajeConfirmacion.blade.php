<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{{asset('css/home.css')}}">

    <title>Confirmación cita Jose A. Barber</title>
</head>
<body style="margin: 0; padding: 0;">
<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td style="padding: 20px 0 30px 0;">

            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
                <tr>
                    <td align="center" bgcolor="#1c191c" style="padding: 40px 0 30px 0;">
                        <img src="{{$message->embed(asset('img/logo-Peluquero.png'))}}" alt="Logo Joseabarber." height="230" style="display: block;" />
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                            <tr>
                                <td style="color: #153643; font-family: 'Courgette'">
                                    <h1 style="font-size: 24px; margin: 0;">Hola, {{$nombre}}</h1>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #153643; font-family: 'Barlow Condensed'; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
                                    <p style="margin: 0;">Le confirmamos que ha obtenido una cita en Jose A. Barber el día {{$dia}} a las {{$horaComienzo}}, en la cual obtendrá {{$tipoPelado}}</p>
                                    <p>Para tu comodidad, puedes añadir un recordatorio en tu calendario haciendo clic en el botón a continuación.</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #153643; font-family: 'Barlow Condensed'; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
                                    <a href="https://www.google.com/calendar/render?action=TEMPLATE&dates={{$horaInicio}}/{{$horaFin}}&text=Cita+en+JoseaBarber&location=Josea_Barber%2C+C.+el+Agua%2C+13%2C+14900+Lucena%2C+C%C3%B3rdoba%2C+Espa%C3%B1a&googlecalendar" target="_blank" style="display: inline-block; padding: 12px 24px; font-size: 16px; font-weight: bold; color: white; background-color: #007bff; text-align: center; text-decoration: none; border-radius: 5px;">
                                        Añadir recordatorio
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #153643; font-family: 'Barlow Condensed'; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
                                    <p style="margin: 0;">Te pedimos que por favor seas puntual, y en caso de que no puedas acudir, te rogamos que canceles la cita con la mayor brevedad posible para ofrecer tu lugar a otro cliente.</p>
                                    <p>¡Gracias por elegirnos!</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#1c191c" style="padding: 30px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                            <tr>
                                <td align="center" style="color: #ffffff; font-family: 'Barlow Condensed'; font-size: 14px;">
                                    <p style="margin: 0;">&reg; Jose A. Barber 2021</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
</body>
</html>

