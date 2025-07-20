@extends('layouts.master')
@section('content')


    <div class="table-responsive bg-light main w-90 p-2 mb-3">
        <a type="button" class="btn btn-primary my-3" href="{{url('control/cortes/anadir')}}" >Añade corte</a>

        <h1>CONTROL DE Precios:</h1>
        <table class="table">
            <tr>
                <th>Tipo Pelado</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
            @foreach($cortes as $c)
                <tr>
                    <td>{{$c->tipoPelado}}</td>
                    <td>{{$c->precio}}</td>
                    <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <form class="form" action="{{url('/control/cortes/eliminar')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$c->id}}">
                                    <input class="btn btn-danger" name="eliminar" value="Eliminar" onclick="return confirm('¿Estás seguro de eliminarlo?')" type="submit">
                                </form>
                            </li>
                            <li class="list-inline-item">
                                <form class="form" action="{{url('/control/cortes/modificar', ['id' => $c->id])}}" method="get">
                                    <input class="btn btn-warning" name="modificar" value="Modificar" type="submit">
                                </form>
                            </li>
                        </ul>

                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
