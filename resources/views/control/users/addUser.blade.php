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
                        <h3 class="auth__form_title text-center">{{ __('Crea nuevo usuario') }}</h3>

                        <!-- Ejecutamos el código: mostramos los errores de validación si existen -->
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        <div>
                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre*') }}</label>

                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                                    @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="apellidos" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos*') }}</label>

                                <div class="col-md-6">
                                    <input id="apellidos" type="text" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos" value="{{ old('apellidos') }}" required autocomplete="apellidos" autofocus>

                                    @error('apellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email*') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña*') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="imagenusuario" class="col-md-4 col-form-label text-md-right">{{ __('Imagen de perfil') }}</label>

                                <div class="col-md-6">
                                    <input id="imagenusuario" type="file" class="form-control" name="imagenusuario" accept="image/*">
                                    <small class="form-text text-muted">
                                        Tamaño máximo: 0.5MB | Formatos permitidos: JPG, PNG, GIF, WEBP.
                                    </small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Telefono*') }}</label>

                                <div class="col-md-6">
                                    <input id="telefono" type="tel" class="form-control  @error('telefono') is-invalid @enderror" name="telefono" required autocomplete="telefono">
                                </div>

                                @error('telefono')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="insta_user" class="col-md-4 col-form-label text-md-right">{{ __('Cuenta de Instagram') }}</label>

                                <div class="col-md-6">
                                    <input id="insta_user" type="text" class="form-control  @error('insta_user') is-invalid @enderror" name="insta_user" autocomplete="insta_user">
                                </div>

                                @error('insta_user')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="rol" class="col-md-4 col-form-label text-md-right">{{__("Rol*")}}</label>
                                <div class="col-md-6">
                                    <select class="custom-select" name="rol" id="rol">
                                        <option value="basico" selected>Básico</option>
                                        <option value="administrador">Administrador</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="auth__form_actions">
                        <input type="submit" value="Crear" class="btn btn-primary btn-lg btn-block">
                        <div class="text-center mt-3">
                            <a href="{{ url('/ayuda') }}">¿Necesitas ayuda?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
