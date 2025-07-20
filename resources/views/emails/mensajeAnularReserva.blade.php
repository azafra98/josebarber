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
                                    <p style="margin: 0;">Le confirmamos que ha anulado una cita en Jose A. Barber el día {{$dia}} a las {{$horaComienzo}}</p>
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

