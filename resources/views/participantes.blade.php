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
                    <li id="random" class="activo"><span class="subrayado">Random</span>
                    </li>
                    <li id="mas_votado"><span
                            class="subrayado">Más votados</span></li>
                    <li id="mas_visto"><span class="subrayado">Más vistos</span>
                    </li>
                    <li id="mas_reciente"><span
                            class="subrayado">Más recientes</span></li>
                </ul>
            </div>
            <div class="cont_busqueda">
                <form action="#">
                    <div class="in_bu">
                        <input type="search" name="busqueda"
                               placeholder="Buscar">
                    </div>
                    <div class="bt_bu">
                        <button><span class="icon-search"></span></button>
                    </div>
                </form>
            </div>
        </div>


        <div id="add_content" class="contenedor_logos_participantes">
            <div class="logo_particantes" data-votos="" data-vistos=""
                 data-alta="">
                <a href="#">
                    <div class="borde_logo">
                        <div class="logo_img">
                            <img src="#" alt="">
                        </div>
                        <div class="cont_autor">
                            <div class="autor">
                                <h2></h2>
                                <h3></h3>
                            </div>
                            <div class="img_autor">
                                <img src="" alt="">
                            </div>
                        </div>
                        <div class="votos_recibidos">
                            <h3></h3>
                        </div>
                        <div class="ya_votado">
                            <span class="icon-ok"></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div id="cargar_mas">
            <span class="resaltado_amarillo subrayado">Cargar más</span>
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

        $(window).scroll(function () {

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
                } else {
                    cant_agrega++;
                    $(".p_op").fadeIn(1000).css("display", "inline-block");

                    $('#add_content').append('<div class="logo_particantes p_op" data-votos="100" data-vistos="10" data-alta="01/02/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/dos.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>' + '<div class="logo_particantes p_op" data-votos="18" data-vistos="5" data-alta="01/03/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/tres.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>' + '<div class="logo_particantes p_op" data-votos="120" data-vistos="13" data-alta="06/02/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/participantes.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>' + '<div class="logo_particantes p_op" data-votos="120" data-vistos="13" data-alta="06/02/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/uno.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>' + '<div class="logo_particantes p_op" data-votos="100" data-vistos="10" data-alta="01/02/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/dos.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>' + '<div class="logo_particantes p_op" data-votos="18" data-vistos="5" data-alta="01/03/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/tres.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>' + '<div class="logo_particantes p_op" data-votos="120" data-vistos="13" data-alta="06/02/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/participantes.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>' + '<div class="logo_particantes p_op" data-votos="120" data-vistos="13" data-alta="06/02/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/uno.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>' + '<div class="logo_particantes p_op" data-votos="100" data-vistos="10" data-alta="01/02/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/dos.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>' + '<div class="logo_particantes p_op" data-votos="18" data-vistos="5" data-alta="01/03/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/tres.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>' + '<div class="logo_particantes p_op" data-votos="120" data-vistos="13" data-alta="06/02/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/participantes.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>' + '<div class="logo_particantes p_op" data-votos="120" data-vistos="13" data-alta="06/02/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/uno.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>' + '<div class="logo_particantes p_op" data-votos="100" data-vistos="10" data-alta="01/02/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/dos.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>' + '<div class="logo_particantes p_op" data-votos="18" data-vistos="5" data-alta="01/03/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/tres.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>' + '<div class="logo_particantes p_op" data-votos="120" data-vistos="13" data-alta="06/02/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/participantes.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>' + '<div class="logo_particantes p_op" data-votos="120" data-vistos="13" data-alta="06/02/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/uno.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>');
                }
            }
        });
    </script>
@endsection
