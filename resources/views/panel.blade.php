@extends('orsai-template')


@section('content')
    <section id="intro" class="contenedor intro_gral panel">
        <div class="user_prop">
            <div id="user_img">
                <img src="{{$avatar}}"
                     alt="{{'@'.ucfirst($username)}}">
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
        @if($hasStarted && $emailWasValidated)
            <div class="lets_start_panel ">
                <a href="{{url('participantes')}}" class="resaltado_amarillo">Empezá a poner fichas &raquo;</a>
            </div>
        @endif
    </section>
    <section id="panel_user_info" class="contenedor">
        <a href="{{url('perfil')}}" class="box_panel">
            <div>
                <span>Información Personal</span>
            </div>
            <div>
                <span>Queremos saber más de vos. Completá tu perfil para obtener más fichas gratis.</span>
            </div>
            <div>
                <span href="{{url('perfil')}}" class="subrayado resaltado_amarillo">Editar</span>
            </div>
        </a>

        @if(!$endUploadAppDate)
            @if($postulacion['status']=="draft" || $postulacion['id']==0)
                <a href="{{url('postulacion')}}" class="box_panel">
                    @else
                        <a href="{{url('propuesta/'.$postulacion['id'])}}" class="box_panel">
                            @endif
                            @else
                                <div class="box_panel">
                                    @endif
                                    <div>
                                        <span>Mis postulaciones</span>
                                    </div>
                                    <div>
                                        @if($endUploadAppDate)
                                            <span class="text_bold">¡Ups llegaste tarde! La etapa de postulación ha finalizado</span>
                                        @else
                                            @if($postulacion['id'] == 0)
                                                <span class="text_bold">Si querés participar del Concurso de Logos subí una propuesta con todos los detalles necesarios.</span>
                                            @else
                                                @if($postulacion['id'] > 0)
                                                    <span class="text_bold">
                                                        Tienes una postulación en estado
                                                            @switch($postulacion['status'])
                                                            @case("approved")
                                                            <strong
                                                                class="resaltado_verde">{{__("status_application.{$postulacion['status']}")}}</strong>
                                                            @break
                                                            @case("draft")
                                                            <strong
                                                                class="resaltado_rojo">{{__("status_application.{$postulacion['status']}")}}</strong>
                                                            @break
                                                            @case("sent")
                                                            <strong
                                                                class="resaltado_rojo">{{__("status_application.{$postulacion['status']}")}}</strong>
                                                            @break
                                                        @endswitch
                                                    </span>
                                                @endif
                                            @endif
                                        @endif

                                    </div>
                                    <div>
                                        @if($endUploadAppDate)
                                            <br>
                                        @else
                                            @if($postulacion['id'] == 0)
                                                <span href="{{url('postulacion')}}"
                                                      class="subrayado resaltado_amarillo">Enviar</span>
                                            @else
                                                @if($postulacion['status'] == "draft")
                                                    <span href="{{url('postulacion')}}"
                                                          class="subrayado resaltado_amarillo">Modificar</span>
                                                @else
                                                    <span href="{{url('propuesta/'.$postulacion['id'])}}"
                                                          class="subrayado resaltado_amarillo">Ver</span>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                    @if(!$endUploadAppDate)
                                    @else
                                </div>
                            @endif
                            <a href="{{url('transacciones')}}" class="box_panel">
                                <div>
                                    <span>Mis fichas</span>
                                </div>
                                <div>
                                    <span>Acá podés controlar el movimiento de tus fichas.</span>
                                </div>
                                <div>
                                    <span href="{{url('transacciones')}}"
                                          class="subrayado resaltado_amarillo">Ver</span>
                                </div>
                            </a>
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
                    <span>Necesitamos que confirmes el registro de tu correo electrónico.<br/>Revisá tu casilla y activá tu cuenta para recibir tus primeras fichas gratis.</span>
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
