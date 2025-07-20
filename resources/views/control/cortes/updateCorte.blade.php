@extends('layouts.master')

@section('content')
    <div class="container-fluid text-secondary">
        <div class="auth">
            <div class="auth__header">
                <div class="text-center auth__logo">
                    <img height="150" src="{{asset("img/logoJose.png")}}" alt="">
                </div>
            </div>
            <div class="auth__body">
                <form class="auth__form__register" method="POST" action="{{url('/control/cortes/modificar', ['id' => $c->id])}}"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$c->id}}">
                    <div class="auth__form_body">
                        <h3 class="auth__form_title text-center">{{ __('Modificar corte') }}</h3>
                        <div>
                            <div class="form-group row">
                                <label for="tipoPelado" class="col-md-4 col-form-label text-md-right">{{ __('Tipo Pelado*') }}</label>

                                <div class="col-md-6">
                                    <input id="tipoPelado" type="text" class="form-control" name="tipoPelado" value="{{$c->tipoPelado}}" required autocomplete="tipoPelado" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="precio" class="col-md-4 col-form-label text-md-right">{{ __('Precio*') }}</label>

                                <div class="col-md-6">
                                    <input id="precio" type="number" step="0.5" min="0.5" class="form-control" name="precio" value="{{$c->precio}}" required autocomplete="precio" autofocus>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="auth__form_actions">
                        <input type="submit" value="Modificar" class="btn btn-primary btn-lg btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
