@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row my-4">
        <!--<div class="row m-5">-->
            <div class="col-md-12 mb-md-0 mb-5">
                    <form class="form" action="{{url('/pedirCita')}}" method="post">
                        {{ csrf_field() }}
                        <!--<div class="row mt-5">-->
                        <div class="row my-4">
                            <div class="col-md-12">
                                <div class="md-form mb-0">
                                    <label for="corte"><h1>Elige el tipo de corte</h1></label>
                                    <select id="idCorte" name="idCorte" required class="form-control">
                                        @foreach($cortes as $corte)
                                            <option id="corte" name="corte" value="{{$corte->id}}">{{$corte->tipoPelado}} - {{$corte->precio}} €</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="md-form mb-0">
                                    <label for="dia"><h1>Elige el día de la cita</h1></label>
                                    <input type="date" id="dia" name="dia"  required class="form-control">
                                </div>
                            </div>
                        </div>
                        @if($errors->any())
                            <div class="row mb-4">
                                <div class="col">
                                    <span class="text-danger">*{{$errors->first()}}</span>
                                </div>
                            </div>
                        @endif
                        <div class="row m-5">
                            <div class="col-sm-12">
                                <div class="row mt-3 mb-3" style="justify-content: center">
                                    <div class="btn-group btn-group-toggle flex-wrap text-center" data-toggle="buttons">
                                        <div class="container">
                                            <div class="row text-center">
                                                <div class="col-sm-12 my-4">
                                                    <h3>Mañana</h3>
                                                </div>
                                            </div>
                                            <div class="row" id="mañana" style="justify-content: center"></div>
                                            <div class="row text-center">
                                                <div class="col-sm-12 mt-5 mb-4">
                                                    <h3>Tarde</h3>
                                                </div>
                                            </div>
                                            <div class="row" id="tarde" style="justify-content: center"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4 class="mb-1 text-justify">Recordatorio</h4>
                        <p class="mb-1 text-justify">
                            * Al reservar tu cita te comprometes a la asistencia de la misma además de ser puntual, recuerda que 
                            si no puede asistir rogamos que anule dicha cita en la mayor brevedad posible. Ponemos a su disposición una opción para 
                            agregar a su calendario para su comodidad que enviará una notificación 30 minutos antes totalmente configurable.
                        </p>

                        <div class="link-container">
                            <input class="btn btn-primary" type="submit" id="botonCitas" value="Aceptar">
                        </div>

                    </form>
            </div>
        </div>
    </div>
@endsection
