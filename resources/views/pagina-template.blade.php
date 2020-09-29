@extends('orsai-template')

@section('title', ucfirst($pagina->title)." | Comunidad Orsai")
@section('description',$pagina->copete)

@section('content')

    <section id="page" class="contenedor intro_gral ">
        <div class="cuerpo_texto">
            <div class="titulo tit_term">
                <h1 class="span_h1">{{$pagina->title}}</h1>
            </div>
            <div class="copete"><p>{{$pagina->copete}}</p></div>
            @php
                $image = $pagina->images()->first();
                $imageUrl = "";
                if($image) {
                $imageUrl = 'storage/images/'.$image->name.".".$image->extension;
                }
            @endphp
            <div class="img_noticia">
                @if($imageUrl)
                    <img src="{{url($imageUrl)}}" alt="{{$pagina->title}}">
                @endif
            </div> 
            <div class="texto">
                {!! $pagina->texto !!}
            </div>
        </div>
    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
@endsection

@section('footer')

@endsection
