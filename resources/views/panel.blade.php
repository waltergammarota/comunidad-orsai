@extends('orsai-template')

@section('title', 'Panel de Administración | Comunidad Orsai')
@section('description', 'Panel de Administración')

@section('content')

    <section id="intro" class="contenedor intro_gral panel">
        <div class="user_prop">
            <div id="user_img">
                <img src="{{$avatar}}"
                     alt="{{'@'.ucfirst($username)}}">
            </div>
            <div id="user_alias">
                <h1>{{'@'.ucfirst($username)}}</h1>
                <a href="{{url('perfil-usuario')}}/{{$session_user_id}}" class="ver_perfil">Ver perfil público</a>
            </div>
            <div id="user_fichas">
                <span>{{$balance}}</span>
                <span>Fichas</span>
            </div>
        </div>
        <div class="line_dashed"></div>
    </section>


    <section id="panel_user_info" class="contenedor">

        <div href="{{url('novedades')}}/sistema-de-fichas" class="box_panel_full">
            <div>
                <strong>Ya somos {{$totalusers}}</strong>
            </div>
            <div>
                <span>Los primeros 15.000 registrados serán llamados "socios fundadores".</span>
            </div>
            <div>
                <a href="{{url('novedades')}}/sistema-de-fichas" class="subrayado resaltado_amarillo">Saber más</a>
            </div>
        </div>

        <a href="{{url('perfil')}}" class="box_panel">
            <div>
                <span>Información Personal</span>
            </div>
            <div>
                <span>Queremos saber más de vos.</span>
            </div>
            <div>
                <span href="{{url('perfil')}}" class="subrayado resaltado_amarillo">Editar</span>
            </div>
        </a>
        @if($emailWasValidated)
            <a href="{{url('novedades')}}" class="box_panel">
                <div>
                    <span>Novedades</span>
                </div>
                <div>
                    <span>De qué se trata todo esto</span>
                </div>
                <div>
                <span href="{{url('novedades')}}"
                      class="subrayado resaltado_amarillo">Ver</span>
                </div>
            </a>
        @endif
        <a href="{{url('transacciones')}}" class="box_panel">
            <div>
                <span>Mis fichas</span>
            </div>
            <div>
                <span>Acá podés verificar los movimientos de tus fichas.</span>
            </div>
            <div>
                <span href="{{url('transacciones')}}"
                      class="subrayado resaltado_amarillo">Ver</span>
            </div>
        </a>

        <a href="{{url('configuracion-notificaciones')}}" class="box_panel">
            <div>
                <span>Notificaciones</span>
            </div>
            <div>
                <span>Configurá las preferencias de notificación.</span>
            </div>
            <div>
                <span href="{{url('configuracion-notificaciones')}}"
                      class="subrayado resaltado_amarillo">Configurar</span>
            </div>
        </a>

        <a href="{{url('configuracion-preferencias-generales')}}" class="box_panel">
            <div>
                <span>Preferencias generales</span>
            </div>
            <div>
                <span>Indicanos tu idioma, moneda y zona horaria.</span>
            </div>
            <div>
                <span href="{{url('configuracion-preferencias-generales')}}"
                      class="subrayado resaltado_amarillo">Configurar</span>
            </div>
        </a>

        <a href="{{url('configuracion-privacidad')}}" class="box_panel">
            <div>
                <span>Privacidad</span>
            </div>
            <div>
                <span>Verificá que hacemos con tus datos.</span>
            </div>
            <div>
                <span href="{{url('configuracion-privacidad')}}"
                      class="subrayado resaltado_amarillo">Configurar</span>
            </div>
        </a>

        <div class="desactive">
            <div>
                <span>¿Necesitás desactivar tu cuenta?</span>
            </div>
            <div>
                <a href="{{url('desactivar-cuenta')}}" class="subrayado resaltado_amarillo">Hacelo ahora</a>
            </div>
        </div>

    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>

    <div id="acred_fichas_modal" class="popup" style="display: none;">
        <div class="contenedor modal_fichas">
            <div>
                <div id="texto_err">
                    <span>Ya tenes disponibles <strong>{{$balance}}</strong> fichas</span>
                </div>
            </div>
        </div>
    </div>
    @if(Session::get('alert') == "activation_email" || Auth::user()->email_verified_at == null)
        <div class="general_profile_msg popup top_msg">
            <div class="contenedor msg_position_rel">
                <div id="texto_exito">
                    <span>Necesitamos que confirmes el registro. <br/>Revisá tu mail, y no olvides mirar en spam o promociones. Puede tardar algunos minutos.</span>
                </div>
                <div class="cerrar">
                    <span>X</span>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('footer')
    <script>/*
        const modal_fichas = $("#acred_fichas_modal");

        $(document).ready(() => {
            if (Cookies.get('available-points') != "true") {
                Cookies.set('available-points', true);
                modal_fichas.show();
            } else {
                modal_fichas.hide();
            }
        });

        modal_fichas.click(function () {
            modal_fichas.fadeOut('slow');
        })
        */

        if (document.getElementsByClassName("general_profile_msg")) {
            var get_general_msg = document.getElementsByClassName("general_profile_msg");
            for (var x = 0; x < get_general_msg.length; x++) {
                get_general_msg[x].numerito = x;
                var get_close_modal = get_general_msg[x].getElementsByClassName("cerrar")[0];
                get_close_modal.onclick = function () {
                    close(this.parentNode.parentNode);
                }
            }
        }
    </script>
@endsection
