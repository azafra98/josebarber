@extends('layouts.master')
@section('content')
    <div class="table-responsive bg-light main w-90 p-2 my-3">
        <a type="button" class="btn btn-primary my-3" href="{{url('control/horarios/anadir')}}" >Añade un tramo horario</a>

        <h1>CONTROL DE TRAMOS HORARIOS:</h1>
        <table class="table">
            <tr>
                <th>Turno</th>
                <th>Hora de comienzo</th>
            </tr>
            @if(count($horarios) > 0)
                @foreach($horarios as $h)
                    <tr>
                        <td>{{$h->turno}}</td>
                        <td><?php echo date('H:i', strtotime($h->horaComienzo)); ?></td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <form class="form" action="{{url('/control/horarios/eliminar')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$h->id}}">
                                        <input class="btn btn-danger" name="eliminar" value="Eliminar" onclick="return confirm('¿Estás seguro de eliminarlo?')" type="submit">
                                    </form>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
@endsection
