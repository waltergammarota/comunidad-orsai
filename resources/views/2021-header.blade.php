<header>
    <nav class="contenedor">
        <div id="contenedor_logo_header">
            <div id="logo_header">
                <a href="{{url('/')}}"><img src="{{url('recursos/front2021/comunidad-orsai.png')}}"
                                            alt="Comunidad Orsai"></a>
            </div>
        </div>
        <div id="desplegable" class="desplegable_cerrado">
            <div id="menu_pcpal">
                <ul id="insertar_perfil">
                    <li><a href="{{url('novedades')}}">Novedades</a></li>
                    <li><a href="{{url('historia')}}">Línea de tiempo</a></li>
                    {{--                    <li><a href="{{url('concursos')}}">Concursos</a></li>--}}
                    {{--                    <li><a href="{{url('donar')}}">Donar</a></li>--}}
                </ul>
            </div>
        </div>
        <div id="menu_reg">
            @if (!Auth::check())
                <ul>
                    <li>
                        <a href="{{url('ingresar')}}">Entrar</a>
                    </li>
                    <li>
                        <a href="{{url('registrarse')}}" class="button_register button_rounded resaltado_amarillo">Asociarse</a>
                    </li>
                </ul>
            @endif

            @if (Auth::check())
                @isset($notifications)
                    <div id="menu_reg">
                        <ul class="logueado">
                            <li class="resaltado_gris animated swing">
                                <span class="color_gris_claro icon-aviso"></span>
                                @if (count($notifications) != 0)
                                    <div class="campanita"><span class="cant_avisos">{{count($notifications)}}</span>
                                    </div>
                                @endif
                                <ul class="mensajes_menu">
                                    @if (count($notifications) != 0)
                                        @foreach($notifications as $notification)
                                            <li>
                                                <a href="{{url('notificacion')}}/{{$notification['id']}}"
                                                   rel="noopener noreferrer">
                                                    <strong
                                                        class="notif_subject">{{Str::limit($notification['asunto'],70)}}</strong>
                                                    <span class="notif_author">{{$notification['autor']}}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                    <li class="menu_configuracion">
                                        <a href="{{url('notificaciones')}}" rel="noopener noreferrer"><span
                                                class="icon-vista"></span>Ver todas</a>
                                        <a href="{{url('configuracion-notificaciones')}}"
                                           rel="noopener noreferrer"><span
                                                class="icon-config"></span>Preferencias</a>
                                    </li>
                                </ul>
                            </li>
                            <li id="clonar_perfil" class="menu_perfil">
                                <div class="borde_gris menu_img">
                                    <img src="{{Session::get('avatar')}}" alt="{{$username}}">
                                </div>
                                <div class="menu_perfil_nombre">
                                    <span class="nickname">{{'@'.$username}}</span>
                                    <span class="color_gris_claro">{{Session::get('balance')}} fichas</span>
                                    <span class="icono icon-angle-down"></span>
                                </div>
                                <div class="submenu">
                                    <ul class="mensajes_menu contenedor">
                                        @if(Session::get('role') == "admin")
                                            <li><a href="{{url('dashboard')}}" rel="noopener noreferrer">Dashboard</a>
                                            </li>
                                        @endif
                                        <li><a href="{{url('panel')}}" rel="noopener noreferrer">Panel</a></li>
                                        <li><a href="{{url('salir')}}" onclick="alertLogout()"
                                               rel="noopener noreferrer">Cerrar
                                                sesión</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endisset
            @endif
        </div>
    </nav>
    </div>
    <div id="abrir" class="curso">
        <div class="cont">
            <div id="menu-icon-wrapper2" class="menu-icon-wrapper" style="visibility: hidden">
                <svg width="1000px" height="1000px">
                    <path id="pathD"
                          d="M 300 400 L 700 400 C 900 400 900 750 600 850 A 400 400 0 0 1 200 200 L 800 800"></path>
                    <path id="pathE" d="M 300 500 L 700 500"></path>
                    <path id="pathF"
                          d="M 700 600 L 300 600 C 100 600 100 200 400 150 A 400 380 0 1 1 200 800 L 800 200"></path>
                </svg>
                <button id="menu-icon-trigger2" class="menu-icon-trigger"></button>
            </div>
        </div>
    </div>
</header>
