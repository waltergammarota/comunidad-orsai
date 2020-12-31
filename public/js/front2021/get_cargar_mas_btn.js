get_cargar_mas_btn.onclick = function() {
    var agarra_estructura = get_logo_gral;
    console.log("seba");
    //es importante que al crear la estructura de la grilla, los elementos que se agregan con el tocar mas que tienen la clase "logo_particantes" deben sumarle la clase "p_op" quedando "logo_particantes p_op" para el efecto fadein()
    var estructura = '<div class="logo_particantes p_op" data-votos="100" data-vistos="10" data-alta="01/02/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/participantes.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>' + '<div class="logo_particantes p_op" data-votos="18" data-vistos="5" data-alta="01/03/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/participantes.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>' + '<div class="logo_particantes p_op" data-votos="120" data-vistos="13" data-alta="06/02/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/participantes.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>' + '<div class="logo_particantes p_op" data-votos="120" data-vistos="13" data-alta="06/02/2020"><a href="#"><div class="borde_logo"><div class="logo_img"><img src="img/logos_participantes/participantes.png" alt="Logo Participante"></div><div class="cont_autor"><div class="autor"><h2>Titulo propuesta</h2><h3>Nombre de usuario</h3></div><div class="img_autor"><img src="img/participantes/usuario.png" alt="Usuario pepito"></div></div><div class="votos_recibidos"><h3>100<span> Fichas acumuladas</span></h3></div></div></a></div>';
    //esta variable "cant_agrega" hay q borrar, la utilizo solo para la maqueta, para mostrar el estado no hay mas logos
    if (cant_agrega >= 3 || cant_agrega == "no hay mas") {
        if (!document.getElementsByClassName("no_hay_logos")[0]) {
            var no_hay_mas = document.createElement("span");
            no_hay_mas.innerHTML = "No hay más logos para cargar";
            no_hay_mas.classList.add("gris", "no_hay_logos");
            $(get_cargar_mas).append(no_hay_mas);
            $(no_hay_mas).fadeIn(1000).css("display", "block");
        }
    } else {
        $(agarra_estructura).append(estructura);
        $(".p_op").fadeIn(1000).css("display", "inline-block");
    }
    cant_agrega++;
}