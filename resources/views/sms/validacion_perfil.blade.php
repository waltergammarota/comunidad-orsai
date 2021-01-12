@extends('2021-orsai-template')

@section('title', 'Validación de perfil | Comunidad Orsai')
@section('description', 'Validación de perfil')

@section('content')
    <section id="sms"  class="resaltado_gris pd_20 pd_20_tp_bt">
        <article class="contenedor_interna blog_articulo_completo">
            <div class="cuerpo_interna">
                <div class="box_heading">
                    <h1 class="titulo_blog text_bold">VALIDACIÓN DE TU PERFIL</h1>
                    <p class="normal">Te enviaremos un código de seguridad por mensaje de texto al número de celular
                        asociado a tu perfil:<br/>
                        <strong>+{{$prefijo}} {{$whatsapp}}</strong>.
                        <a href="{{url('editar-telefono')}}" class="subrayado resaltado_amarillo">Editar</a>
                    </p>
                    <p class="subtitulogris">Es posible que se apliquen tarifas de mensajes y datos.</p>
                </div>
                <hr/>
                <div class="box_button">
                    <form action="{{url('validacion-codigo')}}" method="GET">
                        @csrf
                        <input type="hidden" name="enviar_codigo" value="1">
                        <button type="submit" class="boton_redondeado boton-largo resaltado_amarillo text_bold">Continuar
                        </button>
                    </form>
                </div>
                <div class="bottom_exit">
                    <a href="{{url('panel')}}">Ahora no</a>
                </div>
            </div>
            <div class="bottom_exit">
                <span>¿Necesitás ayuda?</span>
                <a class="gris" href="#">Escribinos</a>
            </div>
        </article>
    </section>
@endsection


@section('footer')
@endsection
