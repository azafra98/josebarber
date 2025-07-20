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
                        <h3 class="auth__form_title text-center">{{ __('Crea nuevo día no disponible') }}</h3>
                        <div>
                            <div class="form-group row">
                                <label for="dia" class="col-md-4 col-form-label text-md-right">{{ __('Día') }}</label>

                                <div class="col-md-6">
                                    <input id="dia" type="date" class="form-control" name="dia" value="{{ old('dia') }}" required autocomplete="dia" autofocus>
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
