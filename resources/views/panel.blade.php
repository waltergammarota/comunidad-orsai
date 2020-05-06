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
                <a href="{{url('participantes')}}" class="">Empezá a poner fichas &raquo;</a>
            </div>
        @endif
    </section>
    <section id="panel_user_info" class="contenedor">
        <a href="{{url('perfil')}}" class="box_panel">
            <div>
                <span>Información Personal</span>
            </div>
            <div>
                <span>Proporciona tus datos personales e indicanos cómo podemos ponernos en contacto con vos.</span>
            </div>
            <div>
                <span href="{{url('perfil')}}" class="subrayado resaltado_amarillo">Editar</span>
            </div>
        </a>
        <a 
            @if($postulacion['status'] == "draft" || $postulacion['id'] == 0) 
                href="{{url('postulacion')}}" 
            @else 
                href="{{url('propuesta/'.$postulacion['id'])}}" 
            @endif 
            class="box_panel"> 
            <div>
                <span>Estado de postulación</span>
            </div>
            <div>
                @if($postulacion['id'] == 0)
                    <span class="text_bold">Podés editar tu propuesta de logo y sus características aquí.</span>
                @endif
                @if($postulacion['id'] > 0)
                    <span class="text_bold">
                        Tienes una postulación en estado {{__("status_application.{$postulacion['status']}")}}
                    </span>
                @endif
            </div>
            <div>
                @if($postulacion['status'] == "draft" || $postulacion['id'] == 0)
                    <span href="{{url('postulacion')}}"
                       class="subrayado resaltado_amarillo">Enviar</span>
                @else
                    <span href="{{url('propuesta/'.$postulacion['id'])}}"
                       class="subrayado resaltado_amarillo">Ver</span>
                @endif
            </div>
        </a>
        <a href="{{url('transacciones')}}"  class="box_panel">
            <div>
                <span>Transacciones de créditos</span>
            </div>
            <div>
                <span>Tenes <strong>{{$cantidadTxs}}</strong> transacciones realizadas.</span>
            </div>
            <div>
                <span href="{{url('transacciones')}}" class="subrayado resaltado_amarillo">Ver</span>
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
    </script>
@endsection
