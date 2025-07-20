@extends('layouts.master')

@section('content')
<div class="container-fluid text-secondary">
    <div class="row mt-5 mb-5 justify-content-center">
        <div class="col-md-8">
            <div class="auth">
                <div class="auth__header">
                    <div class="text-center auth__logo">
                        <img height="150" src="{{asset("img/logoJose.png")}}" alt="">
                    </div>
                </div>

                <div class="auth__body">
                    <form class="auth__form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="auth__form_body">
                            <h3 class="auth__form_title text-center p-3">{{ __('Cambiar contraseña') }}</h3>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="auth__form_actions">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                {{ __('Mandar link de cambio de contraseña') }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
