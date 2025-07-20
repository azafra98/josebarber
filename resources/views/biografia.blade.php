@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-sm-12">
            <div class="row">
                <h3>JOSEABARBER, BARBERÍA DE CABALLEROS</h3>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-sm-4">
            <div class="row mb-3">
                <img class="img-fluid" src="{{asset("img/imgBiografia.png")}}" />
            </div>
        </div>
        <div class="col-sm-8">
            <div class="row mt-5"></div>
            <div class="row m-5">
                <p class="text-justify">La barbería JoseABarber situada en pleno centro de Lucena (Córdoba), es toda una referente en cortes de moda y tendencia de la actualidad.
                    Con un estilo clásico pero adaptado a una idea futurista y además con el toque personal de cada cliente.
                    Mi nombre es José Antonio Reyes Cabrera y soy el fundador de “JOSEABARBER”.</p>
            </div>
            <div class="row m-5">
                <p class="text-justify">Comencé mi sueño en 2016 cursando en Hair Topelg, escuela de peluquería/barbería avanzada y consiguiendo mi título en 2017.
                    Con mucha dedicación, esfuerzo e ilusión y el apoyo de a la que yo considero mi familia (todos vosotros), se ha hecho posible unas de mis metas, crear mi propia barbería en Lucena.
                    Abriendo sus puertas el 1 de Junio de 2020.
                    Si necesitas un corte de pelo con buena música, compañía y charlar un ratito, ¡JOSEABARBER es tu barbería!</p>
            </div>
        </div>
    </div>
</div>
@endsection
