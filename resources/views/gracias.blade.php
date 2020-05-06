@extends('orsai-template')


@section('content')
    <section id="intro" class="contenedor intro_gral">
        <div>
            <span class="span_h1">Gracias por tu propuesta.</span>
            <h1 class="span_h2">Vamos a verificar que cumpla con los requisitos y nos ponemos en contacto.</h1>
        </div>
        <div class="line_dashed"></div> 
        <div class="lets_start resaltado_amarillo">
            <a href="{{url('participantes')}}" class="">Empezá a poner fichas &raquo;</a>
        </div>
    </section>
 
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
@endsection

@section('footer')

@endsection

