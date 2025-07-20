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
                <form class="auth__form__register" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="auth__form_body">
                        @if($errors->any())
                            <div class="row mb-4">
                                <div class="col">
                                    <span class="text-danger">*{{$errors->first()}}</span>
                                </div>
                            </div>
                        @endif
                        <h3 class="auth__form_title text-center">{{ __('Crea nuevo horario') }}</h3>
                        <div>
                            <div class="form-group row">
                                <label for="turno" class="col-md-4 col-form-label text-md-right">Turno</label>
                                <div class="col-md-6">
                                    <select class="custom-select" name="turno" id="turno">
                                        <option value="mañana" selected>Mañana</option>
                                        <option value="tarde">Tarde</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="horaComienzo" class="col-md-4 col-form-label text-md-right">{{ __('Hora de comienzo') }}</label>

                                <div class="col-md-6">
                                    <input id="horaComienzo" type="time" class="form-control @error('horaComienzo') is-invalid @enderror" name="horaComienzo" value="{{ old('horaComienzo') }}" required autocomplete="horaComienzo" autofocus>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="auth__form_actions">
                        <input type="submit" value="Crear" class="btn btn-primary btn-lg btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
