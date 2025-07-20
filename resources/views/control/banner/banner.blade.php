@extends('layouts.master')
@section('content')
    <div class="table-responsive bg-light main w-90 p-2 my-3">
        <a type="button" class="btn btn-primary my-3" href="{{url('control/dias-no-disponibles/anadir')}}">Añade un día
            no disponible</a>

        <h1>CONTROL DE BANNER:</h1>

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

        <table class="table">
            <tr>
                <th>Banner actual</th>
                <th>Cambiar Imagen</th>
            </tr>
            <tr>
                <td>
                    @if($img->count() > 0)
                        <img class='img-fluid mx-auto' src="{{asset($img->first()->img)}}"/>
                    @endif
                </td>
                <td>
                    <form method="POST"
                          action="{{url('/control/banner/modificar')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input id="banner" type="file" class="form-control" name="banner" accept="image/*" required>
                            <small class="form-text text-muted">
                                Tamaño máximo: 0.5MB | Formatos permitidos: JPG, PNG, GIF, WEBP.
                            </small>
                        </div>
                        <div class="row mt-2">
                            <div class="col text-center">
                                <input class="btn btn-warning" name="modificar" value="Modificar"
                                       onclick="return confirm('¿Estás seguro de que quieres modificarlo?')"
                                       type="submit">
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        </table>
    </div>
@endsection
