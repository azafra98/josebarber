@extends('layouts.master')
@section('content')

    <nav class="navbar navbar-light mt-3">
        <div class="w-100">
            <form class="form-inline float-right">
                <input name="apellidos" class="form-control mr-sm-2" type="search" placeholder="Filtrar por apellidos" aria-label="Search">
                <input name="email" class="form-control mr-sm-2" type="search" placeholder="Filtrar por email" aria-label="Search">
                <!-- Filtro por rol -->
                <select name="rol" class="form-control mr-sm-2">
                    <option value="">Filtrar por rol</option>
                    <option value="administrador">Administrador</option>
                    <option value="basico">Básico</option>
                    <option value="baneado">Baneado</option>
                </select>
                <button class="btn btn-secundary my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        </div>
    </nav>
    <div class="table-responsive bg-light main w-90 p-2 mb-3">
        <a type="button" class="btn btn-primary my-3" href="{{url('control/usuarios/anadir')}}" >Añade usuario</a>

        <h1>CONTROL DE USUARIOS:</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <table class="table">
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Instagram</th>
                <th>Acciones</th>
            </tr>
            @foreach($users as $u)
                <tr>
                    <td>{{$u->nombre}}</td>
                    <td>{{$u->apellidos}}</td>
                    <td>{{$u->email}}</td>
                    <td>{{$u->telefono}}</td>
                    <td>{{$u->insta_user}}</td>
                    <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <form class="form" action="{{url('/control/usuarios/eliminar')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$u->id}}">
                                    @if(\Illuminate\Support\Facades\Auth::user()->id == $u->id)
                                        <input class="btn btn-danger" name="eliminar" value="Eliminar" disabled  type="submit">
                                    @else
                                        <input class="btn btn-danger" name="eliminar" value="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este usuario junto con sus reservas? Esta acción no se puede deshacer. ¡¡¡Tenga mucho cuidado!!!')" type="submit">
                                    @endif
                                </form>
                            </li>
                            <li class="list-inline-item">
                                <form class="form" action="{{url('/control/usuarios/modificar', ['id' => $u->id])}}" method="get">
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
                {{$users->links()}}
            </div>
        </div>
    </div>
@endsection
