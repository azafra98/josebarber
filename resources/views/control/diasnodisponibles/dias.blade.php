@extends('layouts.master')
@section('content')
    <div class="table-responsive bg-light main w-90 p-2 my-3">
        <a type="button" class="btn btn-primary my-3" href="{{url('control/dias-no-disponibles/anadir')}}" >Añade un día no disponible</a>

        <h1>CONTROL DE DÍAS NO DISPONIBLES:</h1>
        <table class="table">
            <tr>
                <th>Día</th>
            </tr>
            @foreach($dias as $d)
                <tr>
                    <td>{{$d->dia}}</td>
                    <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <form class="form" action="{{url('/control/dias-no-disponibles/eliminar')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$d->id}}">
                                    <input class="btn btn-danger" name="eliminar" value="Eliminar" onclick="return confirm('¿Estás seguro de eliminarlo?')" type="submit">
                                </form>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
