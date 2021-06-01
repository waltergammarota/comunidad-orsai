(function() {
    /* In animations (to close icon) */
    var beginAC = 80,
        endAC = 320,
        beginB = 80,
        endB = 320;

    function inAC(s) {
        s.draw('80% - 240', '80%', 0.3, {
            delay: 0.1,
            callback: function() {
                inAC2(s)
            }
        });
    }

    function inAC2(s) {
        s.draw('100% - 545', '100% - 305', 0.6, {
            easing: ease.ease('elastic-out', 1, 0.3)
        });
    }

    function inB(s) {
        s.draw(beginB - 60, endB + 60, 0.1, {
            callback: function() {
                inB2(s)
            }
        });
    }

    function inB2(s) {
        s.draw(beginB + 120, endB - 120, 0.3, {
            easing: ease.ease('bounce-out', 1, 0.3)
        });
    }
    /* Out animations (to burger icon) */
    function outAC(s) {
        s.draw('90% - 240', '90%', 0.1, {
            easing: ease.ease('elastic-in', 1, 0.3),
            callback: function() {
                outAC2(s)
            }
        });
    }

    function outAC2(s) {
        s.draw('20% - 240', '20%', 0.3, {
            callback: function() {
                outAC3(s)
            }
        });
    }

    function outAC3(s) {
        s.draw(beginAC, endAC, 0.7, {
            easing: ease.ease('elastic-out', 1, 0.3)
        });
    }

    function outB(s) {
        s.draw(beginB, endB, 0.7, {
            delay: 0.1,
            easing: ease.ease('elastic-out', 2, 0.4)
        });
    }
    /* Awesome burger default */
    var toCloseIcon = true;
    /* Scale functions */
    function addScale(m) {
        m.className = 'menu-icon-wrapper scaled';
    }

    function removeScale(m) {
        m.className = 'menu-icon-wrapper';
    }
    /* Awesome burger scaled */
    var pathD = document.getElementById('pathD'),
        pathE = document.getElementById('pathE'),
        pathF = document.getElementById('pathF'),
        segmentD = new Segment(pathD, beginAC, endAC),
        segmentE = new Segment(pathE, beginB, endB),
        segmentF = new Segment(pathF, beginAC, endAC),
        wrapper2 = document.getElementById('menu-icon-wrapper2'),
        trigger2 = document.getElementById('menu-icon-trigger2'),
        toCloseIcon2 = true;
    wrapper2.style.visibility = 'visible';
    trigger2.onclick = function() {
        addScale(wrapper2);
        if (toCloseIcon2) {
            inAC(segmentD);
            inB(segmentE);
            inAC(segmentF);
        } else {
            outAC(segmentD);
            outB(segmentE);
            outAC(segmentF);
        }
        toCloseIcon2 = !toCloseIcon2;
        setTimeout(function() {
            removeScale(wrapper2)
        }, 450);
    };
})();
var open_des = document.getElementById("abrir");
var desplegable = document.getElementById("desplegable");
open_des.onclick = function() {
    if (desplegable.classList.contains('desplegable_cerrado')) {
        if (desplegable.classList.contains('desplegable_cerrado')) {
            desplegable.className = "desplegable_abierto";
        } else {
            desplegable.className = "desplegable_cerrado";
        }
    } else {
        desplegable.className = "desplegable_cerrado";
    }
}
if (document.getElementById("logo_lg")) {
    var propuesta_big = document.getElementById("logo_lg");
    var propuesta_activa = propuesta_big.getElementsByTagName("img");
    var propuesta_img = document.getElementById("logo_sm");
    var imagenes_click = propuesta_img.getElementsByTagName("img");
    for (var x = 0; x < imagenes_click.length; x++) {
        imagenes_click[x].numerito = x;
        imagenes_click[x].onclick = function() {
            var source_img = imagenes_click[this.numerito].src;
            imagenes_click[this.numerito].src = propuesta_activa[0].src;
            propuesta_activa[0].src = source_img;
        };
    }
}

function init() {
    var inputFile = document.getElementsByClassName("inputfile");
    for (var x = 0; x < inputFile.length; x++) {
        var posicion = x;
        inputFile[x].posicion = x;
        inputFile[x].addEventListener('change', mostrarImagen, false);
    }
}

function mostrarImagen(event) {
    var posicion = this.posicion;
    var fileName, fileExtension;
    fileName = event.target.files[0].name;
    fileExtension = fileName.replace(/^.*\./, '');
    var file = event.target.files[0];
    var reader = new FileReader();
    var get_id = this.id;
    reader.onload = function(event) {
        var box = document.getElementsByClassName("box");
        if (fileExtension != "pdf" && get_id != "file-7") {
            var imagen = box[posicion].getElementsByTagName("img");
            if (imagen[0] === undefined) {
                box[posicion].appendChild(document.createElement("img"));
            }
            var change_span = box[posicion].getElementsByTagName("span");
            if (get_id == "file-1") {
                change_span[0].innerHTML = "Cambiar Logo";
                var img = box[posicion].getElementsByTagName("img");
                img[0].src = event.target.result;
                // }
                // else if(get_id == "file-2"){
                //     change_span[0].innerHTML="+";
                //     var img = box[posicion].getElementsByTagName("img");
                //     img[0].src= event.target.result;
            } else if (get_id == "file-2" || get_id == "file-3" || get_id == "file-4" || get_id == "file-5" || get_id == "file-6") {
                var img = box[posicion].getElementsByTagName("img");
                img[0].src = event.target.result;
                change_span[0].innerHTML = "";
                var create_span = box[posicion].appendChild(document.createElement("span"));
                create_span.className = "icon-trash-empty";
                create_span.onclick = function() {
                    if (img.src != "") {
                        img[0].parentNode.removeChild(img[0]);
                        var get_algo = document.getElementById(get_id);
                        get_algo.value = "";
                        box[posicion].removeChild(create_span);
                        change_span[0].innerHTML = "+";
                    }
                }
            }
        } else {
            if (get_id == "file-7") {
                var change_span = box[posicion].getElementsByTagName("span");
                var addclass_label = box[posicion].getElementsByTagName("label");
                addclass_label[0].classList.add("seleccion");
                change_span[0].innerHTML = fileName;
                change_span[1].innerHTML = "";
                var create_span = box[posicion].appendChild(document.createElement("span"));
                create_span.className = "adj_span_del icon-trash-empty";
                create_span.onclick = function() {
                    var borrar_value = box[posicion].getElementsByTagName("input");
                    borrar_value[0].value = "";
                    change_span[0].innerHTML = "Adjuntar...";
                    box[posicion].removeChild(create_span);
                    addclass_label[0].classList.remove("seleccion");
                    change_span[1].innerHTML = "&#x0002B;";
                }
            }
        }
    }
    reader.readAsDataURL(file);
}
window.addEventListener('load', init, false);
var asq_form = document.getElementsByClassName("modal_asq");
var close_asq = document.getElementsByClassName("close_asq");
for (var x = 0; x < close_asq.length; x++) {
    close_asq[x].posicion = x;
    close_asq[x].onclick = function() {
        asq_form[this.posicion].classList.add("oculto");
    }
}
var ask_icon = document.getElementsByClassName("ask_icon");
for (var x = 0; x < ask_icon.length; x++) {
    ask_icon[x].posicion = x;
    ask_icon[x].onclick = function() {
        for (var i = 0; i < asq_form.length; i++) {
            if (!asq_form[i].classList.contains("oculto")) {
                asq_form[i].classList.add("oculto");
            }
        }
        asq_form[this.posicion].classList.remove("oculto");
    }
};

function open_modal(x) {
    document.body.style.overflow = "hidden";
    $(x).fadeIn();
}

function close(x) {/*
    document.body.style.overflowY = "scroll";*/
    document.body.style.overflowX = "hidden";
    if (x != undefined) {
        $(x).fadeOut();
    } else {
        $('.popup').fadeOut()
    }
}
var modal_image = document.getElementById("modal_image");
if (modal_image !== null) {
    var cerrar = modal_image.getElementsByClassName("cerrar");
    var logo_lg = document.getElementById("logo_lg");
    logo_lg.onclick = function() {
        open_modal(modal_image);
        var source = logo_lg.getElementsByTagName("img")[0];
        var sel_img = document.getElementById("img_amp");
        sel_img = sel_img.getElementsByTagName("img")[0];
        sel_img.src = source.src;
    };
    cerrar[0].onclick = function() {
        close(modal_image);
    }
    modal_image.onclick = function() {
        close(modal_image);
    };
    var change_img = document.getElementsByClassName("laterales")[0].getElementsByTagName("span");
    change_img[0].onclick = function() {
        var get_img = document.getElementsByClassName("prop_logos")[0].getElementsByTagName("img");
        var sel_img = document.getElementById("img_amp");
        sel_img = sel_img.getElementsByTagName("img")[0];
        for (var x = 0; x < get_img.length; x++) {
            get_img[x].numerito = x;
            if (sel_img.src == get_img[x].src) {
                var lugar = x;
            }
        }
        if (lugar == 0) {
            lugar = get_img.length - 1;
        } else {
            lugar = lugar - 1;
        }
        sel_img.src = get_img[lugar].src;
    }
    change_img[1].onclick = function() {
        var get_img = document.getElementsByClassName("prop_logos")[0].getElementsByTagName("img");
        var sel_img = document.getElementById("img_amp");
        sel_img = sel_img.getElementsByTagName("img")[0];
        for (var x = 0; x < get_img.length; x++) {
            get_img[x].numerito = x;
            if (sel_img.src == get_img[x].src) {
                var lugar = x;
                // console.log(get_img[lugar].src);
                //    sel_img.src= get_img[lugar].src;
            }
        }
        if (lugar == (get_img.length - 1)) {
            lugar = 0;
        } else {
            lugar = lugar + 1;
        }
        sel_img.src = get_img[lugar].src;
    }
};
if (document.getElementById("bt_votar")) {
    jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up icon-angle-up"></div><div class="quantity-button quantity-down icon-angle-down"></div></div>').insertAfter('.quantity input');
    const step = 50;
    jQuery('.quantity').each(function() {
        var spinner = jQuery(this),
            input = spinner.find('input[type="number"]'),
            btnUp = spinner.find('.quantity-up'),
            btnDown = spinner.find('.quantity-down'),
            min = input.attr('min'),
            max = input.attr('max');
        btnUp.click(function() {
            var oldValue = parseFloat(input.val());
            if (oldValue >= max) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue + step;
            }
            if(newVal < 50) {
                newVal = 50;
            }
            if(newVal > 450) {
                newVal = 450;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });
        btnDown.click(function() {
            var oldValue = parseFloat(input.val());
            if (oldValue <= min) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue - step;
            }
            if(newVal < 50) {
                newVal = 50;
            }
            if(newVal > 450) {
                newVal = 450;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });
    });
}

$('.popup > div').click(function(ev) {
    ev.stopPropagation();
});
if (document.getElementById("content-ltn")) {
    (function($) {
        $(window).on("load", function() {
            $.mCustomScrollbar.defaults.scrollButtons.enable = true; //enable scrolling buttons by default
            $.mCustomScrollbar.defaults.axis = "y"; //enable 2 axis scrollbars by default
            // $("#content-l").mCustomScrollbar();
            $("#content-ltn").mCustomScrollbar({
                theme: "light-thin"
            });
            $(".all-themes-switch a").click(function(e) {
                e.preventDefault();
                var $this = $(this),
                    rel = $this.attr("rel"),
                    el = $(".content");
                switch (rel) {
                    case "toggle-content":
                        el.toggleClass("expanded-content");
                        break;
                }
            });
        });
    })(jQuery);
}
// if (document.getElementById("quien_fichas_modal")) {
//     var quien_fichas = document.getElementById("quien_fichas_modal");
//     var btn_ver_quien_fichas = document.getElementById("btn_ver_quien");
//     var quien_fichas_dos = document.getElementById("quien_fichas");
//     var cerrar_fichas = quien_fichas.getElementsByClassName("cerrar")[0];
//     btn_ver_quien_fichas.onclick = function() {
//         open_modal(quien_fichas);
//         quien_fichas.classList.add("abierto_fichas");
//         var scrollTop = $(window).scrollTop();
//         if ($(window).width() >= 590 && $(window).width() < 992) {
//             $("html, body").animate({
//                 scrollTop: "831"
//             });
//         } else if ($(window).width() < 590) {
//             $("html, body").animate({
//                 scrollTop: "600"
//             });
//         } else if ($(window).width() >= 992) {
//             $("html, body").animate({
//                 scrollTop: "200"
//             });
//         }
//     }
//     cerrar_fichas.onclick = function() {
//         close(quien_fichas);
//     }
//     $(document).mouseup(function(e) {
//         if (quien_fichas.classList.contains("abierto_fichas")) {
//             var container = $("#quien_fichas_modal");
//             if (!container.is(e.target) && container.has(e.target).length === 0) {
//                 quien_fichas.classList.remove("abierto_fichas");
//                 container.fadeOut();
//                 document.body.style.overflowY = "scroll";
//                 document.body.style.overflowX = "hidden";
//             }
//         }
//     });
// }

if (document.getElementById("menu_logueado")) {
    var menu_logueado = document.getElementById("menu_logueado");
    menu_logueado.onclick = function() {
        var menu_logueado_desp = document.getElementById("menu_logueado_desp");
        if (menu_logueado_desp.classList.contains("menu_logueado_abierto")) {
            var get_icon_menu = menu_logueado.getElementsByTagName("span")[0].getElementsByClassName("icon-angle-up")[0];
            get_icon_menu.classList.remove("icon-angle-up");
            get_icon_menu.classList.add("icon-angle-down");
            menu_logueado_desp.classList.remove("menu_logueado_abierto");
        } else {
            var get_icon_menu = menu_logueado.getElementsByTagName("span")[0].getElementsByClassName("icon-angle-down")[0];
            get_icon_menu.classList.remove("icon-angle-down");
            get_icon_menu.classList.add("icon-angle-up");
            menu_logueado_desp.classList.add("menu_logueado_abierto");
        };
    }
}

if (document.getElementById("menu_notifications_box")) {
    var menu_notifications = document.getElementById("menu_notifications_box");
    menu_notifications.onclick = function() {
        var menu_notifications_desp = document.getElementById("menu_notifications_box");
        if (menu_notifications_desp.classList.contains("menu_notifications_box_abierto")) {
            var get_icon_menu = menu_notifications.getElementsByTagName("span")[0].getElementsByClassName("icon-angle-up")[0];
            get_icon_menu.classList.remove("icon-angle-up");
            get_icon_menu.classList.add("icon-angle-down");
            menu_notifications_desp.classList.remove("menu_notifications_box_abierto");
        } else {
            var get_icon_menu = menu_notifications.getElementsByTagName("span")[0].getElementsByClassName("icon-angle-down")[0];
            get_icon_menu.classList.remove("icon-angle-down");
            get_icon_menu.classList.add("icon-angle-up");
            menu_notifications_desp.classList.add("menu_notifications_box_abierto");
        };
    }
}
function init_2() {
    var inputFile_2 = document.getElementsByClassName("inputfile_per");
    for (var x = 0; x < inputFile_2.length; x++) {
        var posicion = x;
        inputFile_2[x].posicion = x;
        inputFile_2[x].addEventListener('change', mostrarImagen_2, false);
    }
}

function mostrarImagen_2(event) {
    var pat_img = new RegExp(/\.(jpg|png|gif)$/i);
    var posicion = this.posicion;
    var fileName, fileExtension;
    fileName = event.target.files[0].name;
    fileExtension = fileName.replace(/^.*\./, '');
    var file = event.target.files[0];
    var reader = new FileReader();
    reader.onload = function(event) {
        var info_per_right = document.getElementsByClassName("info_per_right")[0];
        console.log(info_per_right);
        var cont_box = info_per_right.getElementsByClassName("cont_box")[0];
        var box = document.getElementsByClassName("box");
        var imagen = box[posicion].getElementsByTagName("img");
        var in_img = document.getElementsByClassName("in_img")[0];
        var get_in_img = in_img.getElementsByTagName("input")[0];
        if (pat_img.test(get_in_img.files[0].name)) {
            if (imagen[0] === undefined) {
                box[posicion].appendChild(document.createElement("img"));
            }
            var img = cont_box.getElementsByTagName("img");
            img[0].src = event.target.result;
            var change_span = info_per_right.getElementsByTagName("span");
            //var guardar_span = document.createElement("span");
            //guardar_span.classList.add("resaltado_amarillo", "subrayado", "guardar_img");
            if (!document.getElementsByClassName("guardar_img")[0]) {
                cont_box.appendChild(guardar_span);
                cont_box.getElementsByClassName("guardar_img")[0].innerHTML = "Guardar";
                if (in_img.getElementsByClassName("guardar_img")[0]) {
                    btn_guardar_img = in_img.getElementsByClassName("guardar_img")[0];
                    btn_guardar_img.onclick = function() {
                        if (pat_img.test(get_in_img.files[0].name)) {
                            var get_modal_exito = document.getElementById("exito_msg");
                            open_modal(get_modal_exito);
                            var efecto1 = setTimeout(close(get_modal_exito), 300);

                            cont_box.removeChild(guardar_span);
                            submitImage();
                        } else {
                            var get_modal_err = document.getElementById("err_msg");
                            open_modal(get_modal_err);
                            var cerrar_err = get_modal_err.getElementsByClassName("cerrar")[0];
                            cerrar_err.onclick = function() {
                                close(get_modal_err);
                            };
                        }
                    }
                }
            };
        } else {
            var get_modal_err = document.getElementById("err_msg");
            open_modal(get_modal_err);
            var cerrar_err = get_modal_err.getElementsByClassName("cerrar")[0];
            cerrar_err.onclick = function() {
                close(get_modal_err);
            };
        }
    }
    reader.readAsDataURL(file);
}
window.addEventListener('load', init_2, false);
// Formulario Informacion personal
var pat_text = new RegExp(/[a-z]{3}/);
var pat_mail = new RegExp(/[\w-\.]{3,}@([\w-]{2,}\.)([\w-]{2,4}\.)?[\w-]{2,4}$/);
var pat_img = new RegExp(/\.(jpg|png|gif)$/i);
var pat_pdf = new RegExp(/\.(pdf)$/i);
if (document.getElementsByClassName("in_sp")) {
    var in_sp = document.getElementsByClassName("in_sp");
    var btn_editar = [];
    for (var x = 0; x < in_sp.length; x++) {
        btn_editar[x] = in_sp[x].getElementsByTagName("span")[0];
        btn_editar[x].numerito = x;
        in_sp[x].error = false;
        btn_editar[x].onclick = function() {
            if (in_sp[this.numerito].classList.contains("editar")) {
                if (in_sp[this.numerito].getElementsByTagName("input")[0]) {
                    in_sp[this.numerito].getElementsByTagName("input")[0].disabled = false;
                    in_sp[this.numerito].getElementsByTagName("input")[0].focus();
                } else if (in_sp[this.numerito].getElementsByTagName("p")[0]) {
                    in_sp[this.numerito].getElementsByClassName("pais_select")[0].style.display = "none";
                    in_sp[this.numerito].getElementsByClassName("arm_sel")[0].style.display = "inline-block";
                }
                btn_editar[this.numerito].innerHTML = "Guardar";
                in_sp[this.numerito].classList.remove("editar");
                in_sp[this.numerito].classList.add("guardar");
            } else if (in_sp[this.numerito].classList.contains("guardar")) {
                if (in_sp[this.numerito].getElementsByTagName("input")[0]) {
                    var value_input = in_sp[this.numerito].getElementsByTagName("input")[0].value;
                    if (in_sp[this.numerito].getElementsByTagName("input")[0].type == "text" && in_sp[this.numerito].classList.contains("obligatorio")) {
                        if (pat_text.test(value_input)) {
                            in_sp[this.numerito].getElementsByTagName("input")[0].disabled = true;
                            btn_editar[this.numerito].innerHTML = "Editar";
                            in_sp[this.numerito].classList.remove("guardar");
                            in_sp[this.numerito].classList.add("editar");
                            in_sp[this.numerito].error = false;
                            var panel_user_profile = document.getElementById("panel_user_profile");
                            var contenedor_form_in = panel_user_profile.getElementsByClassName("input_err")[this.numerito];
                            if (contenedor_form_in.getElementsByClassName("error")[0]) {
                                contenedor_form_in.removeChild(contenedor_form_in.getElementsByClassName("error")[0]);
                            }
                            var get_modal_exito = document.getElementById("exito_msg");
                            open_modal(get_modal_exito);


                            submit(in_sp[this.numerito], "input");
                        } else {
                            in_sp[this.numerito].getElementsByTagName("input")[0].focus();
                            if (in_sp[this.numerito].error == false) {
                                var panel_user_profile = document.getElementById("panel_user_profile");
                                var contenedor_form_in = panel_user_profile.getElementsByClassName("input_err")[this.numerito];
                                var create_span = document.createElement("span");
                                create_span.className = "error";
                                create_span.innerHTML = "Ingrese un texto valido";
                                var insert_antes = contenedor_form_in.getElementsByClassName("line_dashed")[0];
                                contenedor_form_in.insertBefore(create_span, insert_antes);
                                in_sp[this.numerito].error = true;
                            }
                        }
                    } else if (in_sp[this.numerito].getElementsByTagName("input")[0].type == "email" && in_sp[this.numerito].classList.contains("obligatorio")) {
                        if (pat_mail.test(value_input)) {
                            in_sp[this.numerito].getElementsByTagName("input")[0].disabled = true;
                            btn_editar[this.numerito].innerHTML = "Editar";
                            in_sp[this.numerito].classList.remove("guardar");
                            in_sp[this.numerito].classList.add("editar");
                            in_sp[this.numerito].error = false;
                            var panel_user_profile = document.getElementById("panel_user_profile");
                            var contenedor_form_in = panel_user_profile.getElementsByClassName("input_err")[this.numerito];
                            if (contenedor_form_in.getElementsByClassName("error")[0]) {
                                contenedor_form_in.removeChild(contenedor_form_in.getElementsByClassName("error")[0]);
                            }
                            var get_modal_exito = document.getElementById("exito_msg");
                            open_modal(get_modal_exito);
                            var efecto1 = setTimeout(close(get_modal_exito), 600);
                            // hacer submit
                        } else {
                            in_sp[this.numerito].getElementsByTagName("input")[0].focus();
                            if (in_sp[this.numerito].error == false) {
                                var panel_user_profile = document.getElementById("panel_user_profile");
                                var contenedor_form_in = panel_user_profile.getElementsByClassName("input_err")[this.numerito];
                                var create_span = document.createElement("span");
                                create_span.className = "error";
                                create_span.innerHTML = "Ingrese un email valido";
                                var insert_antes = contenedor_form_in.getElementsByClassName("line_dashed")[0];
                                contenedor_form_in.insertBefore(create_span, insert_antes);
                                in_sp[this.numerito].error = true;
                            }
                        }
                    } else if (in_sp[this.numerito].getElementsByTagName("input")[0].type == "date" && in_sp[this.numerito].classList.contains("obligatorio")) {
                        var hoy = new Date();
                        hoy.setFullYear(hoy.getFullYear() - 18);
                        var fechaFormulario = new Date(value_input);
                        if (hoy > fechaFormulario) {
                            in_sp[this.numerito].getElementsByTagName("input")[0].disabled = true;
                            btn_editar[this.numerito].innerHTML = "Editar";
                            in_sp[this.numerito].classList.remove("guardar");
                            in_sp[this.numerito].classList.add("editar");
                            in_sp[this.numerito].error = false;
                            var panel_user_profile = document.getElementById("panel_user_profile");
                            var contenedor_form_in = panel_user_profile.getElementsByClassName("input_err")[this.numerito];
                            if (contenedor_form_in.getElementsByClassName("error")[0]) {
                                contenedor_form_in.removeChild(contenedor_form_in.getElementsByClassName("error")[0]);
                            }
                            var get_modal_exito = document.getElementById("exito_msg");
                            open_modal(get_modal_exito);
                            var efecto1 = setTimeout(close(get_modal_exito), 600);
                            submit(in_sp[this.numerito],"input");
                        } else {
                            in_sp[this.numerito].getElementsByTagName("input")[0].focus();
                            if (in_sp[this.numerito].error == false) {
                                var panel_user_profile = document.getElementById("panel_user_profile");
                                var contenedor_form_in = panel_user_profile.getElementsByClassName("input_err")[this.numerito];
                                console.log(this.numerito);
                                var create_span = document.createElement("span");
                                create_span.className = "error";
                                create_span.innerHTML = "Debe ser mayor de 18 años";
                                var insert_antes = contenedor_form_in.getElementsByClassName("line_dashed")[0];
                                contenedor_form_in.insertBefore(create_span, insert_antes);
                                in_sp[this.numerito].error = true;
                            }
                        }
                    } else if (in_sp[this.numerito].getElementsByTagName("input")[0].type == "text") {
                        in_sp[this.numerito].getElementsByTagName("input")[0].disabled = true;
                        btn_editar[this.numerito].innerHTML = "Editar";
                        in_sp[this.numerito].classList.remove("guardar");
                        in_sp[this.numerito].classList.add("editar");
                        in_sp[this.numerito].error = false;
                        var panel_user_profile = document.getElementById("panel_user_profile");
                        var contenedor_form_in = panel_user_profile.getElementsByClassName("input_err")[this.numerito];
                        var get_modal_exito = document.getElementById("exito_msg");
                        open_modal(get_modal_exito);
                        var efecto1 = setTimeout(close(get_modal_exito), 600);
                        // hacer submit (envia input no obligatorios)
                        submit(in_sp[this.numerito],"input");
                    }
                } else if (in_sp[this.numerito].getElementsByTagName("select")[0]) {
                    in_sp[this.numerito].getElementsByClassName("pais_select")[0].style.display = "inline-block";
                    in_sp[this.numerito].getElementsByClassName("arm_sel")[0].style.display = "none";
                    var get_p = in_sp[this.numerito].getElementsByTagName("p")[0];
                    var get_select_op = in_sp[this.numerito].getElementsByTagName("select")[0];
                    get_p.innerHTML = get_select_op.options[get_select_op.selectedIndex].text;
                    btn_editar[this.numerito].innerHTML = "Editar";
                    in_sp[this.numerito].classList.remove("guardar");
                    in_sp[this.numerito].classList.add("editar");
                    var get_modal_exito = document.getElementById("exito_msg");
                    open_modal(get_modal_exito);
                    submit(in_sp[this.numerito], "select");
                    var efecto1 = setTimeout(close(get_modal_exito), 600);
                }
            }
        }
    }
};
// funcion para crear el mensaje de error en los formularios
function crear_span_error(insertar, mensaje) {
    var create_span = document.createElement("span");
    create_span.className = "error";
    create_span.innerHTML = mensaje;
    insertar.appendChild(create_span);
}
// formulario registro usuario cambiar el if getelementbyid
if (document.getElementById("registro_js")) {
    var boton = document.getElementById("boton_susc");

    function onSubmit(token) {
        document.getElementById('registro-form').submit();
    }

    function recaptchaCallback() {
        boton.removeAttribute('disabled');
    };
    var get_cont_gral = document.getElementsByClassName("contenedor_campos")[0];
    var get_input_cont = get_cont_gral.getElementsByClassName("input_err");
    for (var x = 0; x < get_input_cont.length; x++) {
        get_input_cont[x].error = false;
    }
    // function crear_span_error (insertar, mensaje){
    //     var create_span = document.createElement("span");
    //     create_span.className = "error";
    //     create_span.innerHTML= mensaje;
    //     insertar.appendChild(create_span);
    // }
    boton.onclick = function() {
        //recaptchaCallback();
        var get_one = [];
        var cont = 0
        for (var x = 0; x < get_input_cont.length; x++) {
            get_input_cont[x].numerito = x;
            if (get_input_cont[x].getElementsByTagName("input")[0]) {
                if (get_input_cont[x].getElementsByTagName("input")[0].type == "text" && get_input_cont[x].classList.contains("obligatorio")) {
                    if (pat_text.test(get_input_cont[x].getElementsByTagName("input")[0].value)) {
                        if (get_input_cont[x].error == true) {
                            get_input_cont[x].removeChild(get_input_cont[x].getElementsByClassName("error")[0]);
                            get_input_cont[x].error = false;
                        }
                    } else {
                        if (get_input_cont[x].error == false) {
                            crear_span_error(get_input_cont[x], "Ingrese un nombre valido");
                            get_input_cont[x].error = true;
                        }
                    }
                } else if (get_input_cont[x].getElementsByTagName("input")[0].type == "email" && get_input_cont[x].classList.contains("obligatorio")) {
                    if (pat_text.test(get_input_cont[x].getElementsByTagName("input")[0].value)) {
                        if (get_input_cont[x].error == true) {
                            get_input_cont[x].removeChild(get_input_cont[x].getElementsByClassName("error")[0]);
                            get_input_cont[x].error = false;
                        }
                    } else {
                        if (get_input_cont[x].error == false) {
                            crear_span_error(get_input_cont[x], "Ingrese un mail valido");
                            get_input_cont[x].error = true;
                        }
                    }
                } else if (get_input_cont[x].getElementsByTagName("input")[0].type == "password" && get_input_cont[x].classList.contains("obligatorio")) {
                    if (pat_text.test(get_input_cont[x].getElementsByTagName("input")[0].value)) {
                        if (get_input_cont[x].getElementsByClassName("error")[0]) {
                            get_input_cont[x].removeChild(get_input_cont[x].getElementsByClassName("error")[0]);
                        }
                        get_one[cont] = [true, get_input_cont[x].getElementsByTagName("input")[0].value];
                        if (cont == 1) {
                            var posicion = x;
                        }
                        cont++;
                        get_input_cont[x].error = false;
                    } else {
                        if (!get_input_cont[x].getElementsByClassName("error")[0]) {
                            crear_span_error(get_input_cont[x], "Ingrese un pass");
                        } else {
                            get_input_cont[x].removeChild(get_input_cont[x].getElementsByClassName("error")[0]);
                            crear_span_error(get_input_cont[x], "Ingrese un pass");
                        }
                        get_one[cont] = [false, ""];
                        get_input_cont[x].error = true;
                        cont++;
                    }
                }
            } else if (get_input_cont[x].getElementsByTagName("select")[0]) {
                if (get_input_cont[x].getElementsByTagName("select")[0].value == "ninguno") {
                    if (get_input_cont[x].error == false) {
                        crear_span_error(get_input_cont[x], "Seleccione un país");
                        get_input_cont[x].error = true;
                    }
                } else {
                    if (get_input_cont[x].error == true) {
                        get_input_cont[x].removeChild(get_input_cont[x].getElementsByClassName("error")[0]);
                        get_input_cont[x].error = false;
                    }
                }
            }
        }
        if (get_one.length == 2) {
            if (get_one[0][0] == true && get_one[1][0] == true) {
                if (get_one[0][1] == get_one[1][1]) {} else {
                    crear_span_error(get_input_cont[posicion], "La pass no coincide");
                    get_input_cont[posicion].error = true;
                }
            }
        }
        /*var get_checkbox = document.getElementById("check_div");
        if (get_checkbox.getElementsByTagName("input")[0].type == "checkbox" && get_checkbox.classList.contains("obligatorio")) {
            if (get_checkbox.getElementsByTagName("input")[0].checked) {
                if (get_checkbox.getElementsByClassName("error")[0]) {
                    get_checkbox.removeChild(get_checkbox.getElementsByClassName("error")[0]);
                }
                var unselect_check = false;
            } else {
                var unselect_check = true;
                if (!get_checkbox.getElementsByClassName("error")[0]) {
                    crear_span_error(get_checkbox, "Debe aceptar los términos y condiciones");
                }
            }
        }*/
        var contar_errores = 0;
        for (var z = 0; z < get_input_cont.length; z++) {
            if (get_input_cont[z].error == true) {
                contar_errores++;
            }
        }
        if (contar_errores != 0 && unselect_check == true) {
            return false;
        } else {
            return false;
            // submit form registro
        }
    };
};
// Participantes orden menu
if (document.getElementById("ordenar")) {
    var get_ordenar = document.getElementById("ordenar");
    get_ordenar.onclick = function() {
        var get_icon = get_ordenar.getElementsByClassName("ordenar_bt")[0].getElementsByTagName("span")[0];
        var get_lista_orden = document.getElementsByClassName("cat_partipantes")[0].getElementsByTagName("ul")[0];
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
// participantes js general orden y grilla
if (document.getElementsByClassName("contenedor_logos_participantes")[0]) {
    var get_logo_gral = document.getElementsByClassName("contenedor_logos_participantes")[0];
    var get_cargar_mas_est = document.getElementById("cargar_mas");
    get_cargar_mas_est = get_cargar_mas_est.cloneNode(true);
    var grilla = [];
    grilla[0] = {
        link: "img/logos_participantes/participantes.png",
        votos: 100,
        vistos: 200,
        fecha: "13/02/2020",
        titulo: "titulo de propuesta",
        nombre: "nombre de usuario",
        avatar: "img/participantes/usuario.png",
        alt_img: "usuario pepito",
        votaste: "votado"
    };
    grilla[1] = {
        link: "img/logos_participantes/uno.png",
        votos: 150,
        vistos: 200,
        fecha: "10/02/2020",
        titulo: "titulo de propuesta",
        nombre: "nombre de usuario",
        avatar: "img/participantes/usuario.png",
        alt_img: "usuario pepito",
        votaste: "no_votado"
    };
    grilla[2] = {
        link: "img/logos_participantes/dos.png",
        votos: 10,
        vistos: 250,
        fecha: "13/01/2016",
        titulo: "titulo de propuesta",
        nombre: "nombre de usuario",
        avatar: "img/participantes/usuario.png",
        alt_img: "usuario pepito",
        votaste: "votado"
    };
    grilla[3] = {
        link: "img/logos_participantes/tres.png",
        votos: 300,
        vistos: 1000,
        fecha: "26/03/2020",
        titulo: "titulo de propuesta",
        nombre: "nombre de usuario",
        avatar: "img/participantes/usuario.png",
        alt_img: "usuario pepito",
        votaste: "votado"
    };
    grilla[4] = {
        link: "img/logos_participantes/participantes.png",
        votos: 100,
        vistos: 200,
        fecha: "13/02/2017",
        titulo: "titulo de propuesta",
        nombre: "nombre de usuario",
        avatar: "img/participantes/usuario.png",
        alt_img: "usuario pepito",
        votaste: "no_votado"
    };
    grilla[5] = {
        link: "img/logos_participantes/uno.png",
        votos: 150,
        vistos: 200,
        fecha: "10/02/2020",
        titulo: "titulo de propuesta",
        nombre: "nombre de usuario",
        avatar: "img/participantes/usuario.png",
        alt_img: "usuario pepito",
        votaste: "no_votado"
    };
    grilla[6] = {
        link: "img/logos_participantes/dos.png",
        votos: 10,
        vistos: 250,
        fecha: "13/01/2020",
        titulo: "titulo de propuesta",
        nombre: "nombre de usuario",
        avatar: "img/participantes/usuario.png",
        alt_img: "usuario pepito",
        votaste: "no_votado"
    };
    grilla[7] = {
        link: "img/logos_participantes/tres.png",
        votos: 300,
        vistos: 1000,
        fecha: "01/03/2019",
        titulo: "titulo de propuesta",
        nombre: "nombre de usuario",
        avatar: "img/participantes/usuario.png",
        alt_img: "usuario pepito",
        votaste: "no_votado"
    };
    for (var s = 0; s < grilla.length; s++) {
        var fechaSp = grilla[s]["fecha"].split("/");
        var anio = new Date().getFullYear();
        if (fechaSp.length == 3) {
            anio = fechaSp[2];
        }
        var mes = fechaSp[1] - 1;
        var dia = fechaSp[0];
        grilla[s]["fecha"] = new Date(anio, mes, dia);
    }

    $(get_logo_gral).fadeIn();
    var get_cargar_mas = document.getElementById("cargar_mas");
    var get_cargar_mas_btn = get_cargar_mas.getElementsByTagName("span")[0];
    var cant_agrega = 0;

    // funcion para ordenar random el array
    function shuffle(array) {
        var currentIndex = array.length,
            temporaryValue, randomIndex;
        // Mientras queden elementos a mezclar...
        while (0 !== currentIndex) {
            // Seleccionar un elemento sin mezclar...
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;
            // E intercambiarlo con el elemento actual
            temporaryValue = array[currentIndex];
            array[currentIndex] = array[randomIndex];
            array[randomIndex] = temporaryValue;
        }
        return array;
    }
    // Boton mas vistos, esta estructura esta realizada para mostrar la interaccion. Lo unico que hay q tener en cuenta es la linea ($(get_logo_gral).hide();) que lo q hace es poner en hide el contenedor de los logos y una vez cargado el filtro activar con la linea $(get_logo_gral).fadeIn(); la animacion
    function filtros_js(contenedor_gral_logos, filtro_click, borrar_cont, filtrado, grilla_array) {
        console.log("entramos");
        var sebas = document.getElementById("cargar_mas");
        filtro_click.onclick = function() {
            cant_agrega = 0;
            if (document.getElementsByClassName("sin_resultados")[0]) {
                var crear_mensaje = document.getElementsByClassName("sin_resultados")[0]
                get_logo_gral.removeChild(crear_mensaje);
                var get_boton = document.getElementById("cargar_mas");
                get_boton.style.display = "block";
            }
            if (document.getElementsByClassName("no_hay_logos")[0]) {
                var get_boton = document.getElementById("cargar_mas");
                get_boton.removeChild(document.getElementsByClassName("no_hay_logos")[0]);
            }
            var cat_partipantes = document.getElementsByClassName("cat_partipantes")[0];
            if (cat_partipantes.getElementsByClassName("activo")[0]) {
                var boton_activo = cat_partipantes.getElementsByClassName("activo")[0];
                boton_activo.classList.remove("activo");
            }
            if (filtrado == "random") {
                var boton_activo = document.getElementById("random");
                boton_activo.classList.add("activo");
            } else if (filtrado == "votos") {
                boton_activo = document.getElementById("mas_votado");
                boton_activo.classList.add("activo");
            } else if (filtrado == "vistos") {
                boton_activo = document.getElementById("mas_visto");
                boton_activo.classList.add("activo");
            } else if (filtrado == "fecha") {
                boton_activo = document.getElementById("mas_reciente");
                boton_activo.classList.add("activo");
            }
            var hijos = document.getElementsByClassName(borrar_cont);
            if (filtrado == "random") {
                shuffle(grilla_array);
            } else {
                function comparar(a, b) {
                    return b[filtrado] - a[filtrado]
                };

                function ordenar() {
                    grilla_array.sort(comparar);
                }
                ordenar();
            }
            var get_logo = document.getElementsByClassName(borrar_cont)[0];
            for (var h = hijos.length - 1; h >= 0; h--) {
                contenedor_gral_logos.removeChild(hijos[h]);
            }
            $(contenedor_gral_logos).hide();

            $(contenedor_gral_logos).fadeIn();
        }
    };
    // activa los filtros
    var get_mas_votados = document.getElementById("random");
    //filtros_js(get_logo_gral, get_mas_votados, "logo_particantes", "random", grilla);
    var get_mas_votados = document.getElementById("mas_votado");
    //filtros_js(get_logo_gral, get_mas_votados, "logo_particantes", "votos", grilla);
    var get_mas_vistos = document.getElementById("mas_visto");
    //filtros_js(get_logo_gral, get_mas_vistos, "logo_particantes", "vistos", grilla);
    var get_mas_recientes = document.getElementById("mas_reciente");
    //filtros_js(get_logo_gral, get_mas_recientes, "logo_particantes", "fecha", grilla);
    var bt_bu = document.getElementsByClassName("bt_bu")[0];
    bt_bu = bt_bu.getElementsByTagName("button")[0];
    // bt_bu.onclick = function() {
    //     var hijos = document.getElementsByClassName("logo_particantes");
    //     for (var h = hijos.length - 1; h >= 0; h--) {
    //         get_logo_gral.removeChild(hijos[h]);
    //     }
    //     if (!document.getElementsByClassName("sin_resultados")[0]) {
    //         var crear_mensaje = document.createElement("h2");
    //         crear_mensaje.classList.add("sin_resultados");
    //         crear_mensaje.innerHTML = "La busqueda no arroja resultados";
    //         get_logo_gral.appendChild(crear_mensaje);
    //         var boton_car_mas = document.getElementById("cargar_mas");
    //         boton_car_mas.style.display = "none";
    //         // cont_car_mas.removeChild(boton_car_mas);
    //     }
    //     if (document.getElementsByClassName("cat_partipantes")[0]) {
    //         var cat_partipantes = document.getElementsByClassName("cat_partipantes")[0];
    //         var boton_activo = cat_partipantes.getElementsByClassName("activo")[0];
    //         boton_activo.classList.remove("activo");
    //     }
    //     return false;
    // }
}
if (document.getElementById("exito_msg_2")) {
    var get_exito_msg_2 = document.getElementById("exito_msg_2");
    var get_cerrar = get_exito_msg_2.getElementsByClassName("cerrar")[0];
    get_cerrar.onclick = function() {
        close(get_exito_msg_2);
    }
}
// formulario registro postulacion
function validar_text_area(patron) {
    var get_text_area_doc = document.getElementsByTagName("TEXTAREA");
    for (var x = 0; x < get_text_area_doc.length; x++) {
        var check_exist = get_text_area_doc[x].parentElement;
        if (patron.test(get_text_area_doc[x].value)) {
            if (check_exist.getElementsByClassName("error")[0]) {
                check_exist.removeChild(check_exist.getElementsByClassName("error")[0]);
            }
        } else {
            if (!check_exist.getElementsByClassName("error")[0]) {
                crear_span_error(get_text_area_doc[x].parentElement, "Mínimo 30 caracteres");
            }
        }
    }
}

function validar_form_nofiles(patron, input_type) {
    var get_input_doc = document.getElementsByTagName("input");
    for (var x = 0; x < get_input_doc.length; x++) {
        // verifica input text
        if (get_input_doc[x].type == "text" && get_input_doc[x].classList.contains("obligatorio")) {
            var check_exist = get_input_doc[x].parentElement;
            if (patron.test(get_input_doc[x].value)) {
                if (check_exist.getElementsByClassName("error")[0]) {
                    check_exist.removeChild(check_exist.getElementsByClassName("error")[0]);
                }
            } else {
                if (!check_exist.getElementsByClassName("error")[0]) {
                    crear_span_error(get_input_doc[x].parentElement, "Debe completar el campo");
                }
            }
        }
    }
}
function validar_form_mail(patron, input_type) {
    var get_input_doc = document.getElementsByTagName("input");
    for (var x = 0; x < get_input_doc.length; x++) {
        if (get_input_doc[x].type == "email") {
            var check_exist = get_input_doc[x].parentElement;
            if (patron.test(get_input_doc[x].value)) {
                if (check_exist.getElementsByClassName("error")[0]) {
                    check_exist.removeChild(check_exist.getElementsByClassName("error")[0]);
                }
            } else {
                if (!check_exist.getElementsByClassName("error")[0]) {
                    crear_span_error(get_input_doc[x].parentElement, "El mail no es valido");
                }
            }
        }
    }
}
function next_hno(e) {
    var cont_files_gral = document.getElementsByClassName("cont_box")[0];
    var get_files = cont_files_gral.getElementsByTagName("input");
    if (e.type == "file") {
        if (e.files[0]) {
            if (pat_img.test(e.files[0].name)) {
                var size_file = e.files[0].size / 1024;
                if (size_file <= 25000) {
                    var seba = e.parentElement.parentElement;
                    seba = $(seba).next();
                    // console.log(seba[0].getElementsByTagName("input")[0]);
                    seba[0].getElementsByTagName("input")[0].disabled = false;
                }
            }
        }
    }
}

function validar_files_imgypdf() {
    var get_input_doc = document.getElementsByTagName("input");
    for (var x = 0; x < get_input_doc.length; x++) {
        if (get_input_doc[x].type == "file") {
            if (get_input_doc[x].id == "file-1") {
                var check_exist = get_input_doc[x].parentElement.parentElement.parentElement;
                if (get_input_doc[x].files[0]) {
                    if (get_input_doc[x].id == "file-1") {
                        if (pat_img.test(get_input_doc[x].files[0].name)) {
                            var size_file = get_input_doc[x].files[0].size / 1024;
                            if (size_file <= 25000) {
                                if (check_exist.getElementsByClassName("error")[0]) {
                                    check_exist.removeChild(check_exist.getElementsByClassName("error")[0]);
                                }
                            } else {
                                get_input_doc[x].value = "";
                                if (check_exist.getElementsByClassName("error")[0]) {
                                    check_exist.getElementsByClassName("error")[0].innerHTML = "El archivo es pesado";
                                } else {
                                    crear_span_error(get_input_doc[x].parentElement.parentElement.parentElement, "El archivo es pesado");
                                }
                                get_input_doc[x].parentElement.getElementsByTagName("img")[0].src = "";
                            }
                        } else {
                            get_input_doc[x].value = "";
                            if (!check_exist.getElementsByClassName("error")[0]) {
                                crear_span_error(get_input_doc[x].parentElement.parentElement.parentElement, "El formato debe ser JPG / PNG");
                            } else {
                                check_exist.getElementsByClassName("error")[0].innerHTML = "El formato debe ser JPG / PNG";
                            }
                            get_input_doc[x].parentElement.getElementsByTagName("img")[0].src = "";
                        }
                    }
                } else {
                    if (!check_exist.getElementsByClassName("error")[0]) {
                        crear_span_error(get_input_doc[x].parentElement.parentElement.parentElement, "Debe cargar una imagen");
                    } else {
                        check_exist.getElementsByClassName("error")[0].innerHTML = "Debe cargar una imagen";
                    }
                }
            } else if (get_input_doc[x].id == "file-2") {
                var check_exist = get_input_doc[x].parentElement.parentElement.parentElement.parentElement;
                if (get_input_doc[x].files[0]) {
                    if (pat_img.test(get_input_doc[x].files[0].name)) {
                        var size_file = get_input_doc[x].files[0].size / 1024;
                        if (size_file <= 25000) {
                            if (check_exist.getElementsByClassName("error")[0]) {
                                check_exist.removeChild(check_exist.getElementsByClassName("error")[0]);
                            }
                            // console.log(size_file);
                        } else {
                            get_input_doc[x].value = "";
                            if (check_exist.getElementsByClassName("error")[0]) {
                                check_exist.getElementsByClassName("error")[0].innerHTML = "El archivo es pesado";
                            } else {
                                crear_span_error(get_input_doc[x].parentElement.parentElement.parentElement.parentElement, "El archivo es pesado");
                            }
                            get_input_doc[x].parentElement.getElementsByTagName("img")[0].src = "";
                        }
                    } else {
                        get_input_doc[x].value = "";
                        if (!check_exist.getElementsByClassName("error")[0]) {
                            crear_span_error(get_input_doc[x].parentElement.parentElement.parentElement.parentElement, "El formato debe ser JPG / PNG");
                        } else {
                            check_exist.getElementsByClassName("error")[0].innerHTML = "El formato debe ser JPG / PNG";
                        }
                        get_input_doc[x].parentElement.getElementsByTagName("img")[0].src = "";
                    }
                } else {
                    if (!check_exist.getElementsByClassName("error")[0]) {
                        crear_span_error(get_input_doc[x].parentElement.parentElement.parentElement.parentElement, "Debe cargar una imagen");
                    } else {
                        check_exist.getElementsByClassName("error")[0].innerHTML = "Debe cargar una imagen";
                    }
                }
            }
        }
        //input file no obligatorio
        if ((get_input_doc[x].id == "file-3" && get_input_doc[x].disabled == false) || (get_input_doc[x].id == "file-4" && get_input_doc[x].disabled == false) || (get_input_doc[x].id == "file-5" && get_input_doc[x].disabled == false) || (get_input_doc[x].id == "file-6" && get_input_doc[x].disabled == false)) {
            var check_exist = get_input_doc[x].parentElement.parentElement.parentElement.parentElement;
            if (get_input_doc[x].files[0]) {
                if (pat_img.test(get_input_doc[x].files[0].name)) {
                    var size_file = get_input_doc[x].files[0].size / 1024;
                    if (size_file <= 25000) {
                        if (check_exist.getElementsByClassName("error")[0]) {
                            check_exist.removeChild(check_exist.getElementsByClassName("error")[0]);
                        }
                    } else {
                        get_input_doc[x].value = "";
                        if (check_exist.getElementsByClassName("error")[0]) {
                            check_exist.getElementsByClassName("error")[0].innerHTML = "El archivo es pesado";
                        } else {
                            crear_span_error(get_input_doc[x].parentElement.parentElement.parentElement, "El archivo es pesado");
                        }
                        get_input_doc[x].parentElement.getElementsByTagName("img")[0].src = "";
                    }
                } else {
                    get_input_doc[x].value = "";
                    if (!check_exist.getElementsByClassName("error")[0]) {
                        crear_span_error(get_input_doc[x].parentElement.parentElement.parentElement.parentElement, "El formato debe ser JPG / PNG");
                    } else {
                        check_exist.getElementsByClassName("error")[0].innerHTML = "El formato debe ser JPG / PNG";
                    }
                    get_input_doc[x].parentElement.getElementsByTagName("img")[0].src = "";
                }
            }
        }
        if (get_input_doc[x].type == "file") {
            if (get_input_doc[x].id == "file-7") {
                var check_exist = get_input_doc[x].parentElement.parentElement.parentElement;
                if (get_input_doc[x].files[0]) {
                    if (pat_pdf.test(get_input_doc[x].files[0].name)) {
                        var size_file = get_input_doc[x].files[0].size / 1024;
                        if (size_file <= 25000) {
                            if (check_exist.getElementsByClassName("error")[0]) {
                                check_exist.removeChild(check_exist.getElementsByClassName("error")[0]);
                            }
                        } else {
                            get_input_doc[x].value = "";
                            if (check_exist.getElementsByClassName("error")[0]) {
                                check_exist.getElementsByClassName("error")[0].innerHTML = "El archivo es pesado";
                            } else {
                                crear_span_error(get_input_doc[x].parentElement.parentElement.parentElement, "El archivo es pesado");
                            }
                        }
                    } else {
                        get_input_doc[x].value = "";
                        if (!check_exist.getElementsByClassName("error")[0]) {
                            crear_span_error(get_input_doc[x].parentElement.parentElement.parentElement, "El formato del archivo debe ser PDF");
                        } else {
                            check_exist.getElementsByClassName("error")[0].innerHTML = "El formato del archivo debe ser PDF";
                        }
                        var delete_span = get_input_doc[x].parentElement.getElementsByClassName("adj_span_del")[0];
                        get_input_doc[x].parentElement.removeChild(delete_span);
                        var change_span_label = get_input_doc[x].parentElement.getElementsByTagName("label")[0].getElementsByTagName("span");
                        get_input_doc[x].parentElement.getElementsByTagName("label")[0].classList.remove("seleccion");
                        change_span_label[0].innerHTML = "Adjuntar...";
                        change_span_label[1].innerHTML = "&#x0002B;";
                    }
                }
            }
        }
    }
}
if (document.getElementById("postulacion_js")) {
    var get_button = document.getElementById("boton_susc");
    get_button.onclick = function() {
        validar_form_nofiles(pat_text, "text");
        validar_text_area(pat_text_area);
        validar_files_imgypdf();
        var formu = document.getElementsByTagName("form")[0];
        if (formu.getElementsByClassName("error")[0]) {
            // alert ("hay errores");
        } else {
            // hacer submit
            // lo q sigue es para la muestra de la maqueta, resetea la maqueta. Al momento de trabajar los formularios, si es necesario eliminar solo las lineas que eliminen el value.
            var reset_inp = document.getElementsByTagName("input");
            document.getElementsByTagName("TEXTAREA")[0].value = "";
            var get_to_remove = document.getElementsByClassName("box");
            for (var x = 0; x < get_to_remove.length; x++) {
                if (get_to_remove[x].getElementsByTagName("img")[0]) {
                    console.log(get_to_remove[x].getElementsByTagName("img"));
                    get_to_remove[x].getElementsByTagName("img")[0].src = "";
                    if (get_to_remove[x].getElementsByClassName("icon-trash-empty")[0]) {
                        var span_remove = get_to_remove[x].getElementsByClassName("icon-trash-empty")[0];
                        console.log(span_remove);
                        get_to_remove[x].removeChild(span_remove);
                        if (get_to_remove[x].getElementsByTagName("label")[0]) {
                            get_to_remove[x].getElementsByTagName("label")[0].getElementsByTagName("span")[0].innerHTML = "+"
                        }
                    }
                }
            }
            for (var x = 0; x < reset_inp.length; x++) {
                reset_inp[x].value = "";
                if ((reset_inp[x].type == "file") && (reset_inp[x].id != "file-7" && reset_inp[x].id != "file-1" && reset_inp[x].id != "file-2")) {
                    console.log(reset_inp[x].id);
                    reset_inp[x].disabled = true;
                }
                if (reset_inp[x].id == "file-7") {
                    if (reset_inp[x].parentElement.getElementsByClassName("adj_span_del")[0]) {
                        var delete_span = reset_inp[x].parentElement.getElementsByClassName("adj_span_del")[0];
                        reset_inp[x].parentElement.removeChild(delete_span);
                        var change_span_label = reset_inp[x].parentElement.getElementsByTagName("label")[0].getElementsByTagName("span");
                        reset_inp[x].parentElement.getElementsByTagName("label")[0].classList.remove("seleccion");
                        change_span_label[0].innerHTML = "Adjuntar...";
                        change_span_label[1].innerHTML = "&#x0002B;";
                    }
                }
            }
        }
    }
}

function checkear_input_file(cont_madre, que_id) {
    if (cont_madre.getElementsByTagName("input")[0].files[0]) {
        if (pat_img.test(cont_madre.getElementsByTagName("input")[0].files[0].name)) {
            var size_file = cont_madre.getElementsByTagName("input")[0].files[0].size / 1024;
            if (size_file <= 25000) {
                if (cont_madre.getElementsByClassName("error")[0]) {
                    cont_madre.removeChild(cont_madre.getElementsByClassName("error")[0]);
                }
            } else {
                cont_madre.getElementsByTagName("input")[0].value = "";
                if (cont_madre.getElementsByClassName("error")[0]) {
                    cont_madre.getElementsByClassName("error")[0].innerHTML = "El archivo es pesado";
                } else {
                    crear_span_error(cont_madre, "El archivo es pesado");
                }
                cont_madre.getElementsByTagName("img")[0].src = "";
            }
        } else {
            cont_madre.getElementsByTagName("input")[0].value = "";
            if (!cont_madre.getElementsByClassName("error")[0]) {
                crear_span_error(cont_madre, "El formato debe ser JPG / PNG");
            } else {
                cont_madre.getElementsByClassName("error")[0].innerHTML = "El formato debe ser JPG / PNG";
            }
            cont_madre.getElementsByTagName("img")[0].src = "";
        }
    } else {
        if (!cont_madre.getElementsByClassName("error")[0]) {
            crear_span_error(cont_madre, "Debe cargar una imagen");
        } else {
            cont_madre.getElementsByClassName("error")[0].innerHTML = "Debe cargar una imagen";
        }
    }
}


/// editar registro de postulacion

if (document.getElementById("edicion_postulacion_js")){



    var pat_text = new RegExp(/[a-z]{3}/);
    var pat_text_area = new RegExp(/([a-z ]){30,}/);
    var pat_mail = new RegExp(/[\w-\.]{3,}@([\w-]{2,}\.)([\w-]{2,4}\.)?[\w-]{2,4}$/);
    var pat_img = new RegExp(/\.(jpg|png|gif)$/i);
    var pat_pdf = new RegExp(/\.(pdf)$/i);
    var in_sp = document.getElementsByClassName("input_err");
    var btn_editar = [];
    for (var x = 0; x < in_sp.length; x++) {
        btn_editar[x] = in_sp[x].getElementsByTagName("label")[0].getElementsByTagName("span")[0];
        btn_editar[x].numerito = x;
        in_sp[x].error = false;
        btn_editar[x].onclick = function() {
            if (in_sp[this.numerito].classList.contains("editar")) {
                if (in_sp[this.numerito].getElementsByTagName("input")[0]) {
                    if (in_sp[this.numerito].getElementsByTagName("input")[0].type == "text") {
                        in_sp[this.numerito].getElementsByTagName("input")[0].disabled = false;
                        in_sp[this.numerito].getElementsByTagName("input")[0].focus();
                    }
                }
                if (in_sp[this.numerito].getElementsByTagName("input")[0]) {
                    if (in_sp[this.numerito].getElementsByTagName("input")[0].type == "file") {
                        in_sp[this.numerito].getElementsByTagName("input")[0].disabled = false;
                        var get_span = in_sp[this.numerito].getElementsByClassName("box")[0].getElementsByTagName("label")[0].getElementsByTagName("span")[0];
                        if (in_sp[this.numerito].getElementsByTagName("input")[0].id == "file-1") {
                            get_span.innerHTML = "Cambiar logo";
                        }
                        if (in_sp[this.numerito].getElementsByTagName("input")[0].id == "file-2") {
                            var get_input_into = in_sp[this.numerito].getElementsByTagName("input");
                            for (var z = 0; z < get_input_into.length; z++) {
                                get_input_into[z].disabled = false;
                                if (get_input_into[z].parentElement.getElementsByTagName("img")[0].getAttribute('src') != "") {
                                    crear_span_basura = document.createElement("span");
                                    crear_span_basura.classList.add("icon-trash-empty");
                                    if (!get_input_into[z].parentElement.getElementsByClassName("icon-trash-empty")[0]) {
                                        // get_input_into[z].parentElement.appendChild(crear_span_basura);
                                        get_input_into[z].num = z;
                                        var create_span = get_input_into[z].parentElement.appendChild(crear_span_basura);
                                        create_span.onclick = function(z) {
                                            console.log(create_span.parentElement);
                                            if (create_span.parentElement.getElementsByTagName("img")[0].getAttribute('src') != "") {
                                                var guardar_span = create_span;
                                                guardar_span.parentElement.getElementsByTagName("img")[0].src = "";
                                                guardar_span.parentElement.getElementsByTagName("input")[0].value = "";
                                                guardar_span.parentElement.getElementsByTagName("label")[0].getElementsByTagName("span")[0].innerHTML = "&#x0002B;"
                                                create_span.parentElement.removeChild(guardar_span);
                                            }
                                        }
                                    }
                                }
                            }
                            // console.log(in_sp[this.numerito].getElementsByTagName("input")[0]);
                            get_span.innerHTML = "&#x0002B;";
                        }
                    }
                }
                if (in_sp[this.numerito].getElementsByTagName("input")[0]) {
                    if (in_sp[this.numerito].getElementsByTagName("input")[0].id == "file-7") {
                        if (in_sp[this.numerito].getElementsByClassName("icon-trash-empty")[0]) {
                            in_sp[this.numerito].getElementsByClassName("icon-trash-empty")[0].style.display = "inline-block";
                        }
                    }
                }
                if (in_sp[this.numerito].getElementsByTagName("textarea")[0]) {
                    in_sp[this.numerito].getElementsByTagName("textarea")[0].disabled = false;
                }
                btn_editar[this.numerito].innerHTML = "Guardar";
                in_sp[this.numerito].classList.remove("editar");
                in_sp[this.numerito].classList.add("guardar");
            } else if (in_sp[this.numerito].classList.contains("guardar")) {
                if (in_sp[this.numerito].getElementsByTagName("textarea")[0]) {
                    if (pat_text_area.test(in_sp[this.numerito].getElementsByTagName("textarea")[0].value)) {
                        in_sp[this.numerito].getElementsByTagName("textarea")[0].disabled = true;
                        btn_editar[this.numerito].innerHTML = "Editar";
                        in_sp[this.numerito].classList.remove("guardar");
                        in_sp[this.numerito].classList.add("editar");
                        in_sp[this.numerito].error = false;
                        if (in_sp[this.numerito].getElementsByClassName("error")[0]) {
                            in_sp[this.numerito].removeChild(in_sp[this.numerito].getElementsByClassName("error")[0]);
                        }
                        var get_modal_exito = document.getElementById("exito_msg");
                        open_modal(get_modal_exito);
                        var efecto1 = setTimeout(close(get_modal_exito), 600);
                        // hacer submit
                    } else {
                        in_sp[this.numerito].getElementsByTagName("textarea")[0].focus();
                        if (in_sp[this.numerito].error == false) {
                            if (!in_sp[this.numerito].getElementsByClassName("error")[0]) {
                                crear_span_error(in_sp[this.numerito], "Ingrese un 30 caracteres minimo")
                            }
                            in_sp[this.numerito].error = true;
                        }
                    }
                }
                if (in_sp[this.numerito].getElementsByTagName("input")[0]) {
                    var value_input = in_sp[this.numerito].getElementsByTagName("input")[0].value;
                    if (in_sp[this.numerito].getElementsByTagName("input")[0].type == "text" && in_sp[this.numerito].getElementsByTagName("input")[0].classList.contains("obligatorio")) {
                        if (pat_text.test(value_input)) {
                            in_sp[this.numerito].getElementsByTagName("input")[0].disabled = true;
                            btn_editar[this.numerito].innerHTML = "Editar";
                            in_sp[this.numerito].classList.remove("guardar");
                            in_sp[this.numerito].classList.add("editar");
                            in_sp[this.numerito].error = false;
                            if (in_sp[this.numerito].getElementsByClassName("error")[0]) {
                                in_sp[this.numerito].removeChild(in_sp[this.numerito].getElementsByClassName("error")[0]);
                            }
                            var get_modal_exito = document.getElementById("exito_msg");
                            open_modal(get_modal_exito);
                            var efecto1 = setTimeout(close(get_modal_exito), 600);
                            // hacer submit
                        } else {
                            in_sp[this.numerito].getElementsByTagName("input")[0].focus();
                            if (in_sp[this.numerito].error == false) {
                                if (!in_sp[this.numerito].getElementsByClassName("error")[0]) {
                                    crear_span_error(in_sp[this.numerito], "Ingrese un texto valido")
                                }
                                in_sp[this.numerito].error = true;
                            }
                        }
                    } else if (in_sp[this.numerito].getElementsByTagName("input")[0].type == "text") {
                        in_sp[this.numerito].getElementsByTagName("input")[0].disabled = true;
                        btn_editar[this.numerito].innerHTML = "Editar";
                        in_sp[this.numerito].classList.remove("guardar");
                        in_sp[this.numerito].classList.add("editar");
                        in_sp[this.numerito].error = false;
                        var get_modal_exito = document.getElementById("exito_msg");
                        open_modal(get_modal_exito);
                        var efecto1 = setTimeout(close(get_modal_exito), 600);
                        // hacer submit (envia input no obligatorios)
                    } else if (in_sp[this.numerito].getElementsByTagName("input")[0].type == "file") {
                        if (in_sp[this.numerito].getElementsByTagName("input")[0].id == "file-1") {
                            if (in_sp[this.numerito].getElementsByTagName("img")[0]) {
                                if (in_sp[this.numerito].getElementsByTagName("img")[0].getAttribute('src') == "") {
                                    checkear_input_file(in_sp[this.numerito], "file-1");
                                } else {
                                    if (in_sp[this.numerito].getElementsByTagName("input")[0].files[0]) {
                                        checkear_input_file(in_sp[this.numerito], "file-1");
                                    }
                                    if (!in_sp[this.numerito].getElementsByClassName("error")[0]) {
                                        in_sp[this.numerito].getElementsByTagName("input")[0].disabled = true;
                                        btn_editar[this.numerito].innerHTML = "Editar";
                                        in_sp[this.numerito].classList.remove("guardar");
                                        in_sp[this.numerito].classList.add("editar");
                                        in_sp[this.numerito].error = false;
                                        var get_modal_exito = document.getElementById("exito_msg");
                                        open_modal(get_modal_exito);
                                        var efecto1 = setTimeout(close(get_modal_exito), 600);
                                        // hacer submit
                                    }
                                }
                            }
                        } else if (in_sp[this.numerito].getElementsByTagName("input")[0].id == "file-2") {
                            var get_input_into = in_sp[this.numerito].getElementsByTagName("input");
                            for (var z = 1; z < get_input_into.length; z++) {
                                get_input_into[z].numerito = z;
                                if (get_input_into[z].files[0]) {
                                    console.log(get_input_into[z]);
                                    if (pat_img.test(get_input_into[z].files[0].name)) {
                                        var size_file = get_input_into[z].files[0].size / 1024;
                                        if (size_file <= 25000) {
                                            if (in_sp[this.numerito].getElementsByClassName("error")[0]) {
                                                in_sp[this.numerito].removeChild(in_sp[this.numerito].getElementsByClassName("error")[0]);
                                            }
                                        } else {
                                            get_input_into[z].value = "";
                                            if (in_sp[this.numerito].getElementsByClassName("error")[0]) {
                                                in_sp[this.numerito].getElementsByClassName("error")[0].innerHTML = "El archivo es pesado";
                                            } else {
                                                crear_span_error(in_sp[this.numerito], "El archivo es pesado");
                                            }
                                            get_input_into[z].parentElement.getElementsByTagName("img")[0].src = "";
                                            var eliminar_tacho = get_input_into[z].parentElement.getElementsByClassName("icon-trash-empty")[0];
                                            get_input_into[z].parentElement.removeChild(eliminar_tacho);
                                            get_input_into[z].parentElement.getElementsByTagName("label")[0].getElementsByTagName("span")[0].innerHTML = "&#x0002B;";
                                        }
                                    } else {
                                        get_input_into[z].value = "";
                                        if (!in_sp[this.numerito].getElementsByClassName("error")[0]) {
                                            crear_span_error(in_sp[this.numerito], "El formato debe ser JPG / PNG");
                                        } else {
                                            in_sp[this.numerito].getElementsByClassName("error")[0].innerHTML = "El formato debe ser JPG / PNG";
                                        }
                                        get_input_into[z].parentElement.getElementsByTagName("img")[0].src = "";
                                    }
                                }
                            }
                            if (in_sp[this.numerito].getElementsByTagName("img")[0]) {
                                if (in_sp[this.numerito].getElementsByTagName("img")[0].getAttribute('src') == "") {
                                    checkear_input_file(in_sp[this.numerito], "file-2");
                                } else {
                                    if (in_sp[this.numerito].getElementsByTagName("input")[0].files[0]) {
                                        checkear_input_file(in_sp[this.numerito], "file-2");
                                    }
                                    if (!in_sp[this.numerito].getElementsByClassName("error")[0]) {
                                        in_sp[this.numerito].getElementsByTagName("input")[0].disabled = true;
                                        btn_editar[this.numerito].innerHTML = "Editar";
                                        in_sp[this.numerito].classList.remove("guardar");
                                        in_sp[this.numerito].classList.add("editar");
                                        in_sp[this.numerito].error = false;
                                        var get_modal_exito = document.getElementById("exito_msg");
                                        open_modal(get_modal_exito);
                                        var efecto1 = setTimeout(close(get_modal_exito), 600);
                                        var get_input_into = in_sp[this.numerito].getElementsByTagName("input");
                                        for (var z = 0; z < get_input_into.length; z++) {
                                            get_input_into[z].disabled = true;
                                            if (get_input_into[z].parentElement.getElementsByClassName("icon-trash-empty")[0]) {
                                                var borrar_basura = get_input_into[z].parentElement.getElementsByClassName("icon-trash-empty")[0];
                                                get_input_into[z].parentElement.removeChild(borrar_basura);
                                                get_input_into[z].parentElement.getElementsByTagName("label")[0].getElementsByTagName("span")[0].innerHTML = "&#x0002B;"
                                            }
                                        }
                                        // hacer submit
                                    }
                                }
                            }
                        } else if (in_sp[this.numerito].getElementsByTagName("input")[0].id == "file-7") {
                            if (in_sp[this.numerito].getElementsByTagName("input")[0].files[0]) {
                                if (pat_pdf.test(in_sp[this.numerito].getElementsByTagName("input")[0].files[0].name)) {
                                    var size_file = in_sp[this.numerito].getElementsByTagName("input")[0].files[0].size / 1024;
                                    if (size_file <= 25000) {
                                        if (in_sp[this.numerito].getElementsByClassName("error")[0]) {
                                            in_sp[this.numerito].removeChild(in_sp[this.numerito].getElementsByClassName("error")[0]);
                                        }
                                    } else {
                                        in_sp[this.numerito].getElementsByTagName("input")[0].value = "";
                                        if (in_sp[this.numerito].getElementsByClassName("error")[0]) {
                                            in_sp[this.numerito].getElementsByClassName("error")[0].innerHTML = "El archivo es pesado";
                                        } else {
                                            crear_span_error(in_sp[this.numerito], "El archivo es pesado");
                                        }
                                    }
                                } else {
                                    in_sp[this.numerito].getElementsByTagName("input")[0].value = "";
                                    if (!in_sp[this.numerito].getElementsByClassName("error")[0]) {
                                        crear_span_error(in_sp[this.numerito], "El formato del archivo debe ser PDF");
                                    } else {
                                        in_sp[this.numerito].getElementsByClassName("error")[0].innerHTML = "El formato del archivo debe ser PDF";
                                    }
                                    var delete_span = in_sp[this.numerito].getElementsByClassName("adj_span_del")[0];
                                    in_sp[this.numerito].removeChild(delete_span);
                                    var change_span_label = in_sp[this.numerito].getElementsByTagName("label")[0].getElementsByTagName("span");
                                    in_sp[this.numerito].getElementsByTagName("label")[0].classList.remove("seleccion");
                                    change_span_label[0].innerHTML = "Adjuntar...";
                                    change_span_label[1].innerHTML = "&#x0002B;";
                                }
                            }
                            if (!in_sp[this.numerito].getElementsByClassName("error")[0]) {
                                in_sp[this.numerito].getElementsByTagName("input")[0].disabled = true;
                                btn_editar[this.numerito].innerHTML = "Editar";
                                in_sp[this.numerito].classList.remove("guardar");
                                in_sp[this.numerito].classList.add("editar");
                                in_sp[this.numerito].error = false;
                                var get_modal_exito = document.getElementById("exito_msg");
                                open_modal(get_modal_exito);
                                var efecto1 = setTimeout(close(get_modal_exito), 600);
                                if (in_sp[this.numerito].getElementsByClassName("icon-trash-empty")[0]) {
                                    in_sp[this.numerito].getElementsByClassName("icon-trash-empty")[0].style.display = "none";
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
