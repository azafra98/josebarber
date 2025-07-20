@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="text-center mt-5">
            <h1>Preguntas frecuentes</h1>
        </div>
        <div class="accordion mt-5" id="preguntas-frecuentes">

            <div class="card mb-2">
                <div class="card-header" id="pregunta1">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#respuesta1" aria-expanded="true" aria-controls="respuesta1">
                            ¿Cómo puedo registrarme en la web?
                        </button>
                    </h2>
                </div>
                <div id="respuesta1" class="collapse" aria-labelledby="pregunta1"
                    data-parent="#preguntas-frecuentes">
                    <div class="card-body" style="color: black">
                        <img src="{{asset('img/ayuda/Registrarse.png')}}" class="mx-auto d-block mb-3" alt="como_registrarse" style="width:600px; max-width:100%">
                        <p>Primero deberás entrar en menú de navegación en la parte de "Register".</p>

                        <img src="{{asset('img/ayuda/Registro.png')}}" class="mx-auto d-block mb-3" alt="como_registrarse" style="width:600px; max-width:100%">
                        <p>Bastará con rellenar los campos personales. Nombre, apellidos, numero y email que siempre esten disponibles.</p>

                        <img src="{{asset('img/ayuda/VerificarCorreo.png')}}" class="mx-auto d-block mb-3" alt="como_registrarse" style="width:600px; max-width:100%">
                        <p>A continuación se nos pedirá que verifiquemos nuestro correo electrónico.</p>

                        <img src="{{asset('img/ayuda/VerificaciónCorreo.png')}}" class="mx-auto d-block mb-3" alt="como_registrarse" style="width:600px; max-width:100%">
                        <p>Bastará con revisar nuestro correo con nuestra app de correo (Gmail generalmente) y darle al botón de Verifica tu Correo.</p>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header" id="pregunta2">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button"
                            data-toggle="collapse" data-target="#respuesta2" aria-expanded="false"
                            aria-controls="respuesta2">
                            Tengo problemas para subir mi imagen de perfil
                        </button>
                    </h2>
                </div>
                <div id="respuesta2" class="collapse" aria-labelledby="pregunta2"
                    data-parent="#preguntas-frecuentes">
                    <div class="card-body" style="color: black">
                        <p>Si tienes problemas para subir tu imagen de perfil, te recomendamos que sigas los siguientes pasos:</p>
                        <p>1. Comprueba que la imagen que estás intentando subir cumple con los formatos permitidos <b>(JPG, PNG, WEBP, GIF)</b>.</p>
                        <p>2. Comprueba que la imagen no excede el tamaño máximo permitido <b>(0.5MB-512KB)</b>.</p>
                        <p>Dicho limite ha sido puesto para autoproteger al usuario de que suba fotos muy pesadas que puedan afectar a su experencia de navegación y consumo de datos.</p>
                        <p>Bastará con seleccionar una imagen poco pesada o bien disminuir la resolución de la misma desde el editor de fotos o bien enviar dicha foto a tu mismo número de WhatsApp y usar la de WhatsApp.</p>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header" id="pregunta3">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button"
                            data-toggle="collapse" data-target="#respuesta3" aria-expanded="false"
                            aria-controls="respuesta3">
                            ¿Cómo puedo editar mi perfil?
                        </button>
                    </h2>
                </div>
                <div id="respuesta3" class="collapse" aria-labelledby="pregunta3"
                    data-parent="#preguntas-frecuentes">
                    <div class="card-body" style="color: black">
                        <img src="{{asset('img/ayuda/MiPerfil.png')}}" class="mx-auto d-block mb-3" alt="como_registrarse" style="width:600px; max-width:100%">
                        <p>Para cambiar tu información de cuenta, por favor accede a tu cuenta de Joseabarber y navega a la sección de "Mi perfil".</p>

                        <img src="{{asset('img/ayuda/ModificarPerfil01.png')}}" class="mx-auto d-block mb-3" alt="como_registrarse" style="width:600px; max-width:100%">
                        <p>Se nos motrará ahora la información de nuestro perfil cuando nos registramos. Para empezar pulsamos el botón de "Editar Perfil"</p>

                        <img src="{{asset('img/ayuda/ModificarPerfil02.png')}}" class="mx-auto d-block mb-3" alt="como_registrarse" style="width:600px; max-width:100%">
                        <p>Desde aquí podrás cambiar tu nombre, correo electrónico, imagen, teléfono y contraseña</p>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header" id="pregunta4">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button"
                            data-toggle="collapse" data-target="#respuesta4" aria-expanded="false"
                            aria-controls="respuesta4">
                            ¿Cómo puedo pedir una cita?
                        </button>
                    </h2>
                </div>
                <div id="respuesta4" class="collapse" aria-labelledby="pregunta4"
                    data-parent="#preguntas-frecuentes">
                    <div class="card-body" style="color: black">
                        <img src="{{asset('img/ayuda/PedirCita.png')}}" class="mx-auto d-block mb-3" alt="como_registrarse" style="width:600px; max-width:100%">
                        <p>
                            Para pedir una cita es tan sencillo como rellenar los siguientes campos con el tipo de corte 
                            que desea y el día que desea para su cita teniendo en cuenta que la disponibilidad suele ser 
                            de unos días posteriormente al momento que se pide la cita y puede verse incrementado por 
                            fechas festivas.
                    </p>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header" id="pregunta5">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button"
                            data-toggle="collapse" data-target="#respuesta5" aria-expanded="false"
                            aria-controls="respuesta5">
                            ¿Puedo pedir mi cita por WhatsApp o Correo?
                        </button>
                    </h2>
                </div>
                <div id="respuesta5" class="collapse" aria-labelledby="pregunta5"
                    data-parent="#preguntas-frecuentes">
                    <div class="card-body" style="color: black">
                        <p>
                            Sabemos que enviar un correo electrónico o un mensaje de WhatsApp puede ser cómodo, pero 
                            reservar tu cita directamente en nuestra página web tiene muchas ventajas. Por ejemplo, 
                            podrás ver nuestra disponibilidad en tiempo real, elegir el servicio que deseas, seleccionar 
                            la fecha y la hora que mejor se adapte a tu agenda.

                            Además, si haces tu reserva en línea, no tendrás que preocuparte por esperar a que respondamos 
                            tu correo electrónico o mensaje de WhatsApp, lo que te garantiza una respuesta rápida y una 
                            confirmación instantánea de tu cita.

                            ¿Listo para reservar tu cita en línea? ¡Es muy fácil! Solo tienes que seguir los pasos que 
                            aparecen en nuestra página web y en unos pocos clics tendrás tu cita confirmada. Además, 
                            si tienes alguna pregunta o necesitas ayuda, nuestro equipo de atención al cliente estará 
                            encantado de ayudarte.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header" id="pregunta6">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button"
                            data-toggle="collapse" data-target="#respuesta6" aria-expanded="false"
                            aria-controls="respuesta6">
                            ¿Como puedo informar de un error?
                        </button>
                    </h2>
                </div>
                <div id="respuesta6" class="collapse" aria-labelledby="pregunta6"
                    data-parent="#preguntas-frecuentes">
                    <div class="card-body" style="color: black">
                        <p>
                            Actualmente estamos trabajando en habilitar en la página web un lugar donde poder enviar tu  
                            feedback sobre cualquier sugerencia o error que puedas encontrar en la página web.

                            Por el momento hemos habilitado para ello los canales de contacto por WhatsApp " 689845465 " 
                            y correo electrónico " joseabarberlucena@gmail.com ".

                            A través de esos canales te recomendamos que seas especifico con tu sugerencia o error ya sea 
                            utilizando grabaciones o capturas de pantalla donde sea vea claramente lo que nos quieras 
                            transmitir y a ser posible una descripción de la situación detallando lo que ocurre, en que 
                            momento ha pasado y cómo has llegado a esa situación.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection