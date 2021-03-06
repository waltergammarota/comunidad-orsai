<nav>
    <div id="contenedor_logo_header">
        <div id="logo_header">
            <a href="{{url('')}}">
                <img src="{{url('recursos/comunidad-orsai.png')}}" alt="comunidad orsai" width="150">
            </a>
        </div>
    </div>
    <div id="desplegable" class="desplegable_cerrado">
        <div id="menu_pcpal">
            <ul>
            </ul>
        </div>
        <div id="menu_reg">
            @if (!Auth::check())
                <ul>
                    @if (Route::currentRouteName() == 'ingresar')
                        <li class="active li_dotted"><a
                                href="{{url('ingresar')}}">Ingresar</a>
                        </li>
                    @else
                        <li class="li_dotted"><a href="{{url('ingresar')}}">Ingresar</a>
                        </li>
                    @endif
                    @if (Route::currentRouteName() == 'registrarse')
                        <li class="active"><a href="{{url('registrarse')}}"
                                              class="gris">Registrarse</a>
                        </li>
                    @else
                        <li><a href="{{url('registrarse')}}" class="gris">Registrarse</a>
                        </li>
                    @endif
                </ul>
            @endif
            @if (Auth::check())
                <div id="menu_logueado">
                    <div id="menu_user_img">
                        <img src="{{Session::get('avatar')}}"
                             alt="Imagen usuario">
                    </div>
                    <div id="menu_user_alias">
        <span class="text_bold">{{ucfirst(Session::get('name'))}}<span
                class="resaltado_amarillo icon-angle-down"></span></span>
                        <span>{{Session::get('balance')}} fichas</span>
                    </div>
                    <div id="menu_logueado_desp" class="">
                        <div class="menu_black">
                            <ul>
                                @if(Session::get('role') == "admin")
                                    <li><a href="{{url('dashboard')}}">Dashboard</a></li>
                                @endif
                                <li class="active"><a href="{{url('panel')}}">Panel</a>
                                </li>
                                <li><a href="{{url('perfil')}}">Perfil</a></li>
                                    <li><a href="{{url('novedades')}}">Blog</a></li>
                                <li><a href="{{url('salir')}}">Cerrar sesi??n</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="line_dashed"></div>
    </div>
</nav>
<div id="abrir" class="curso">
    <div class="cont">
        <div id="menu-icon-wrapper2" class="menu-icon-wrapper"
             style="visibility: hidden">
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
