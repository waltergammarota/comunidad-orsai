@if(count($propuestas))
        @foreach($propuestas as $item)
            <div class="logo_particantes" data-votos="" data-vistos=""
                 data-alta="">
                <a href="{{url('propuesta/'.$item['id'])}}">
                    <div class="borde_logo">
                        <div class="logo_img">
                            <img
                                src="{{url('storage/logo/'.$item['logos'][0]['name'].".".$item['logos'][0]['extension'])}}"
                                alt="">
                        </div>
                        <div class="cont_autor">
                            <div class="autor">
                                <h2>{{Str::limit($item['title'], 20)}}</h2>
                                <h3>{{Str::limit($item['user'], 20)}}</h3>
                            </div>
                            <div class="img_autor">
                                @if($item['avatar'] != null)
                                    <img
                                        src="{{$item['avatar']}}"
                                        alt="">
                                @else
                                    <img
                                        src="{{url('img/participantes/usuario.png')}}"
                                        alt="">
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
