@extends('orsai-template')

@section('title', 'Participantes')

@section('content')
    <section id="intro" class="contenedor intro_gral">
        <div>
            <span class="span_h1">Postulaciones</span>
            <h1 class="span_h2">Estas son todas las postulaciones que tenemos hasta la fecha.</h1>
        </div>
        <div class="lets_start">
            <a href="{{url('bases-concurso')}}" class="resaltado_amarillo">Presentar mi propuesta &raquo;</a>
        </div>
        <div>
            <span class="span_h2"><strong class="post">{{$totalCpas}}</strong> postulaciones presentadas / <strong
                    class="fich">{{$totalSupply}}</strong> fichas en juego</span>
        </div>
    </section>
    @if($totalCpas > 0)
        <section id="catalogo_logos" class="contenedor">
            <div class="cont_cat_partipantes">
                <div class="cat_partipantes">
                    <div id="ordenar">
                    <span class="ordenar_bt">Ordenar <span
                            class="icon-angle-down resaltado_amarillo"></span></span>
                    </div>
                    <ul class="">
                        <li id="random"
                            {{($orden == null)? "class=activo":""}} onclick="goto('random');">
                            <span class="subrayado">Random</span>
                        </li>
                        <li id="mas_votado"
                            onclick="goto('mas_votado');" {{($orden == "mas-votados")? "class=activo":""}}><span
                                class="subrayado">Más votados</span></li>
                        <li id="mas_visto"
                            onclick="goto('mas_visto')" {{($orden == "mas-vistos")? "class=activo":""}}>
                            <span class="subrayado">Más vistos</span>
                        </li>
                        <li id="mas_reciente"
                            onclick="goto('mas_reciente')" {{($orden == "mas-recientes")? "class=activo":""}}><span
                                class="subrayado">Más recientes</span></li>
                    </ul>
                </div>
                <div class="cont_busqueda">
                    <form action="{{url('participantes/buscar')}}" method="GET">
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

            <div id="add_content" class="contenedor_logos_participantes">

                @include('propuestas', ["propuestas" => $propuestas])

            </div>

            <div id="cargar_mas">
                <ul class="pagination">
                    @if($previous_page > 0)
                        <li class="page-item"><a class="page-link"
                                                 href="{{url("participantes/pagina/{$previous_page}/{$orden}")}}"><</a>
                        </li>
                    @endif
                    @for($i=1;$i<=$totalPages;$i++)
                        @if($i == $current_page)
                            <li class="page-item"><strong>{{$i}}</strong></li>
                        @else
                            <li class="page-item"><a class="page-link"
                                                     href="{{url("participantes/pagina/{$i}/{$orden}")}}">{{$i}}</a>
                            </li>
                        @endif
                    @endfor
                    @if($next_page > $current_page)
                        <li class="page-item"><a class="page-link"
                                                 href="{{url("participantes/pagina/{$next_page}/{$orden}")}}">></a></li>
                    @endif
                </ul>
                {{--            <span class="resaltado_amarillo subrayado">Cargar más</span>--}}
                {{--            <span class="gris no_hay_logos" style="display: none;">No hay más logos para cargar</span>--}}
            </div>
        </section>

    @else
        <section id="catalogo_logos" class="contenedor no_iniciado">
            <div class="cont_cat_partipantes">
                <div class="cat_partipantes">
                    <p>El concurso todavía no comenzó.</p>
                </div>
            </div>
        </section>
    @endif
    <div class="contenedor mg_100 number_page">
        {{--        <span>1</span>--}}
    </div>
@endsection

@section('footer')
    <script>
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
                    window.location = '{{url('participantes/mas-votados')}}';
                    break;
                case "mas_visto":
                    window.location = '{{url('participantes/mas-vistos')}}';
                    break;
                case "mas_reciente":
                    window.location = '{{url('participantes/mas-recientes')}}';
                    break;
                case "random":
                    window.location = '{{url('participantes/random')}}';
                    break;
                default:
                    window.location = '{{url('participantes')}}';
                    break;
            }
        }

        const limit = 8;
        let offset = 8;
        let noMore = 0;
        const orden = "{{$orden}}";

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
