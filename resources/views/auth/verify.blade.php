@extends('layouts.master')

@section('content')
<div class="container text-secondary">
    <div class="row mt-5 mb-5 justify-content-center">
        <div class="col-md-8">
            <div class="auth">
                <div class="auth__header">
                    <div class="text-center auth__logo">
                        <img height="150" src="{{asset("img/logoJose.png")}}" alt="">
                    </div>
                </div>

                <div class="auth__body">
                        <div class="auth__form_body">
                            <h3 class="auth__form_title text-center p-3">{{ __('Verificar correo') }}</h3>
                            @if (session('resent'))
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <label for="email" class="col col-form-label">{{ __('Email') }}</label>
                                </div>
                            </div>
                            @endif
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <label for="email" class="col col-form-label">
                                        Antes de proceder, por favor, compruebe en su correo el link de verificación que le hemos enviado.<br>
                                        Si no ha recibido el correo,
                                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-link btn-link-verification p-0 m-0 align-baseline"> haz click aquí para enviar otro</button>.
                                        </form>
                                    </label>
                                </div>
                            </div>
                        </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
