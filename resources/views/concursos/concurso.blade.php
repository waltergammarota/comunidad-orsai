@extends('orsai-template')

@section('title',  $concurso->name.' | Comunidad Orsai')
@section('description', $concurso->name)
@section('header')
    <link rel="stylesheet" href="{{url('estilos/estilos_conc.css')}}">
@endsection

@section('content')
    <section id="intro" class="contenedor intro_gral">
        @if($estado == "finalizado")
            <div class="portada_concurso etiqueta_finalizado">
                @elseif ($estado == "abierto" )
                    <div class="portada_concurso etiqueta_activo">
                        @else
                            <div class="portada_concurso etiqueta_proximamente">
                                @endif
                                @if($logo)
                                    <img src="{{url('storage/images/'.$logo->name.".".$logo->extension)}}" alt="">
                                @else
                                    // TODO CAMBIAR IMAGEN DEFAULT DE CONCURSO
                                    <img src="https://comunidadorsai.org/storage/images/15fc7e28ea8b2c.png" alt="">
                                @endif
                                <div class="caja_info_negra">
                                    <div>
                                        <span>Modo {{$concurso->getMode()->name}}</span>
                                    </div>
                                    <div>
                                        <span>Fecha de cierre: {{$concurso->end_date->format('d/m/Y H.i')}}hs (ARG)</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h1 class="span_h1">{{$concurso->name}}</h1>
                                @if($estado == "abierto")
                                    <h2 class="">{{$concurso->bajada_corta}}</h2>
                                    <a href="{{url('postulaciones/'.$concurso->id.'/'.$concurso->name)}}"
                                       class="ver_ganador resaltado_amarillo">Subir postulación &raquo;</a>
                                @endif
                            </div>
                            <div class="encabezado_descripcion_concurso">
                                @if($estado == "abierto" || $estado == "proximo")
                                    <p class="texto">{!!  $concurso->bajada_completa !!}</p>
                                @endif
                                <p class="titulo"><br>Tenés tiempo hasta
                                    el {{$concurso->end_app_date->isoFormat('dddd D \d\e MMMM \d\e\l Y \a \l\a\s hh:mm')}}
                                    hs(ARG).</p>
                            </div>
                            <div class="lets_end">
                                @if($bases)
                                    <a href="{{url($bases->slug)}}" class="resaltado_gris">Ver Bases del concurso
                                        &raquo;</a>
                                @endif
                            </div>
                            <div>
            <span class="span_h2"><strong
                    class="post">{{$cantidadPostulaciones}}</strong> postulaciones presentadas / <strong
                    class="fich">{{$cantidadFichasEnJuego}}</strong> de fichas en juego</span>
                            </div>
    </section>

    @if($estado == "finalizado")
        <section class="contenedor modulo_2_ganador">
            <a href="#" class="link_ganador">
                <div class="tabla_ganador">
                    <div class="contenedor_gris">
                        <div class="encabezado_descripcion_concurso">
                            <p class="titulo">Resultado final</p>
                        </div>
                        <div class="contenedor_gris_claro">
                            @foreach($ganadores as $postulacion)
                                <div class="tit_post_ganadora">
                                    <p class="titulo">{{$postulacion->title}}</p>
                                </div>
                                <div class="ganador_datos">
                                    <div id="user_img">
                                        @if($postulacion->owner->hasAvatar())
                                            <img src="{{$postulacion->owner->getAvatarLink()}}"
                                                 alt="Imagen usuario">
                                        @else
                                            <img src="{{url('img/participantes/participante.jpg')}}"
                                                 alt="Imagen usuario">
                                        @endif
                                    </div>
                                    <div id="user_alias">
                                        <span class="">{{$postulacion->owner()->first()->userName}}</span>
                                    </div>
                                    <div id="fichas_asignadas">
                                        @if($concurso->mode == 1)
                                            <div>
                                                <span class="fichas_finales">Premio:</span>
                                                <span>{{$postulacion->prize_percentage}}% de fichas acumuladas</span>
                                            </div>
                                            <div>
                                                <span class="fichas_finales">{{$postulacion->prize_amount}}</span>
                                                <span>Fichas recibidas</span>
                                            </div>
                                        @elseif($concurso->mode == 2)
                                            <div>
                                                <span class="fichas_finales">Propuesta financiada</span>
                                            </div>
                                            <div>
                                                <span class="fichas_finales">{{$postulacion->votes}}</span>
                                                <span>Fichas recibidas</span>
                                            </div>
                                        @elseif($concurso->mode == 3)
                                            <div>
                                                <span class="fichas_finales">Premio:</span>
                                                <span>USD {{$postulacion->prize_amount}}</span>
                                            </div>
                                            <div>
                                                <span class="fichas_finales">{{$postulacion->votes}}</span>
                                                <span>Fichas recibidas</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </a>
        </section>
    @endif

    @include('concursos.participantes', $participantes)
@endsection

@section('footer')
    <script>
        $(".contenedor_concursos").fadeIn(600).css("display", "inline-block");

        if (document.getElementById("ordenar")) {
            var get_ordenar = document.getElementById("ordenar");
            get_ordenar.onclick = function () {
                var get_icon = get_ordenar.getElementsByClassName("ordenar_bt")[0].getElementsByTagName("span")[0];
                var get_lista_orden = document.getElementsByClassName("buscador_links_filtros")[0].getElementsByTagName("ul")[0];
                if (get_lista_orden.classList.contains("orden_abierto")) {
                    get_icon.classList.remove("icon-angle-up");
                    get_icon.classList.add("icon-angle-down");
                    get_lista_orden.classList.remove("orden_abierto");
                } else {
                    get_icon.classList.remove("icon-angle-down");
                    get_icon.classList.add("icon-angle-up");
                    get_lista_orden.classList.add("orden_abierto");
                }
            }
        }

        function goTo(location, filtro) {
            let busqueda = "";
            if (filtro != null && filtro != "") {
                busqueda = `&busqueda=${filtro}`
            }
            window.location = `{{url('concursos?filtro=')}}${location}${busqueda}`;
        }

        $({Counter: 0}).animate({
            Counter: $('.post').text()
        }, {
            duration: 1000,
            easing: 'swing',
            step: function () {
                $('.post').text(Math.ceil(this.Counter));
            }
        });
        $({Counter: 0}).animate({
            Counter: $('.fich').text()
        }, {
            duration: 1000,
            easing: 'swing',
            step: function () {
                $('.fich').text(Math.ceil(this.Counter));
            }
        });

        var cant_agrega = 0;

        function goto(location) {
            switch (location) {
                case "mas_votado":
                    window.location = '{{url($contest_url.'/mas-votados')}}';
                    break;
                case "mas_visto":
                    window.location = '{{url($contest_url.'/mas-vistos')}}';
                    break;
                case "mas_reciente":
                    window.location = '{{url($contest_url.'/mas-recientes')}}';
                    break;
                case "random":
                    window.location = '{{url($contest_url.'/random')}}';
                    break;
                default:
                    window.location = '{{url($contest_url)}}';
                    break;
            }
        }

        const limit = 20;
        let offset = 20;
        let noMore = 0;
        const orden = "{{$participantes['orden']}}";

        function getMore() {
            const url = '{{url('/participantes')}}';
            $.get(`${url}/${orden}/${limit}/${offset}`, function (data) {
                const item = $(data).hide().fadeIn(400);
                $("#add_content").append(item);
                if (data == "") {
                    noMore = 1;
                    $(".no_hay_logos").fadeIn(600).css("display", "block");
                } else {
                    offset = offset + limit;
                }
            });
        }
    </script>
@endsection
