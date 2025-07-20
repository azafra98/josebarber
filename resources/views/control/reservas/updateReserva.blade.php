@extends('layouts.master')
@section('content')
    <div class="container-fluid text-secondary" id="cargaHora">
        <div class="auth">
            <div class="auth__header">
                <div class="text-center auth__logo">
                    <img height="150" src="{{asset("img/logoJose.png")}}" alt="">
                </div>
            </div>
            <div class="auth__body">
                <form class="auth__form__register"  method="POST" action="{{url('/control/reservas/modificar', ['id' => $reserva->id])}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$reserva->id}}">
                    <div class="auth__form_body">
                        @if($errors->any())
                            <div class="row mb-4">
                                <div class="col">
                                    <span class="text-danger">*{{$errors->first()}}</span>
                                </div>
                            </div>
                        @endif
                        <h3 class="auth__form_title text-center">{{ __('Modificar cita') }}</h3>
                        <div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email">Email Usuario</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $reserva->user->email }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="idCorte">Corte</label>
                                        <select id="idCorte" name="idCorte" class="form-control">
                                            @foreach($cortes as $c)
                                                @if ($c->id == $reserva->corte->id)
                                                    <option value="{{$c->id}}" selected>{{$c->tipoPelado}}</option>
                                                @else
                                                    <option value="{{$c->id}}">{{$c->tipoPelado}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('idCorte')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="updateDia">Dia</label>
                                        <input id="updateDia" type="date" class="form-control" name="updateDia" value="{{ $reserva->dia }}" required autofocus>
                                        @error('updateDia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="horaUpdate" class="form-group">
                                        @error('hora')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
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
