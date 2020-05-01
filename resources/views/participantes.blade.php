@extends('orsai-template')


@section('content')
    <section id="intro" class="contenedor intro_gral">
        <div>
            <span class="span_h1">Participantes</span>
            <h1 class="span_h2">Lorem ipsum dolor sit amet, consectetuer
                adipiscing elit, sed diam nonummy nibh euismod tincidunt.</h1>
        </div>
        <div>
            <span class="span_h2"><strong class="post">{{$totalCpas}}</strong> postulaciones presentadas / <strong
                    class="fich">{{$totalSupply}}</strong> fichas en juego</span>
        </div>
    </section>

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
            <span class="resaltado_amarillo subrayado">Cargar más</span>
            <span class="gris no_hay_logos" style="display: none;">No hay más logos para cargar</span>
        </div>
    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
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

        $("#cargar_mas").click(()=> {
            getMore();
        })

        $(window).scroll(function () {


            if ($(document).height() - $(this).height() == $(this).scrollTop()) {
                if(noMore == 0) {
                    getMore();
                }
            }
        });
    </script>
@endsection
