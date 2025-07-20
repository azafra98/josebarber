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
                <form class="auth__form__register" method="POST" action="{{url('/control/usuarios/modificar', ['id' => $u->id])}}"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$u->id}}">
                    <input type="hidden" name="imagenAntigua" value="{{$u->imagenusuario}}">
                    <div class="auth__form_body">
                        <h3 class="auth__form_title text-center">{{ __('Modificar usuario') }}</h3>

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
                                    <input id="nombre" type="text" class="form-control" name="nombre" value="{{$u->nombre}}" required autocomplete="nombre" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="apellidos" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos*') }}</label>

                                <div class="col-md-6">
                                    <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{$u->apellidos}}" required autocomplete="apellidos" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email*') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{$u->email}}" required autocomplete="email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña*') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
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
                                    <input id="telefono" type="tel" class="form-control" name="telefono" value="{{$u->telefono}}" required autocomplete="telefono">
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="insta_user" class="col-md-4 col-form-label text-md-right">{{ __('Cuenta de Instagram') }}</label>

                                <div class="col-md-6">
                                    <input id="insta_user" type="text" class="form-control" name="insta_user" value="{{$u->insta_user}}"  autocomplete="insta_user">
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="rol" class="col-md-4 col-form-label text-md-right">{{__('Rol*') }}</label>
                                <div class="col-md-6">
                                    <select class="custom-select" name="rol" id="rol">
                                        <option value="basico" {{ ("basico" == $u->rol ? "selected":"") }}>Básico</option>
                                        <option value="baneado" {{ ("baneado" == $u->rol ? "selected":"") }}>Baneado</option>
                                        <option value="administrador" {{ ("administrador" == $u->rol ? "selected":"") }}>Administrador</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="auth__form_actions">
                        <input type="submit" value="Modificar" class="btn btn-primary btn-lg btn-block">
                        <div class="text-center mt-3">
                            <a href="{{ url('/ayuda') }}">¿Necesitas ayuda?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
