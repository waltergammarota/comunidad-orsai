@extends('orsai-template')

@section('title', 'Participantes')
@section('description', 'Participá de los concursos y convertite en un apostador serial de proyectos culturales.')

@section('content')
    <section id="intro" class="contenedor intro_gral">
        <div>
            @if($isContestFinished )
                <span class="concurso_finalizado resaltado_gris">Concurso finalizado.</span>
            @endif
            <h1 class="span_h1">Concurso de logo Fundación Orsai</h1>
            @if($hasWinner )
                <a href="{{url('concurso/ganador/1')}}" class="ver_ganador resaltado_amarillo">Ver Ganador &raquo;</a>
            @else
                <p class="span_h2">Estas son todas las postulaciones, hay tiempo de ponerle fichas hasta el miércoles 28
                    de
                    octubre al mediodía de Argentina.</p>
            @endif
        </div>
        <div class="lets_end">
            <a href="{{url('bases-concurso')}}" class="resaltado_gris">Ver Bases del concurso &raquo;</a>
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
                            {{($orden == null || $orden == 'random')? "class=activo":""}} onclick="goto('random');">
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
                    window.location = '{{url('aarticipantes/mas-votados')}}';
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

        const limit = 20;
        let offset = 20;
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

        /*
        $(window).scroll(function() {
          if ($(window).scrollTop() >= $(document).height() - $(window).height() - 600) {
            getMore();
          }
        });

        $(window).scroll(function() {

          if ($(window).scrollTop() >= $(document).height() - $(window).height() - 600) {

            if (cant_agrega >= 3 || cant_agrega == "no hay mas") {
                if (!document.getElementsByClassName("no_hay_logos")[0]) {
                    var get_cargar_mas = document.getElementById("cargar_mas");
                    var no_hay_mas = document.createElement("span");
                    no_hay_mas.innerHTML = "No hay más logos para cargar";
                    no_hay_mas.classList.add("gris", "no_hay_logos");
                    $(get_cargar_mas).append(no_hay_mas);
                    $(no_hay_mas).fadeIn(1000).css("display", "block");
                }
            }else{
            cant_agrega++;
            $(".p_op").fadeIn(1000).css("display", "inline-block");

            $('#add_content').append('');
            }
          }
        });*/

    </script>
@endsection
