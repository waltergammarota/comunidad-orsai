@extends('orsai-template')

@section('title', ucfirst($pagina->title)." | Fundación Orsai")
@section('description',$pagina->copete)

@section('content')

    <section id="intro" class="contenedor intro_gral ">
        <div class="titulo tit_term">
            <h1 class="span_h1">{{$pagina->title}}</h1>
            <p><strong>{{$pagina->copete}}</strong></p>
        </div>
        <div class="cuerpo_texto">
            {!! $pagina->texto !!}
        </div>
    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
@endsection

@section('footer')

@endsection
