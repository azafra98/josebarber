@extends('layouts.master')

@section('content')
    <section class="row ">
        <div class="col p-0">
            <!--
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active full-image"></div>
                    <div id="target" class="carousel-item"></div>
                    <div class="carousel-item full-image"></div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            -->

            <!--
            <div class="m-5 alert alert-info alert-dismissible fade show" role="alert">
                <h2 class="mb-4 text-center">Novedades</h2>
                <h4 class="mb-1 text-justify">Nuevas mejoras en la integración de los recordatorios de las citas</h4>
                <p class="mb-1">* Ahora puedes añadir tu cita al Calendario automáticamente después de reservar tu cita.</p>
                <p class="mb-1">* Se ha reducido el peso del correo que os enviabamos y se ha añadido un botón para recordar tu cita.</p>
                <p class="mb-1">* Se han añadido condiciones en la reserva para asegurar la asistencia y puntualidad.</p>
                <p class="mb-1">* Posibilidad de ser baneado al incumplir varias veces en la asistencia, puntualidad o pago de tu cita.</p>
                <button type="button" class="close mt-3" data-dismiss="alert" aria-label="Close" style="font-size: 3rem; padding: 0.5rem 1rem;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            -->

            <div class="m-5 alert alert-info alert-dismissible fade show" role="alert">
                <h2 class="mb-4 text-center">Novedades</h2>
                <h4 class="mb-1 text-justify">Optimización de la velocidad de carga de la web</h4>
                <p class="mb-1 text-justify">* Las imágenes de perfil han sido optimizadas para una mejor velocidad de carga.</p>
                <p class="mb-1 text-justify">* Se ha limitado el tamaño de la imagen de perfil que se puede subir o actualizar, el límite está en 0.5MB-512KB.</p>
                <p class="mb-1 text-justify">* Se ha bloqueado la posibilidad de subir otro archivo que no sea una imagen.</p>
                <p class="mb-1 text-justify">* Los usuarios que tenían otro tipo de archivo como fondo de perfil ya sea video o gif se ha reseteado.</p>
                <p class="mb-1 text-justify"></p>
                <p class="mb-1 text-justify">Los cambios implican una mejora de la velocidad de carga y un menor consumo de datos móviles.</p>
                <button type="button" class="close mt-3" data-dismiss="alert" aria-label="Close" style="font-size: 3rem; padding: 0.5rem 1rem;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="row m-5">
                @if($img->count() > 0)
                <img class='img-fluid mx-auto' src="{{asset($img->first()->img)}}" />
                @else
                <img class='img-fluid mx-auto' src="{{asset("img/banner4.jpeg")}}" />
                @endif
            </div>

            <!--
            <div class="row m-5">
                <img class="img-fluid mx-auto" src="{{ asset('img/eventos/DonacionValencia.jpg') }}" />
            </div>

            <div class="row m-5">
                <img class="img-fluid mx-auto" src="{{ asset('img/eventos/DonacionValencia2.jpg') }}" />
            </div>
            -->
        </div>
    </section>
@endsection
