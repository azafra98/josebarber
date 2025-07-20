@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row m-5">
            <div class="col-md-12 mb-md-0 mb-5">
                <form class="form"  method="POST" action="{{url('/control/reservas/anadir')}}">
                    {{ csrf_field() }}

                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="md-form mb-0">
                                <label for="email"><h1>Email del usuario*</h1></label>
                                <input type="text" name="email" id="email" required class="form-control"/>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="md-form mb-0">
                                <label for="cliente"><h1>Nombre del cliente</h1></label>
                                <input type="text" name="cliente" id="cliente" class="form-control"/>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="md-form mb-0">
                                <label for="corte"><h1>Elige el tipo de corte*</h1></label>
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
                                <label for="newDia"><h1>Elige el día de la cita*</h1></label>
                                <input type="date" id="newDia" name="newDia"  required class="form-control">
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
                            <div class="row mt-3 mb-3">
                                <div class="btn-group btn-group-toggle flex-wrap" id="grupoBotonAdd" data-toggle="buttons">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-12 my-4">
                                                <h3>Mañana</h3>
                                            </div>
                                        </div>
                                        <div class="row" id="newMañana"></div>
                                        <div class="row">
                                            <div class="col-sm-12 mt-5 mb-4">
                                                <h3>Tarde</h3>
                                            </div>
                                        </div>
                                        <div class="row" id="newTarde"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="link-container">
                        <input class="btn btn-primary" type="submit" value="Aceptar">
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
