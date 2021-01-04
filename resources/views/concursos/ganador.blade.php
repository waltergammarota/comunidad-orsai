@extends('orsai-template')

@section('title', 'Concurso finalizado | Comunidad Orsai')
@section('description', 'Concurso Logo finalizado')
@section('header')
    <link rel="stylesheet" href="{{url('estilos/estilos_conc.css')}}">
@endsection

@section('content')
    <section id="intro" class="contenedor intro_gral">
        <div class="portada_concurso etiqueta_finalizado">
            @if($logo)
                <img src="{{url('storage/images/'.$logo->name.".".$logo->extension)}}" alt="">
            @else
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
        </div>
        <div class="lets_end">
            @if($bases)
                <a href="{{url($bases->slug)}}" class="resaltado_gris">Ver Bases del concurso &raquo;</a>
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
                        @foreach($ganadores as $postulacion)
                            <div class="contenedor_gris_claro">
                                <div class="tit_post_ganadora">
                                    <p class="titulo">{{$postulacion->title}}</p>
                                </div>
                                <div class="ganador_datos">
                                    <div id="user_img">
                                        @if($postulacion->hasAvatar())
                                            <img src="{{$postulacion->owner->getAvatarLink()}}"
                                                 alt="Imagen usuario">
                                        @else
                                            <img src="{{$postulacion->owner->getAvatarLink()}}"
                                                 alt="Imagen usuario">
                                        @endif
                                    </div>
                                    <div id="user_alias">
                                        <span class="">{{$postulacion->owner()->first()->userName}}</span>
                                    </div>
                                    <div id="fichas_asignadas">
                                        <div>
                                            <span class="fichas_finales">Premio:</span>
                                            <span>USD 2000</span>
                                        </div>
                                        <div>
                                            <span class="fichas_finales">203650</span>
                                            <span>Fichas recibidas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </a>
        </section>
    @endif
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
    </script>
@endsection
