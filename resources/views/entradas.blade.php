@extends('layouts.master')
@section('content')




<div class="row mt-5">
    <div class="col-sm-12">
        <h1 class="text-center text-title">El evento del año</h1>
    </div>
</div>
<div class="row m-5">
    <img class='img-fluid mx-auto' src="{{asset("img/eventos/JoseaParty2024.jpg")}}" />
</div>

<div class="col mt-3 mb-5" style="padding-left: 20%; padding-right: 20%">
    <h3 style="color: #edde66">¿Cómo puedo solicitar mi entrada?</h3>
    <p class="text-justify">
        Solamente tendrás que comunicarlo personalmente a Josea (preventa 689845465) y pagarlo físicamente en la peluquería. No existe 
        la posiblidad de venta al público como tal si no que será por lista privada y uno de los requisitos es tener +18 años.
    </p>
</div>

<div class="col mt-3 mb-5" style="padding-left: 20%; padding-right: 20%">
    <h3 style="color: #edde66">¿Cúando se realizará?</h3>
    <p class="text-justify">
        Estamos preparando todo para tenerlo listo para el viernes día 22 de Diciembre de 2024 desde las 00:00 hasta las 06:00 del sábado 23.
    </p>
</div>

<div class="col mt-3 mb-5" style="padding-left: 20%; padding-right: 20%">
    <h3 style="color: #edde66">¿Que precio tiene la entrada?</h3>
    <p class="text-justify">
        La entrada costará 10 euros incluyendo consigo una consumición.
    </p>
</div>

<div class="col mt-3 mb-5" style="padding-left: 20%; padding-right: 20%">
    <h3 style="color: #edde66">¿Dónde se realizará?</h3>
    <p class="text-justify">
        Se realizará en una nave privada cerca del Wok de Lucena.
    </p>
</div>


@endsection
