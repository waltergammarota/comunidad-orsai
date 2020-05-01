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
                <a href="{{url('perfil')}}"
                   class="subrayado resaltado_amarillo">Editar</a>
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
                @if($postulacion['status'] == "draft" || $postulacion['id'] == 0)
                    <a href="{{url('postulacion')}}"
                       class="subrayado resaltado_amarillo">Enviar</a>
                    @else
                    <a href="{{url('propuesta/'.$postulacion['id'])}}"
                       class="subrayado resaltado_amarillo">Ver</a>
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
                <a href="{{url('transacciones')}}" class="subrayado resaltado_amarillo">Ver</a>
            </div>
        </div>
    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>

    <div id="acred_fichas_modal" class="popup">
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

@endsection
