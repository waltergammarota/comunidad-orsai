@extends('orsai-template')

@section('title', 'Concurso finalizado | Comunidad Orsai')
@section('description', 'Concurso Logo finalizado')
@section('header')
    <link rel="stylesheet" href="{{url('estilos/estilos_conc.css')}}">
@endsection

@section('content')
    <section id="intro" class="contenedor intro_gral">
        <div>
            <h1 class="span_h1">Concursos</h1>
        </div>
    </section>
    <section id="catalogo_concursos" class="contenedor">
        <div class="buscador">
            <div class="buscador_links_filtros">
                <div id="ordenar">
                    <span class="ordenar_bt">Ordenar <span class="icon-angle-down resaltado_amarillo"></span></span>
                </div>
                <ul class="">
                    <li id="Todos" @if($filtro == "todos" || $filtro == null)class="activo"
                        @endif onclick="goTo('todos', '{{$busqueda}}')">
                        <a href="#" class="subrayado">Todos</a>
                    </li>
                    <li id="Vigentes" @if($filtro == "activos")class="activo"
                        @endif onclick="goTo('activos', '{{$busqueda}}')">
                        <a href="#" class="subrayado">Activos</a>
                    </li>
                    <li id="Próximamente" @if($filtro == "proximos")class="activo"
                        @endif onclick="goTo('proximos', '{{$busqueda}}')">
                        <a href="#"
                           class="subrayado">Próximos</a>
                    </li>
                    <li id="Finalizados" @if($filtro == "finalizados")class="activo"
                        @endif onclick="goTo('finalizados', '{{$busqueda}}')">
                        <a href="#" onclick="javascript:void(0);"
                           class="subrayado">Finalizados</a>
                    </li>
                </ul>
                <div class="cont_busqueda">
                    <form action="{{url('concursos')}}" method="GET">
                        <div class="in_bu">
                            <input type="search" name="busqueda" placeholder="¿Qué concurso buscás?" value="{{$busqueda}}">
                        </div>
                        <div class="bt_bu">
                            <button type="submit"><span class="icon-search"></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div id="add_content" class="contenedor_concursos">
            @foreach($concursos as $concurso)
                // TODO definir fechas de los estados
                @if($concurso->start_date > $now)
                    <div class="cont_concurso etiqueta_proximamente">
                        @elseif($concurso->end_date < $now)
                            <div class="cont_concurso etiqueta_finalizado">
                                @else
                                    <div class="cont_concurso">
                                        @endif
                                        <a href="{{url('concursos/'.$concurso->id.'/'.urlencode($concurso->name))}}">
                                            <div class="padding_item">
                                                <div class="portada_item">
                                                    @if($concurso->image > 0)
                                                        <img
                                                            src="{{url('storage/images/' . $concurso->logo()->name . "." . $concurso->logo()->extension)}}"
                                                            alt="">
                                                    @else
                                                        // TODO AGREGAR DEFAULT
                                                        <img src="http://lorempixel.com/400/900" alt="">
                                                    @endif
                                                </div>
                                                <div class="info_item bacground_gray_opacity">
                                                    <div class="texto_item">
                                                        <div class="titulo_item">
                                                            <h2>{{$concurso->name}}</h2>
                                                        </div>
                                                        <div class="descripcion_item">
                                                            <h3>{{$concurso->bajada_corta}}</h3>
                                                        </div>
                                                    </div>
                                                    <div class="button_item">
                                                        <span>Ver más</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                            </div>

                            <div class="paginador">
                                @if($pagina > 1)
                                    <a href="{{url($links[$pagina - 1])}}" class="icon-angle-left page_arrow"></a>
                                @endif
                                @for($page = 1; $page <= $totalPaginas; $page++)
                                    <a href="{{url($links[$page])}}"
                                       @if($page == $pagina)class="activo"@endif>{{$page}}</a>
                                @endfor
                                @if($pagina < $totalPaginas)
                                    <a href="{{url($links[$pagina + 1])}}" class="icon-angle-right page_arrow"></a>
                                @endif
                            </div>
    </section>
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
