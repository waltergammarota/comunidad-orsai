<nav>
    <div id="contenedor_logo_header">
        <div id="logo_header">
            <a href="{{url('novedades')}}">
                <img src="{{url('recursos/comunidad-orsai-new.png')}}" alt="Comunidad Orsai" width="150">
            </a>
        </div>
    </div>
    <div id="desplegable" class="desplegable_cerrado">
        <div id="menu_pcpal">
            <ul>
                <li><a href="{{url('historia')}}">Linea de tiempo</a></li>
                <li><a href="{{url('preguntas-frecuentes')}}">Preguntas frecuentes</a></li>
                @if (Auth::check())
                    @if(Session::get('role') == "admin") 
                        <li><a href="{{url('novedades')}}">Novedades</a></li>  
                        <li><a href="{{url('fundacion')}}">Fundación Orsai</a></li>
                        <li><a href="{{url('donar')}}">Donar</a></li>
                    @endif
                @endif
            </ul>
        </div>
        <div id="menu_reg">
            @if (!Auth::check())
                <ul>
                    @if (Route::currentRouteName() == 'ingresar')
                        <li class="active li_dotted"><a
                                href="{{url('ingresar')}}">Entrar</a>
                        </li>
                    @else
                        <li class="li_dotted"><a href="{{url('ingresar')}}">Entrar</a>
                        </li>
                    @endif
                    @if (Route::currentRouteName() == 'registrarse')
                        <li class="active"><a href="{{url('registrarse')}}" class="gris">Asociarse</a>
                        </li>
                    @else
                        <li><a href="{{url('registrarse')}}" class="gris">Asociarse</a>
                        </li>
                    @endif
                </ul>
            @endif
            @if (Auth::check())
                <div id="menu_notifications">

                    <div class="notification-box">
                        <a href="{{url('notificaciones')}}">
                            <div class="bell-icon" tabindex="0">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px"
                                     height="30px" viewBox="0 0 50 30" enable-background="new 0 0 50 30"
                                     xml:space="preserve">
                                <g class="bell-icon__group">
                                    <path class="bell-icon__ball" id="ball" fill-rule="evenodd" stroke-width="1.5"
                                          clip-rule="evenodd" fill="none" stroke="#currentColor" stroke-miterlimit="10"
                                          d="M28.7,25 c0,1.9-1.7,3.5-3.7,3.5s-3.7-1.6-3.7-3.5s1.7-3.5,3.7-3.5S28.7,23,28.7,25z"/>
                                    <path class="bell-icon__shell" id="shell" fill-rule="evenodd" clip-rule="evenodd"
                                          fill="#FFFFFF" stroke="#currentColor" stroke-width="2" stroke-miterlimit="10"
                                          d="M35.9,21.8c-1.2-0.7-4.1-3-3.4-8.7c0.1-1,0.1-2.1,0-3.1h0c-0.3-4.1-3.9-7.2-8.1-6.9c-3.7,0.3-6.6,3.2-6.9,6.9h0 c-0.1,1-0.1,2.1,0,3.1c0.6,5.7-2.2,8-3.4,8.7c-0.4,0.2-0.6,0.6-0.6,1v1.8c0,0.2,0.2,0.4,0.4,0.4h22.2c0.2,0,0.4-0.2,0.4-0.4v-1.8 C36.5,22.4,36.3,22,35.9,21.8L35.9,21.8z"/>
                                </g>
                                </svg>
                                <div class="notification-amount">
                                    <span>1</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div id="menu_notifications_box" class="">
                        <div class="menu_white">
                            <ul>
                                @if (count($notifications) != 0)
                                    @foreach($notifications as $notification)
                                        <li class="notif_message">
                                            <a href="{{url('notificacion')}}/{{$notification['id']}}">
                                                <span
                                                    class="notif_subject">{{Str::limit($notification['asunto'],70)}}</span>
                                                <span class="notif_author">{{$notification['autor']}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                                <li class="notif_viewall"><a href="{{url('notificaciones')}}"><span
                                            class="icon-mail"></span> Ver todas</a></li>
                                <li class="notif_config"><a href="{{url('configuracion-notificaciones')}}"><span
                                            class="icon-cog"></span> Preferencias</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="menu_logueado">
                    <div id="menu_user_img">
                        <img src="{{Session::get('avatar')}}"
                             alt="Imagen usuario">
                    </div>
                    <div id="menu_user_alias">
                        <span class="text_bold">{{'@'.$username}} <span
                                class="resaltado_amarillo icon-angle-down"></span></span>
                        <span>{{Session::get('balance')}} fichas</span>
                    </div>
                    <div id="menu_logueado_desp" class="">
                        <div class="menu_black">
                            <ul>
                                @if(Session::get('role') == "admin")
                                        <li><a href="{{url('dashboard')}}">Dashboard</a></li>
                                @endif
                                @if (Route::currentRouteName() == 'perfil')
                                    <li class="active"><a href="{{url('panel')}}">Panel</a></li>
                                @else
                                    <li><a href="{{url('panel')}}">Panel</a></li>
                                @endif
                                @if (Route::currentRouteName() == 'pagina')
                                    <li class="active"><a href="{{url('novedades')}}">Novedades</a></li>
                                @else
                                    <li><a href="{{url('novedades')}}">Novedades</a></li>
                                @endif
                                <li><a href="{{url('salir')}}">Cerrar sesión</a></li>
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
