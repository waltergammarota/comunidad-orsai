@extends('orsai-template')


@section('content')
    <section id="intro" class="contenedor intro_gral ">
        <div class="titulo">
            <span class="span_h1_extra_size">¡Uh!</span>
            <h1 class="texto_italica span_h2">No tienes permiso para estar aquí. Fúchila!!</h1>
            <span class="gris codigo_error">Código de error: 403</span>
        </div>
        <div class="error_links">
            <div><a href="{{url('registrarse')}}" class="subrayado resaltado_amarillo text_bold">Registrarme</a>
            </div>
            <div><a href="{{url('/')}}" class="subrayado resaltado_amarillo text_bold">Inicio</a>
            </div>
        </div>
    </section>

    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
    </div>
@endsection

@section('footer')

@endsection

