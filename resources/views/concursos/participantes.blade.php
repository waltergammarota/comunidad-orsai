@if($cantidadPostulaciones > 0)
    <section id="catalogo_concursos" class="contenedor">
        <div class="buscador">
            <div class="buscador_links_filtros">
                <div id="ordenar">
                    <span class="ordenar_bt">Ordenar <span
                            class="icon-angle-down resaltado_amarillo"></span></span>
                </div>
                <ul class="">
                    <li id="random"
                        {{($orden == null || $orden == 'random')? "class=activo":""}} onclick="goto('random');">
                        <a class="subrayado">Random</a>
                    </li>
                    <li id="mas_votado"
                        onclick="goto('mas_votado');" {{($orden == "mas-votados")? "class=activo":""}}>
                        <a class="subrayado">Más votados</a></li>
                    <li id="mas_visto"
                        onclick="goto('mas_visto')" {{($orden == "mas-vistos")? "class=activo":""}}>
                        <a class="subrayado">Más vistos</a>
                    </li>
                    <li id="mas_reciente"
                        onclick="goto('mas_reciente')" {{($orden == "mas-recientes")? "class=activo":""}}>
                        <a class="subrayado">Más recientes</a></li>
                </ul>
                <div class="cont_busqueda">
                    <form action="{{url($contest_url.'/buscar')}}" method="GET">
                        <div class="in_bu">
                            <input type="search" name="busqueda"
                                   placeholder="Buscar" value="{{$busqueda}}">
                        </div>
                        <div class="bt_bu">
                            <button><span class="icon-search"></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="add_content" class="contenedor_logos_participantes">

            @include('propuestas', ["propuestas" => $propuestas, "concurso" => $concurso])

        </div>

        <div id="cargar_mas">
        </div>
    </section>

    <div class="paginador">
        @if($current_page > 1)
            <a href="{{url($contest_url.'/'.$orden.'?page='.($current_page - 1))}}"
               class="icon-angle-left page_arrow"></a>
        @endif
        @for($page = 1; $page <= $totalPages; $page++)
            <a href="{{url($contest_url.'/'.$orden.'?page='.($page))}}"
               @if($page == $current_page)class="activo"@endif>{{$page}}</a>
        @endfor
        @if($current_page < $totalPages)
            <a href="{{url($contest_url.'/'.$orden.'?page='.($current_page + 1))}}"
               class="icon-angle-right page_arrow"></a>
        @endif
    </div>

@endif
<div class="contenedor mg_100 number_page"></div>

