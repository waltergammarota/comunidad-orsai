@extends('orsai-template')


@section('content')
    <section id="intro" class="contenedor intro_gral">
        <div class="grid_70">
            <span class="span_h1">{{$pagina->title}}</span>
            <h1>{{$pagina->copete}}</h1>
        </div>
    </section>

    <section class="contenedor">
        <div class="grid_70 mg_100">
            {!! $pagina->texto !!}
        </div>
    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
@endsection

@section('footer')

@endsection
