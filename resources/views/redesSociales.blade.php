@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="contenedor-redes-sociales">
            <a class="instagram a_redes" href="https://www.instagram.com/josea_barber177/" target="_blank">
                <span class="circulo"><i class="fab fa-instagram"></i></span>
                <span class="titulo">Instagram</span>
                <span class="titulo-hover">Seguir</span>
            </a>

            <a class="tiktok a_redes" href="https://www.tiktok.com/@josea_barber177?lang=es" target="_blank">
                <span class="circulo"><i><img src="{{asset("img/tik-tok.ico")}}" class="iconoTiktok"/></i></span>
                <span class="titulo">TikTok</span>
                <span class="titulo-hover">Seguir</span>
            </a>
        </div>
    </div>
@endsection
