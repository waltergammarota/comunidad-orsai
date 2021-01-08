@extends('2021-orsai-template')

@section('title', ucfirst($pagina->title)." | Comunidad Orsai")
@section('description',$pagina->copete)

@section('content')
<section class="resaltado_gris">
    <div class="contenedor_interna">
        <div class="titulo_interna">
            <h1>{{$pagina->title}}</h1>
        </div>
        <div class="cuerpo_interna">
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
            <div class="copete">{!! $pagina->copete !!}</div>
            <div class="texto">
                {!! $pagina->texto !!}
            </div>
        </div>
    </div>
</section>
@endsection 
@section('footer') 
@endsection 