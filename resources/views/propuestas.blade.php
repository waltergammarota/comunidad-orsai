@if(count($propuestas))
    @foreach($propuestas as $item)
        <div class="logo_particantes" data-votos="" data-vistos=""
             data-alta="">
            <a href="{{url('postulacion/'.$item['id'])}}">
                <div class="borde_logo">
                    <div class="logo_img">
                        @if(count($item['images']) > 0)
                            <img
                                src="{{url('storage/images/'.$item['images'][0]['name'].".".$item['images'][0]['extension'])}}"
                                alt="{{$item['images'][0]['name']}}">
                        @else
                            @if($concurso->image > 0)
                                <img
                                    src="{{url('storage/images/' . $concurso->logo()->name . "." . $concurso->logo()->extension)}}"
                                    alt="">
                            @else
                                <img src="{{url('img/img_blog.png')}}" alt="">
                            @endif
                        @endif
                    </div>
                    <div class="cont_autor">
                        <div class="autor">
                            <h2>{{Str::limit($item['title'], 20)}}</h2>
                            <h3>{{Str::limit($item['user'], 20)}}</h3>
                        </div>
                        <div class="img_autor">
                            @if($item['avatar'] != null)
                                <img
                                    src="{{url('storage/images/'.$item['avatar']['name'].'.'.$item['avatar']['extension'])}}"
                                    alt="{{Str::limit($item['user'], 20)}}">
                            @else
                                <img
                                    src="{{url('img/participantes/participante.jpg')}}"
                                    alt="{{Str::limit($item['user'], 20)}}">
                            @endif
                        </div>
                    </div>
                    <div class="votos_recibidos">
                        <h3>{{$item['votes']}} <span> Fichas acumuladas</span></h3>
                    </div>
                    <div class="ya_votado {{$item['voted'] > 0? "votado": ""}}">
                        <span class="icon-ok"></span>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
@endif
