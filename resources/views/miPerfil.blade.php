@extends('layouts.master')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-3">
                <div class="row">
                    <div class="text-center">
                        <?php
                        ?><img src="{{asset($user->imagenusuario)}}" class="img-circle img-thumbnail" alt="imagen de perfil del usuario">
                    </div><br>
                </div>
                <div class="row mt-2">
                    <a class="btn btn-primary" href="{{url('/editarPerfil')}}">Editar Perfil</a>
                </div>
            </div>
            <div class="col-sm-9 text-left">
                <div class="tab-content">
                    <h1 class="text-title">DATOS DEL USUARIO</h1>
                    <hr>
                    <p class="m-0"><i class="fas fa-mail-bulk mr-2"></i>{{ $user->email }}</p>
                    <p class="m-0"><i class="fas fa-user mr-2"></i>{{$user->nombre}}</p>
                    <p class="m-0"><i class="fas fa-user mr-2"></i>{{$user->apellidos}}</p>
                    <p class="m-0"><i class="fas fa-phone mr-2"></i>{{$user->telefono}}</p>
                    <p class="m-0"><i class="fab fa-instagram mr-2"></i>{{$user->insta_user}}</p>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                @if($errors->any())
                    <div class="row mb-4">
                        <div class="col">
                            <span class="text-danger">*{{$errors->first()}}</span>
                        </div>
                    </div>
                @endif
                <section class="table-responsive">
                    <h1 class="text-title">Historial de Citas de {{$user->nombre}} {{$user->apellidos}}</h1>
                    
                    @if (session('mensaje') == 'Reserva con exito, recuerda añadirla al calendario')
                        <div class="alert alert-success">
                            {{ session('mensaje') }}
                        </div>
                    @elseif (session('mensaje') == 'Reserva cancelada')
                        <div class="alert alert-danger">
                            {{ session('mensaje') }}
                        </div>
                    @endif
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

                    @if(count($user->reservas) > 0)
                        <table class="table table-hover mt-5">
                            <thead>
                            <tr>
                                <th>Corte</th>
                                <th>Horario</th>
                                <th>Día</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->reservas as $reserva)
                                <tr>
                                    <td>{{$reserva->corte->tipoPelado}}</td>
                                    <td>{{date('H:i', strtotime($reserva->horario->horaComienzo))}}</td>
                                    <td>{{$reserva->dia}}</td>
                                    <?php
                                    $hora_inicio = date('Ymd\THis', strtotime($reserva->dia . ' ' . $reserva->horario->horaComienzo));
                                    $hora_fin = date('Ymd\THis', strtotime($reserva->dia . ' ' . $reserva->horario->horaComienzo . '+ 30 minutes'));
                                    ?>
                                    <td>
                                        <a href="https://www.google.com/calendar/render?action=TEMPLATE&dates={{$hora_inicio}}/{{$hora_fin}}&text=Cita+en+JoseaBarber&location=Josea_Barber%2C+C.+el+Agua%2C+13%2C+14900+Lucena%2C+C%C3%B3rdoba%2C+Espa%C3%B1a&googlecalendar" target="_blank">
                                        <img src={{asset("img/recursos/google_calendar.png")}} alt="Añadir a Google Calendar" title="Añadir al calendario" onerror="this.onerror=null;this.src='https://www.svgrepo.com/show/353803/google-calendar.svg';" width="24" height="24"/>
                                        </a>
                                    </td>
                                    @if($reserva->dia > date('Y-m-d'))
                                        <td>
                                            <form action="{{url('/anular-reserva')}}" method="post">
                                                @csrf
                                                <input type="hidden" value="{{$reserva->id}}" name="id">
                                                <input type="submit" value="Anular Reserva" class="btn btn-primary mt-3" onclick="return confirm('¿Estás seguro de anularla?')">
                                            </form>
                                        </td>
                                    @else
                                        @if($reserva->dia == date('Y-m-d') && strtotime($reserva->horario->horaComienzo) -7000 > time())
                                            <td>
                                                <form action="{{url('/anular-reserva')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{$reserva->id}}" name="id">
                                                    <input type="submit" value="Anular Reserva" class="btn btn-primary mt-3" onclick="return confirm('¿Estás seguro de anularla?')">
                                                </form>
                                            </td>
                                            @else
                                                <td></td>
                                            @endif
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Aún no has hecho ninguna reserva</p>
                    @endif
                </section>
            </div>
        </div>
    </div>

    <!-- Modal para añadir a Google Calendar -->
    <div class="modal fade" id="addToCalendarModal" tabindex="-1" role="dialog" aria-labelledby="addToCalendarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #343a40; color: white;">
            <h5 class="modal-title" id="addToCalendarModalLabel">
                <img src="https://www.svgrepo.com/show/353803/google-calendar.svg" alt="Google Calendar" width="24" height="24" style="vertical-align: middle; margin-right: 8px;">
                Añadir Cita al Google Calendar
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body" style="color: #212529;">
                <p>Has reservado una cita con éxito. ¿Deseas añadirla a tu Google Calendar para no olvidarla?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">No, gracias</button>
                <a id="googleCalendarLink" href="#" class="btn btn-success" target="_blank" onclick="closeModalAndRedirect(event)">Añadir al Calendario</a>
            </div>
        </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Obtener las variables de la sesión
            var horaInicio = "{{ session('hora_inicio') }}";
            var horaFin = "{{ session('hora_fin') }}";
            var googleCalendarLink = `https://www.google.com/calendar/render?action=TEMPLATE&dates=${horaInicio}/${horaFin}&text=Cita+en+JoseaBarber&location=Josea_Barber%2C+C.+el+Agua%2C+13%2C+14900+Lucena%2C+C%C3%B3rdoba%2C+Espa%C3%B1a`;
    
            // Configurar el enlace del Google Calendar
            document.getElementById('googleCalendarLink').href = googleCalendarLink;
    
            // Mostrar el modal si hay una reserva exitosa
            if ("{{ session('reserva_exitosa') }}") {
                $('#addToCalendarModal').modal('show');
            }
        });
    
        function closeModalAndRedirect(event) {
            // Evita el comportamiento por defecto del enlace
            event.preventDefault();
            
            // Cierra el modal
            $('#addToCalendarModal').modal('hide');
    
            // Redirige al usuario al enlace de Google Calendar
            const googleCalendarLink = document.getElementById('googleCalendarLink').href;
            window.open(googleCalendarLink, '_blank');
        }
    </script>
@endsection
