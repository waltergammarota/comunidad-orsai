@extends('2021-orsai-template')

@section('title', 'Panel de usuario | Comunidad Orsai')
@section('description', 'Panel de usuario')

@section('content')
    <section class="resaltado_gris pd_20 pd_20_tp">
        <div class="panel_perfil contenedor contenedor_interna_2">
            <div class="intro_panel_perfil">
                <div class="img_perfil">
                    <div class="cont_img">
                        <img src="{{$avatar}}" alt="{{'@'.ucfirst($username)}}">
                    </div>
                    @if($user->phone_verified_at)
                        <div class="icono">
                            <span class="icon-check_2"></span>
                        </div>
                    @endif
                </div>
                <div class="intro_datos_perfil">
                    @if($user->socio_fundador)
                        <span class="subtitulo">Socio Fundador</span>
                    @endif
                    <p class="titulo">{{$user->name}} {{$user->lastName}}</p>
                    <a href="{{url('perfil-usuario')}}/{{$session_user_id}}"
                       class="boton_redondeado resaltado_amarillo align_left">Ver perfil</a>
                </div>
                <div class="intro_panel_fichas">
                    <div class="icono">
                        <span class="icon-ficha"></span>
                    </div>
                    <span class="subtitulo">Tenés</span>
                    <p class="titulo"><strong>{{$balance}}</strong> Fichas</p>
                     <a href="{{url('donar')}}" class="boton_redondeado resaltado_amarillo align_left">Conseguir más</a>
                </div>
            </div>
        </div>
    </section>
    @if(Session::get('alert') == "activation_email" || Auth::user()->email_verified_at == null)
        <section class="resaltado_gris general_profile_msg">
            <div class="resaltado_gris  contenedor contenedor_interna_2" style="padding-top:30px;">
                <div
                    style="min-height:60px;background:#fff3cd;border-radius:2px;color:#856404;border:1px solid #ffeeba;padding:0 15px; margin:0px;display:flex;justify-content: space-between;">
                    <p style="display:inline-block;position:relative;"><strong>Tu cuenta está pendiente de activación.</strong> Te enviamos un mail al correo electrónico asociado para que confirmes tu registro en Comunidad Orsai. Revisá en spam o promociones. Si no lo recibiste, hace clic <a href="{{url('reenviar-mail')}}">acá</a>.</p>
                    <p>
                        <a href="#" class="cerrar"
                           style="line-height: 30px;display:inline-block;position:relative;background:#ffeeba;height:30px;width:30px;border-radius:50%;text-align:center">
                            <span>X</span>
                        </a></p>
                </div>
            </div>
        </section>
    @endif

    <section class="resaltado_gris pd_20 pd_20_tp_bt">
        <div class="contenedor contenedor_interna_2">
            <div class="grilla_flex mg_0">
                <a href="{{url('perfil')}}" class="card_style_panel">
                    <article>
                        <div class="icono">
                            <img src="{{url('recursos/front2021/iconos_panel/informacion_personal.svg')}}"
                                 alt="Informacion personal">
                            <span><span class="icon-editar"></span>Editar</span>
                        </div>
                        <h2>Información personal</h2>
                        @if($user->phone_verified_at)
                            <p>Completá tus datos, queremos saber más de vos.</p>
                        @else
                            <p>Validá tu perfil por SMS para acceder a más funcionalidades.</p>
                        @endif
                    </article>
                </a>
                <a href="{{url('mis-postulaciones')}}" class="card_style_panel">
                    <article>
                        <div class="icono">
                            <img src="{{url('recursos/front2021/iconos_panel/mis_postulaciones.svg')}}"
                                 alt="Informacion personal">
                            <span><span class="icon-vista"></span>Ver</span>
                        </div>
                        <h2>Mis postulaciones</h2>
                        <p>Podrás ver tus postulaciones a los concursos.</p>
                    </article>
                </a>
                <a href="{{url('mis-fichas')}}" class="card_style_panel">
                    <article>
                        <div class="icono">
                            <img src="{{url('recursos/front2021/iconos_panel/mis_fichas.svg')}}" alt="mis_fichas">
                            <span><span class="icon-vista"></span>Ver</span>
                        </div>
                        <h2>Mis fichas</h2>
                        <p>Seguí los últimos movimientos de tus fichas.</p>
                    </article>
                </a>
            {{--     <a href="#" class="card_style_panel">
                    <article>
                        <div class="icono">
                            <img src="{{url('recursos/front2021/iconos_panel/mis_cursos.svg')}}" alt="mis_cursos">
                            <span><span class="icon-vista"></span>Ver</span>
                        </div> 
                        <h2>Mis Cursos</h2>
                        <p>Accedé a todos los cursos en los que estas inscripto.</p>
                    </article>
                </a> --}}
                <a href="{{url('configuracion-notificaciones')}}" class="card_style_panel">
                    <article>
                        <div class="icono">
                            <img src="{{url('recursos/front2021/iconos_panel/notificaciones.svg')}}"
                                 alt="notificaciones">
                            <span><span class="icon-config"></span>Editar</span>
                        </div>
                        <h2>Notificaciones</h2>
                        <p>Configurá tus preferencias para cada tipo de notificación.</p>
                    </article>
                </a>
                <a href="{{url('configuracion-preferencias-generales')}}" class="card_style_panel">
                    <article>
                        <div class="icono">
                            <img src="{{url('recursos/front2021/iconos_panel/preferencias.svg')}}" alt="preferencias">
                            <span><span class="icon-config"></span>Editar</span>
                        </div>
                        <h2>Preferencias generales</h2>
                        <p>Elegí tu idioma, moneda y zona horaria.</p>
                    </article>
                </a>
                <a href="{{url('configuracion-privacidad')}}" class="card_style_panel">
                    <article>
                        <div class="icono">
                            <img src="{{url('recursos/front2021/iconos_panel/privacidad.svg')}}" alt="privacidad">
                            <span><span class="icon-config"></span>Editar</span>
                        </div>
                        <h2>Privacidad</h2>
                        <p>Verificá qué hacemos con tu datos.</p>
                    </article>
                </a>
                <a href="{{url('redes-sociales')}}" class="card_style_panel">
                    <article >
                        <div class="icono">
                            <img src="{{url('recursos/front2021/iconos_panel/conectar_cuentas.svg')}}" alt="conectar_cuentas">
                            <span><span class="icon-editar"></span>Editar</span>
                        </div> 
                        <h2>Conectar cuentas</h2>
                        <p>Lorem, ipsum dolor sit amet, consectetur adipisicing elit. Animi, quidem.</p>
                    </article>
                </a>
            </div>
        </div>
        <div class="resaltado_gris">
            <div class="contenedor link_bottom">
                <span>¿Necesitás desactivar tu cuenta?</span> <a href="{{url('desactivar-cuenta')}}">Hacelo acá</a>.
            </div>
        </div>
    </section>
@endsection
@section('footer')
    <script>

        if (document.getElementsByClassName("general_profile_msg")) {
            var get_general_msg = document.getElementsByClassName("general_profile_msg");
            for (var x = 0; x < get_general_msg.length; x++) {
                get_general_msg[x].numerito = x;
                var get_close_modal = get_general_msg[x].getElementsByClassName("cerrar")[0];
                get_close_modal.onclick = function () {
                    close(this.parentNode.parentNode.parentNode);
                }
            }
        }
    </script>
@endsection
