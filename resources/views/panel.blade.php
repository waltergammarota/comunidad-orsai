@extends('orsai-template')


@section('content')
    <section id="intro" class="contenedor intro_gral panel">
        <div class="user_prop">
            <div id="user_img">
                <img src="img/participantes/participante.jpg"
                     alt="Imagen usuario">
            </div>
            <div id="user_alias">
                <h1>{{'@'.ucfirst($username)}}</h1>
            </div>
            <div id="user_fichas">
                <span>{{$balance}}</span>
                <span>Fichas <span class="span_block">para jugar</span></span>
            </div>
        </div>
        <div class="line_dashed"></div>
        @if($hasStarted)
            <div class="lets_start resaltado_amarillo">
                @if(Auth::user()->email_verified_at == null)
                    <a href="{{url('panel')}}" class="">Empezá a poner fichas &raquo;</a>
                @else
                    <a href="{{url('participantes')}}" class="">Empezá a poner fichas &raquo;</a>
                @endif
            </div>
        @endif
    </section>
    <section id="panel_user_info" class="contenedor">
        <div class="box_panel">
            <div>
                <span>Información Personal</span>
            </div>
            <div>
                <span>Proporciona tus datos personales e indicanos cómo podemos ponernos en contacto con vos.</span>
            </div>
            <div>
                @if(Auth::user()->email_verified_at != null)
                    <a href="{{url('perfil')}}"
                       class="subrayado resaltado_amarillo">Editar</a>
                @endif
            </div>
        </div>
        <div class="box_panel">
            <div>
                <span>Estado de postulación</span>
            </div>
            <div>
                @if($postulacion['id'] == 0)
                    <span class="text_bold">No enviada</span>
                @endif
                @if($postulacion['id'] > 0)
                    <span class="text_bold">
                        Tienes una postulación en estado {{__("status_application.{$postulacion['status']}")}}
                    </span>
                @endif
            </div>
            <div>
                @if(Auth::user()->email_verified_at != null)
                    @if($postulacion['status'] == "draft" || $postulacion['id'] == 0)
                        <a href="{{url('postulacion')}}"
                           class="subrayado resaltado_amarillo">Enviar</a>
                    @else
                        <a href="{{url('propuesta/'.$postulacion['id'])}}"
                           class="subrayado resaltado_amarillo">Ver</a>
                    @endif
                @endif
            </div>
        </div>
        <div class="box_panel">
            <div>
                <span>Transacciones de créditos</span>
            </div>
            <div>
                <span>Tenes <strong>{{$cantidadTxs}}</strong> transacciones realizadas.</span>
            </div>
            <div>
                @if(Auth::user()->email_verified_at != null)
                    <a href="{{url('transacciones')}}" class="subrayado resaltado_amarillo">Ver</a>
                @endif
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
                    <span>Te falta validar el mail.</span>
                </div>
                <div class="cerrar">
                    <span>X</span>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('footer')
    <script>

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
