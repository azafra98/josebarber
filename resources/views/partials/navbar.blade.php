<div class="cookie-alert">
    <span class="message">Esta página usa cookies para ofrecerte una mejor experiencia. Al usarla estarás aceptando los <a href="http://www.interior.gob.es/politica-de-cookies" target="_blank">términos</a></span>
    <span class="mobile">Esta página usa cookies, <a href="http://www.interior.gob.es/politica-de-cookies" target="_blank">aprende más</a></span>
    <label for="checkbox-cb" class="close-cb accept-cookies">x</label>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{url('/')}}">
        <img src="{{asset('img/logo-Peluquero.png')}}" alt="Logo" style="width:90px;">
    </a>
    <div class="collapse navbar-collapse align-content-center" id="navbarTogglerDemo03">
        <ul class="nav navbar-nav text-navbar ml-5">
            <li class="nav-item px-2">
                <a class="nav-link ml-lg-3" href="{{url('/')}}">INICIO</a>
            </li>
            <li class="nav-item px-2">
                <a class="nav-link" href="{{url('/citas')}}">CITAS</a>
            </li>
            @if(Auth::check() )
                @if(Auth::user()->rol == "administrador")
                    <li class="nav-item px-2">
                        <a class="nav-link" href="{{url('/entradas')}}">ENTRADAS</a>
                    </li>
                @endif
            @endif
            <li class="nav-item px-2">
                <a class="nav-link" href="{{url('/vip')}}">VIP</a>
            </li>
            <li class="nav-item px-2">
                <a class="nav-link" href="{{url('/localizanos')}}">¿DÓNDE ESTAMOS?</a>
            </li>
            <li class="nav-item px-2">
                <a class="nav-link" href="{{url('/redes')}}">REDES SOCIALES</a>
            </li>
            <li class="nav-item px-2">
                <a class="nav-link" href="{{url('/biografia')}}">BIOGRAFÍA</a>
            </li>
            <li class="nav-item px-2">
                <a class="nav-link" href="{{url('/ayuda')}}">AYUDA</a>
            </li>
            @if(Auth::check() )
                @if(Auth::user()->rol == "administrador")
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="collapsingNavbar"
                           data-toggle="dropdown">
                            CONTROL
                        </a>
                        <ul class="dropdown-menu"  id="dropdownMenuButton">
                            <li><a class="dropdown-item" href="{{url('/control/usuarios')}}">Usuarios</a></li>
                            <li><a class="dropdown-item" href="{{url('/control/cortes')}}">Cortes</a></li>
                            <li><a class="dropdown-item" href="{{url('/control/dias-no-disponibles')}}">Días no disponibles</a></li>
                            <li><a class="dropdown-item" href="{{url('/control/horarios')}}">Horarios</a></li>
                            <li><a class="dropdown-item" href="{{url('/control/reservas')}}">Reservas</a></li>
                            <li><a class="dropdown-item" href="{{url('/control/banner')}}">Cambiar Banner</a></li>
                        </ul>
                    </li>
                @endif
            @endif
        </ul>
        <ul class="navbar-nav ml-auto text-navbar mr-2">
            @if(Auth::check())

                <div class="dropdown order-1">

                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownLogout" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <img class="imgPerfil" src="{{asset(Auth::user()->imagenusuario)}}"/>
                    </button>

                    <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="dropdownLogout">
                        <form action="{{ url('/miPerfil') }}" method="GET" style="display:inline">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-link dropdown-item" style="display:inline;cursor:pointer">
                                Mi perfil
                            </button>
                        </form>
                        <form action="{{ url('/logout') }}" method="POST" style="display:inline">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-link dropdown-item" style="display:inline;cursor:pointer">
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>


                <li class="nav-item">

                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/login')}}">Log in</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/register')}}">Register</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
<script src="{{url('js/cookie-alert.js')}}"></script>
