@extends('orsai-template')

@section('title', 'Página no encontrada | Comunidad Orsai')
@section('description', 'No encontramos la página que estas buscando.')


@section('content')
    <section id="intro" class="contenedor intro_gral ">
        <div class="titulo">
            <span class="span_h1_extra_size">¡Uh!</span>
            <h1 class="texto_italica span_h2">No encontramos la página que estas
                buscando.</h1>
            <span class="gris codigo_error">Código de error: 404</span>
        </div>
        <div class="error_links"> 
            <div><a href="{{url('/')}}" class="subrayado resaltado_amarillo text_bold">Ir al inicio</a>
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

