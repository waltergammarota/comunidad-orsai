@extends('2021-orsai-template')

@section('title', 'Notificación | Comunidad Orsai')
@section('description', 'Notificación')

@section('content')

<section class="resaltado_gris pd_20 pd_20_tp_bt">
    <article class="contenedor_interna blog_articulo_completo">
            <div class="cuerpo_interna"> 
	            <div class="">
	                <h1 class="titulo_blog">{{$notification['title']}}</h1>
	                <p class="autor_texto">{{$autor}} - {{ date('j/m/Y G:i', strtotime($notification['deliver_time'])) }} HS.</span></p>
	            </div>
            <div class="blog_copete" style="margin:20px 0;"> 
          		{!!$notification['description']!!}
            </div>  
            @if($notification['button_url'] != '')
                <div id="boton_submit">
                    <a href="{{url($notification['button_url']? $notification['button_url']: '' )}}"
                       class="boton_redondeado resaltado_amarillo">{{$notification['button_text']}}</a>
                </div>
            @endif
        </div>
        <div class="form_ctrl input_" style="margin-top:20px;">
            <div class="align_left btn_noti_ico">
                <a href="{{url('notificaciones')}}" class="boton_redondeado btn_transparente"><span class="icon-angle-left"></span> Volver</a>
            </div>
        </div>
    </article> 
@endsection

@section('footer')

@endsection
