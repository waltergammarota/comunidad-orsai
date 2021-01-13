@extends('2021-orsai-template')

@section('title', 'Validación de perfil | Comunidad Orsai')
@section('description', 'Validación de perfil')

@section('content')
    <section id="sms" class="resaltado_gris pd_20 pd_20_tp_bt">
        <article class="contenedor_interna blog_articulo_completo">
            <div class="cuerpo_interna">
                <div class="box_heading">
                    <h1 class="titulo_blog text_bold">VALIDACIÓN DE TU PERFIL</h1>
                    @if($phone_verified_at != null)
                        <div class="alert alert-ok hide" id="yaValidado">
                            <div class="alert-content">
                                <span class="icon icon-check_circle"></span>
                                <p>Tu perfil ya está validado con el siguiente número de celular:<br/>
                                    <strong class="telefono">+{{$prefijo}} {{$whatsapp}}</strong>.</p>
                            </div>
                        </div>
                    @endif
                    @if($phone_verified_at == null)
                        <p class="normal">Te enviaremos un código de seguridad por mensaje de texto al número de celular
                            asociado a tu perfil:<br/>
                            <strong>+{{$prefijo}} {{$whatsapp}}</strong>.
                            <a href="{{url('editar-telefono')}}" class="subrayado resaltado_amarillo">Editar</a>
                        </p>
                    @else
                        <p class="normal">Si querés cambiar el télefono asociado a tu perfil, presioná en editar:<br/>
                            <strong>+{{$prefijo}} {{$whatsapp}}</strong>.
                            <a href="{{url('editar-telefono')}}" class="subrayado resaltado_amarillo">Editar</a>
                        </p>
                    @endif
                    <p class="subtitulogris">Es posible que se apliquen tarifas de mensajes y datos.</p>
                </div>
                <hr/>
                @if($phone_verified_at == null)
                    <div class="box_button">
                        <form action="{{url('validacion-codigo')}}" method="GET">
                            @csrf
                            <input type="hidden" name="enviar_codigo" value="1">
                            <button type="submit" class="boton_redondeado boton-largo resaltado_amarillo text_bold">
                                Continuar
                            </button>
                        </form>
                    </div>
                @endif
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
