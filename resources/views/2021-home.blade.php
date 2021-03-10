@extends('2021-orsai-template')

@section('title', 'Home | Comunidad Orsai')
@section('description', 'Página de Inicio')

@section('content')
    {!! $home1 !!}
    <section class="resaltado_gris pd_tp_bt pd_20 widt_100 modulo">
        <div class="contenedor grilla_3 card_style_4_grid">
            @if (!Auth::check())
                <article class="card_style_4 card_style_4_tit">
                    <h2 class=""><strong>¿Querés ser parte?</strong><br>Participar de Orsai es gratis, divertido y a
                        veces incluso legal.</h2>
                    <p>Si te apurás serás un <a href="{{url('novedades/socios-fundadores')}}"
                                                class="link_subrayado"><span>«socio fundador»</span></a></p>
                </article>
            @else
                @if(Auth::user()->phone_verified_at)
                    <article class="card_style_4 card_style_4_tit">
                        <h2 class=""><strong>¡Mirálo de adentro!</strong><br>Sentate tranqui en la vereda a ver cómo
                            crecen los socios posta.</h2>
                        <p>Tus derechos como <a href="{{url('novedades/socios-fundadores')}}"
                                                class="link_subrayado"><span>«socio fundador»</span></a></p>
                    </article>
                @else
                    <article class="card_style_4 card_style_4_tit">
                        <h2 class=""><strong>¡Adiós fase beta!</strong><br>Es momento de que certifiques tu identidad,
                            así que
                            mejor peináte.</h2>
                        <p>Los primeros 15.000 serán <a href="{{url('novedades/socios-fundadores')}}"
                                                        class="link_subrayado"><span>«fundadores»</span></a></p>
                    </article>
                @endif
            @endif
            <article class="card_style_4 ">
                <div>
                    <span class="icono icon-card"></span>
                    <h2>{{$sociosBeta}}</h2>
                    <p>socios en lista de espera</p>
                </div>
            </article>
            <article class="card_style_4">
                <div>
                    <span class="icono icon-ficha"></span>
                    <h2>{{$sociosPosta}}</h2>
                    <p>socios fundadores</p>
                </div>
            </article>
        </div>
        @if (!Auth::check())
            <div class="contenedor cont_bt">
                <a href="{{url('registrarse')}}" class="boton_redondeado resaltado_amarillo">
                    <span>Asociáte ahora</span>
                </a>
            </div>
        @else
            @if(Auth::user()->phone_verified_at)
                <div class="contenedor cont_bt">
                    <a href="{{url('perfil')}}" class="boton_redondeado resaltado_amarillo">
                        <span>Tu información personal</span>
                    </a>
                </div>
            @else
                <div class="contenedor cont_bt">
                    <a href="{{url('validacion-usuario')}}" class="boton_redondeado resaltado_amarillo">
                        <span>Confirmá tu membresía</span>
                    </a>
                </div>
            @endif
        @endif
    </section>
    {!! $home2 !!}
    @if (Auth::check())
        @if(Session::get('role') == "admin")
            <section id="modulos_administrador"
                     style="padding:40px;text-align:center; background:rgb(209, 0, 0);font-size:16px;color:#fff;">
                <span style="font-size:24px;">MÓDULOS VISIBLES PARA ADMINISTRADORES</span><br/>
                <span style="font-size:32px;">&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;</span>
            </section>
            <section class="resaltado_amarillo pd_tp_bt pd_20">
                <div class="contenedor titulo_seccion_sm">
                    <h2>Doná para apostar a proyectos</h2>
                </div>
                <div class="center_div">
                    <div class="contenedor grilla_3 mg_0">
                        <article class="card_style_2">
                            <span class="icono">Pack 01</span>
                            <h2><strong>500</strong> fichas</h2>
                            <p>son <strong>10</strong> doláres</p>
                            <a href="#" class="boton_redondeado resaltado_amarillo">
                                <span>Donar</span>
                            </a>
                        </article>
                        <article class="card_style_2">
                            <span class="icono">Pack 02</span>
                            <h2><strong>1000</strong> fichas</h2>
                            <p>son <strong>20</strong> doláres</p>
                            <a href="#" class="boton_redondeado resaltado_amarillo">
                                <span>Donar</span>
                            </a>
                        </article>
                        <article class="card_style_2 card_style_2_black">
                            <span class="icono color_amarillo">Pack 03</span>
                            <h2 class="color_amarillo"><strong>2000</strong> fichas</h2>
                            <p class="color_amarillo">son <strong>30</strong> dólares</p>
                            <a href="#" class="boton_redondeado resaltado_amarillo">
                                <span>Donar</span>
                            </a>
                        </article>
                    </div>
                </div>
                <div class="btn_owl_mas ">
                    <div class="form_ctrl input_ ">
                        <div class="align_center">
                            <a href="{{url('donar')}}" class="boton_redondeado">Ver todos los paquetes</a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="pd_tp_bt modulo">
                <div class="owl_demo_7 owl-carousel owl-theme">
                    <article class="">
                        <a href="#">
                            <div class="cont_article">
                                <div class="cont_article_align">

                                    <div class="texto">
                                        <div class="msg_over_img rojo">
                                            <span class="_barlow_text color_blanco text_medium">Finalizado</span>
                                        </div>
                                        <div class="icono ">
                                            <span class="icon-lapiz_2"></span>
                                        </div>
                                        <Span class="_barlow_text text_bold categoria">Concurso</Span>
                                        <h2 class="_barlow_text text_bold titulo">Un logo para la fundación</h2>
                                    </div>
                                    <div class="cont_btn_y_fichas">
                                        <div class="form_ctrl input_">
                                            <div class="align_left">
                                                <span class="boton_redondeado pd_25_lf_rg">Conocer más</span>
                                            </div>
                                        </div>
                                        <div class="fichas_apostadas">
                                            <span class="fichas_cant _barlow_text text_bold">3.210.73</span>
                                            <span class="_barlow_text text_regular">Fichas apostadas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                    <article class="">
                        <a href="#">
                            <div class="cont_article">
                                <div class="cont_article_align">
                                    <div class="texto">
                                        <div class="msg_over_img transparente">
                                            <span class="_barlow_text color_negro text_medium">Cierre: 15/03/2021</span>
                                        </div>
                                        <div class="icono">
                                            <span class="icon-libro"></span>
                                        </div>
                                        <Span class="_barlow_text text_bold categoria">Concurso</Span>
                                        <h2 class="_barlow_text text_bold titulo">Cuento corto con Jurado Popular</h2>
                                    </div>
                                    <div class="cont_btn_y_fichas">
                                        <div class="form_ctrl input_">
                                            <div class="align_left">
                                                <span class="boton_redondeado pd_25_lf_rg">Participar</span>
                                            </div>
                                        </div>
                                        <div class="fichas_apostadas">
                                            <span class="fichas_cant _barlow_text text_bold ">17.890</span>
                                            <span class="_barlow_text text_regular ">Fichas apostadas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                    <article class="">
                        <a href="#">
                            <div class="cont_article">
                                <div class="cont_article_align">
                                    <div class="texto">
                                        <div class="icono">
                                            <span class="icon-lapiz_2"></span>
                                        </div>
                                        <Span class="_barlow_text text_bold categoria">Concurso</Span>
                                        <h2 class="_barlow_text text_bold titulo">Un logo para la fundación </h2>
                                    </div>
                                    <div class="cont_btn_y_fichas">
                                        <div class="form_ctrl input_">
                                            <div class="align_left">
                                                <span class="boton_redondeado pd_25_lf_rg">Conocer más</span>
                                            </div>
                                        </div>
                                        <div class="fichas_apostadas">
                                            <span class="fichas_cant _barlow_text text_bold ">3.210.73</span>
                                            <span class="_barlow_text text_regular ">Fichas apostadas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                    <article class="gris_oscuro">
                        <a href="#">
                            <div class="cont_article">
                                <div class="cont_article_align">
                                    <div class="texto">
                                        <div class="msg_over_img rojo">
                                            <span class="_barlow_text color_blanco text_medium">Muy pronto</span>
                                        </div>
                                        <div class="icono">
                                            <span class="icon-lapiz_2"></span>
                                        </div>
                                        <Span class="_barlow_text text_bold categoria">Concurso Próximo</Span>
                                        <h2 class="_barlow_text text_bold titulo">Un logo para la fundación </h2>
                                    </div>
                                    <div class="cont_btn_y_fichas">
                                        <div class="form_ctrl input_">
                                            <div class="align_left">
                                                <span class="boton_redondeado pd_25_lf_rg">Conocer más</span>
                                            </div>
                                        </div>
                                        <div class="fichas_apostadas">
                                            <span class="fichas_cant _barlow_text text_bold ">3.210.73</span>
                                            <span class="_barlow_text text_regular ">Fichas apostadas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                </div>
                <div class="btn_owl_mas ">
                    <div class="form_ctrl input_ ">
                        <div class="align_center">
                            <a href="#" class="boton_redondeado resaltado_blanco">Ver todos los concursos</a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="banner_100">
                <div class="img_banner_100">
                    <img src="{{'recursos/img_nota_1.png'}}" alt="">
                </div>
                <div class="contenedor_100">
                    <div class="texto">
                        <span class=" text_medium">Espacio para <span class=" color_amarillo"> Banner ancho 100%</span></span>
                        <div class="btn_banner_100 ">
                            <div class=" input_ ">
                                <div class="">
                                    <a href="#" class="boton_redondeado resaltado_amarillo pd_50_lf_rg">Ver más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="contenedor contenedor_fichas pd_tp_bt">
                <div class="banner_fichas">
                    <div class="triangle-border">
                        <div class="contenedor_100_fichas">
                            <div class="texto">
                                <div class="text_1">
                                    <span class=" text_medium">Proponenos concursos</span>
                                </div>
                                <div class="text_2">
                                    <span class=" text_medium">¿Tenés una idea? Contanos de qué se trata</span>
                                </div>
                                <div class="btn_banner_100_fichas ">
                                    <div class=" input_ ">
                                        <div class="align_right">
                                            <a href="#"
                                               class="boton_redondeado resaltado_black pd_50_lf_rg">Proponer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="pd_tp_bt pd_20 modulo">
                <div class="contenedor titulo_seccion_sm">
                    <h2>Actividades</h2>
                </div>
                <div class="center_div">
                    <div class="contenedor grilla_3 mg_0 card_style_5_flex">
                        <div id="owl_demo_5" class="owl_demo_cards owl-carousel owl-theme">

                            <article class="card_style_5">
                                <a href="#">
                                    <img src="{{'recursos/actividades_1.png'}}" alt="">
                                    <span class="icono color_amarillo">Evento literario</span>
                                    <h2 class="_barlow_text text_medium titulo">Primer encuentro nacional de
                                        escritores</h2>
                                    <div class="form_ctrl input_">
                                        <div class="align_left">
                                            <span class="boton_redondeado btn_transparente_amarillo pd_25_lf_rg">Conocer más</span>
                                        </div>
                                    </div>
                                </a>
                            </article>
                            <article class="card_style_5">
                                <a href="#">
                                    <img src="{{'recursos/actividades_2.png'}}" alt="">
                                    <span class="icono color_amarillo">Convocatorias abiertas</span>
                                    <h2 class="_barlow_text text_medium titulo">Proyectos de investigación con jurado
                                        abierto</h2>
                                    <div class="form_ctrl input_">
                                        <div class="align_left">
                                            <span href="#"
                                                  class="boton_redondeado btn_transparente_amarillo pd_25_lf_rg">Ver más</span>
                                        </div>
                                    </div>
                                </a>
                            </article>
                            <article class="card_style_5">
                                <a href="#">
                                    <img src="{{'recursos/actividades_3.png'}}" alt="">
                                    <span class="icono color_amarillo">Publicaciones</span>
                                    <h2 class="_barlow_text text_medium titulo">La revista científica digital de
                                        Fundación Orsai</h2>
                                    <div class="form_ctrl input_">
                                        <div class="align_left">
                                            <span href="#"
                                                  class="boton_redondeado btn_transparente_amarillo pd_25_lf_rg">Leer más</span>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        </div>
                    </div>
                    <div class="contenedor grilla_3 mg_0">
                        <div class="form_ctrl input_">
                            <div class="align_center">
                                <a href="#" class="boton_redondeado btn_transparente_negro pd_50_lf_rg">Ver todas las
                                    actividades</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="pd_tp_bt pd_20 modulo">
                <div class="contenedor titulo_seccion_sm">
                    <h2>Cursos de formación</h2>
                </div>
                <div class="center_div">
                    <div class="contenedor grilla_3 mg_0 card_style_5_flex">
                        <div id="owl_demo_6" class="owl_demo_cards owl-carousel owl-theme">
                            <article class="card_style_5_b">
                                <a href="#">
                                    <div class="msg_over_img">
                                        <span class="_barlow_text color_blanco text_medium">ultimos cupos</span>
                                    </div>
                                    <div>
                                        <img src="{{'recursos/curso_1.png'}}" alt="">
                                    </div>
                                    <div class="card_titulo">
                                        <h2 class="_barlow_text text_medium titulo">Escritura narativa</h2>

                                    </div>
                                    <div class="form_ctrl input_">
                                        <div class="align_left">
                                            <span class="resaltado_amarillo boton_redondeado ">Inscripción</span>
                                        </div>
                                    </div>
                                    <div class="fecha_insc">
                                        <span class="_barlow_text ">Inicio: 24/02/2021</span>
                                    </div>
                                </a>
                            </article>
                            <article class="card_style_5_b">
                                <a href="#">
                                    <div>
                                        <img src="{{'recursos/curso_2.png'}}" alt="">
                                    </div>
                                    <div class="card_titulo">
                                        <h2 class="_barlow_text text_medium titulo">Narrativa digital</h2>

                                    </div>
                                    <div class="form_ctrl input_">
                                        <div class="align_left">
                                            <span class="resaltado_amarillo boton_redondeado ">Inscripción</span>
                                        </div>
                                    </div>
                                    <div class="fecha_insc">
                                        <span class="_barlow_text ">Inicio: 24/02/2021</span>
                                    </div>
                                </a>
                            </article>
                            <article class="card_style_5_b">
                                <a href="#">
                                    <div class="msg_over_img">
                                        <span class="_barlow_text color_blanco text_medium">ultimos cupos</span>
                                    </div>
                                    <div>
                                        <img src="{{'recursos/curso_3.png'}}" alt="">
                                    </div>
                                    <div class="card_titulo">
                                        <h2 class="_barlow_text text_medium titulo">Mi primer podcast</h2>
                                    </div>
                                    <div class="form_ctrl input_">
                                        <div class="align_left">
                                            <span class="resaltado_amarillo boton_redondeado ">Inscripción</span>
                                        </div>
                                    </div>
                                    <div class="fecha_insc">
                                        <span class="_barlow_text ">Inicio: 24/02/2021</span>
                                    </div>
                                </a>
                            </article>
                        </div>
                    </div>
                    <div class="contenedor grilla_3 mg_0">
                        <div class="form_ctrl input_">
                            <div class="align_center">
                                <a href="#" class="boton_redondeado btn_transparente_negro pd_50_lf_rg">Ver todos los
                                    cursos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="carrousel_notas pd_tp_bt modulo">
                <div id="owl-demo_2" class="owl-carousel owl-theme">
                    <div class="item" data-merge="1.5">
                        <div class="titulo_seccion_sm">
                            <h2>Últimas novedades</h2>
                        </div>
                        <div class="nota_img_preview">
                            <img src="{{'recursos/img_nota_1.png'}}" alt="">
                        </div>
                        <div class="nota_cuerpo_preview">
                            <div class="cuerpo_texto">
                                <div class="share_redes">
                                    <div class="resaltado_gris">
                                        <a href="https://twitter.com/intent/tweet?text=MENSAJE&amp;url=LINKNOVEDAD&amp;via=comunidadorsai&amp;lang=es"
                                           target="_blank"
                                           onclick="window.open(this.href, this.target, 'width=400,height=300'); return false;"
                                           title="Twittear novedad" rel="noopener noreferrer"><span
                                                class="icono icon-tw"></span></a>
                                    </div>
                                    <div class="resaltado_gris">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=LINKNOVEDAD"
                                           title="Compartir esta novedad" target="_blank"
                                           onclick="window.open(this.href, this.target, 'width=400,height=300'); return false;"
                                           rel="noopener noreferrer"><span class="icono icon-fb"></span></a>
                                    </div>
                                    <div class="resaltado_gris">
                                        <a href="whatsapp://send?text=MENSAJE – LINKNOVEDAD"
                                           data-action="share/whatsapp/share" target="_blank" rel="noopener noreferrer"><span
                                                class="icono icon-whatsapp"></span></a>
                                    </div>
                                </div>
                                <div class="datos_nota">
                                    <div class="fecha_nota">
                                        <span class="color_gris">12-11-20</span>
                                    </div>
                                    <div class="comentarios">
                                        <span class="icono icon-talk"></span>
                                        <span class="color_gris">21</span>
                                    </div>
                                </div>
                                <div class="nota_preview">
                                    <h3>Librería de escritores vivos</h3>
                                    <p>Conocé a los autores seleccionados para ponerle voz a tus cuentos. Lorem ipsum
                                        dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                                        tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim
                                        veniam, quis nostrud exerci tation ullamcorper suscipit lobortis.</p>
                                </div>
                            </div>
                            <a href="#" class="boton_redondeado borde_negro">
                                <span>Ver todas las novedades</span>
                            </a>
                        </div>
                    </div>
                    <div class="item" data-merge="1.5">
                        <div class="titulo_seccion_sm">
                            <h2>Últimas novedades</h2>
                        </div>
                        <div class="nota_img_preview">
                            <img src="{{'recursos/img_nota_1.png'}}" alt="">
                        </div>
                        <div class="nota_cuerpo_preview">
                            <div class="cuerpo_texto">
                                <div class="share_redes">
                                    <div class="resaltado_gris">
                                        <a href="https://twitter.com/intent/tweet?text=MENSAJE&amp;url=LINKNOVEDAD&amp;via=comunidadorsai&amp;lang=es"
                                           target="_blank"
                                           onclick="window.open(this.href, this.target, 'width=400,height=300'); return false;"
                                           title="Twittear novedad" rel="noopener noreferrer"><span
                                                class="icono icon-tw"></span></a>
                                    </div>
                                    <div class="resaltado_gris">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=LINKNOVEDAD"
                                           title="Compartir esta novedad" target="_blank"
                                           onclick="window.open(this.href, this.target, 'width=400,height=300'); return false;"
                                           rel="noopener noreferrer"><span class="icono icon-fb"></span></a>
                                    </div>
                                    <div class="resaltado_gris">
                                        <a href="whatsapp://send?text=MENSAJE – LINKNOVEDAD"
                                           data-action="share/whatsapp/share" target="_blank" rel="noopener noreferrer"><span
                                                class="icono icon-whatsapp"></span></a>
                                    </div>
                                </div>
                                <div class="datos_nota">
                                    <div class="fecha_nota">
                                        <span class="color_gris">12-11-20</span>
                                    </div>
                                    <div class="comentarios">
                                        <span class="icono icon-talk"></span>
                                        <span class="color_gris">21</span>
                                    </div>
                                </div>
                                <div class="nota_preview">
                                    <h3>Librería de escritores vivos</h3>
                                    <p>Conocé a los autores seleccionados para ponerle voz a tus cuentos. Lorem ipsum
                                        dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                                        tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim
                                        veniam, quis nostrud exerci tation ullamcorper suscipit lobortis.</p>
                                </div>
                            </div>
                            <a href="#" class="boton_redondeado borde_negro">
                                <span>Ver todas las novedades</span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>


            <section class="cont_banner_50 resaltado_amarillo">
                <div class="banner_50">
                    <div class="img_banner_50">
                        <img src="{{'recursos/banner_100.png'}}" alt="">
                    </div>
                    <div class=" contenedor_50">
                        <div class="texto">
                            <span class=" text_medium">Espacio para <span
                                    class=" color_amarillo"> Banner ancho 100%</span></span>
                            <div class="btn_banner_50">
                                <div class=" input_ ">
                                    <div class="align_left">
                                        <a href="#" class="boton_redondeado resaltado_amarillo pd_25_lf_rg">Ver más</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="banner_50">
                    <div class="img_banner_50">
                        <img src="{{'recursos/banner_100.png'}}" alt="">
                    </div>
                    <div class="contenedor_50">
                        <div class="texto">
                            <span class=" text_medium">Espacio para <span
                                    class=" color_amarillo"> Banner ancho 100%</span></span>
                            <div class="btn_banner_50">
                                <div class=" input_ ">
                                    <div class="align_left">
                                        <a href="#" class="boton_redondeado resaltado_black pd_25_lf_rg">Ver más</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="modulos_administrador"
                     style="padding:40px;text-align:center; background:rgb(209, 0, 0);font-size:16px;color:#fff;">
                <span style="font-size:32px;">&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;</span><br/>
                <span style="font-size:24px;">MÓDULOS VISIBLES PARA ADMINISTRADORES</span>
            </section>
        @endif
    @endif
@endsection
