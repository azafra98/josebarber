@extends('layouts.master')
@section('content')

    <nav class="navbar navbar-light mt-3">
        <div class="w-100">
            <form class="form-inline float-right">
                <input name="email" class="form-control mr-sm-2" placeholder="Filtrar por email" type="search" aria-label="Search by Email">
                <input name="fecha1" class="form-control mr-sm-2" placeholder="Fecha Inicial" type="text" aria-label="Search by Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                <input name="fecha2" class="form-control mr-sm-2" placeholder="Fecha final" type="text" aria-label="Search by Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                <button class="btn btn-secundary my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        </div>
    </nav>
    <div class="table-responsive bg-light main w-90 p-2 mb-3">
        <a type="button" class="btn btn-primary my-3" href="{{url('control/reservas/anadir')}}" >Añade reserva</a>

        <h1>CONTROL DE RESERVAS:</h1>
        <table class="table">
            <tr>
                <th>Cliente</th>
                <th>Teléfono</th>
                <th>Hora</th>
                <th>Dia</th>
            </tr>
            @foreach($reservas as $r)
                <tr>
                    @if($r->idCliente != 1 || !isset($r->nomcliente))
                        <td>{{$r->user->nombre}} {{$r->user->apellidos}}</td>
                    @else
                        <td>{{$r->nomcliente->nombre}}</td>
                    @endif
                    <td><a href="https://wa.me/{{$r->user->telefono}}" target="_blank">{{$r->user->telefono}}</a></td>
                    <td>{{date('H:i', strtotime($r->horario->horaComienzo))}}</td>
                    <td>{{$r->dia}}</td>
                    <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <form class="form" action="{{url('/control/reservas/eliminar')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$r->id}}">
                                    <input class="btn btn-danger" name="eliminar" value="Eliminar" onclick="return confirm('¿Estás seguro de eliminarlo?')" type="submit">
                                </form>
                            </li>
                            <li class="list-inline-item">
                                <form class="form" action="{{url('/control/reservas/modificar', ['id' => $r->id])}}}}" method="get">
                                    <input class="btn btn-warning" name="modificar" value="Modificar" type="submit">
                                </form>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="row">
            <div class="col d-flex justify-content-center">
                {{$reservas->links()}}
            </div>
        </div>
    </div>
@endsection
