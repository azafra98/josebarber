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
                        <h3 class="auth__form_title text-center">{{ __('Crea nuevo corte') }}</h3>
                        <div>
                            <div class="form-group row">
                                <label for="tipoPelado" class="col-md-4 col-form-label text-md-right">{{ __('Tipo Pelado*') }}</label>

                                <div class="col-md-6">
                                    <input id="tipoPelado" type="text" class="form-control @error('tipoPelado') is-invalid @enderror" name="tipoPelado" value="{{ old('tipoPelado') }}" required autocomplete="tipoPelado" autofocus>

                                    @error('tipoPelado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="precio" class="col-md-4 col-form-label text-md-right">{{ __('Precio*') }}</label>

                                <div class="col-md-6">
                                    <input id="precio" type="number" step="0.5" min="0.5" class="form-control @error('precio') is-invalid @enderror" name="precio" value="{{ old('precio') }}" required autocomplete="precio" autofocus>

                                    @error('precio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
