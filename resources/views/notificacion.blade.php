@extends('orsai-template')

@section('title', 'Notificación | Comunidad Orsai')
@section('description', 'Notificación')

@section('content')
    <section id="novedad" class="contenedor intro_gral ">
        <div class="info_per_breadcrumb">
            <div class="breadcrumbs">
                <div id="links_back">
                    <a href="{{url('notificaciones')}}">Notificaciones</a>
                    <span>Notificación</span>
                </div>
            </div>
        </div>
        <div class="cuerpo_texto texto_noticia">
            <div class="titulo">
                <h1 class="span_h1">{{$notification['title']}}</h1>
                <span class="autor gris span_block">{{$autor}}
                    <span
                        class="fecha_nota">{{ date('j/m/Y G:i', strtotime($notification['deliver_time'])) }} HS.</span></span>
            </div> 
            <div class="texto">{!!$notification['description']!!}</div>
            @if($notification['button_url'] != '')
                <div id="boton_submit">
                    <a href="{{url($notification['button_url']? $notification['button_url']: '' )}}"
                       class="ver_perfil">{{$notification['button_text']}}</a>
                </div>
            @endif
        </div>

    </section>

    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
    </section>

@endsection

@section('footer')

@endsection
