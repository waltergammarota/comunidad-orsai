@extends('2021-orsai-template')

@section('title', 'Home | Comunidad Orsai')
@section('description', 'Página de Inicio')

@section('content')  
{!! $home1 !!}
{{--     <section class="mainslider">
        <div>
            <div id="owlMainSlider" class="owl-carousel owl-theme">
                <div>
                    <div class="item"><img src="{{url('recursos/front2021/cine-1.jpg')}}" alt="Orsai producirá cine y será una película aparte">
                        <div class="banner_text_inside">
                            <h1 class="contenedor">Orsai producirá cine y será <span class="block_item">una película más</span>
                            </h1>
                            <div class="contenedor">
                                <p class="contenedor">El debut de «Orsai Audiovisuales» será con la adaptación del
                                    primer gran best-seller rioplatense de este siglo: la novela «La uruguaya», de Pedro
                                    Mairal.</strong></p>
                                <a href="{{url('novedades/orsai-audiovisual')}}"
                                   class="boton_redondeado resaltado_amarillo">
                                    <span>Ver proyecto</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="item"><img src="{{url('recursos/front2021/cine-3.jpg')}}" alt="Presentamos el nuevo proyecto Orsai para la década que viene">
                        <div class="banner_text_inside">

                            <h1 class="contenedor">Presentamos el nuevo proyecto Orsai <span class="block_item">para la década que viene</span>
                            </h1>
                            <div class="contenedor">
                                <p class="contenedor">El 1 de enero de 2021 nació la <strong>Fundación Orsai</strong>,
                                    con sede física en Mercedes, sede virtual en <i>ComunidadOrsai.org</i> y con las
                                    características legales y jurídicas de una organización sin fines de lucro.</p>

                                <a href="{{url('novedades/piedra-fundamental')}}"
                                   class="boton_redondeado resaltado_amarillo">
                                    <span>Ver proyecto</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="item"><img src="{{url('recursos/front2021/pasport-1.jpg')}}" alt="Nuestra sede física: una historia que empezó hace 40 años">
                        <div class="banner_text_inside">
                            <h1 class="contenedor">Derechos y obligaciones para los  <span class="block_item">Socios Fundadores de la Comunidad</span>
                            </h1>
                            <div class="contenedor">
                                <p class="contenedor">Nos cedieron el ex Cine de Mercedes hasta el año 2040, y vamos a
                                    hacer que ese lugar se convierta en la capital hispanoamericana de la narrativa del
                                    siglo XXI.</strong></p>
                                <a href="{{url('novedades/la-sede-fisica')}}"
                                   class="boton_redondeado resaltado_amarillo">
                                    <span>Ver proyecto</span>
                                </a> 
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section> --}}
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
    <section class="resaltado_gris pd_tp_bt pd_20 widt_100">
        <div class="contenedor grilla_3 card_style_4_grid"> 
            @if (!Auth::check()) 
                <article class="card_style_4 card_style_4_tit">
                    <h2 class=""><strong>¿Querés ser parte?</strong><br>Participar de Orsai es gratis, divertido y a veces incluso legal.</h2>
                    <p>Si te apurás serás un <a href="{{url('novedades/socios-fundadores')}}" class="link_subrayado"><span>«socio fundador»</span></a></p>
                </article>
            @else
                @if(Auth::user()->phone_verified_at) 
                    <article class="card_style_4 card_style_4_tit">
                        <h2 class=""><strong>¡Mirálo de adentro!</strong><br>Sentate tranqui en la vereda a ver cómo crecen los socios posta.</h2>
                        <p>Tus derechos como <a href="{{url('novedades/socios-fundadores')}}" class="link_subrayado"><span>«socio fundador»</span></a></p>
                    </article>
                @else
                    <article class="card_style_4 card_style_4_tit">
                        <h2 class=""><strong>¡Adiós fase beta!</strong><br>Es momento de que certifiques tu identidad, así que
                            mejor peináte.</h2>
                        <p>Los primeros 15.000 serán <a href="{{url('novedades/socios-fundadores')}}" class="link_subrayado"><span>«fundadores»</span></a></p>
                    </article>
                @endif
            @endif   
            <article class="card_style_4 ">
                <div>
                    <span class="icono icon-card"></span>
                    <h2>{{$sociosBeta}}</h2>
                    <p>socios beta</p>
                </div>
            </article>
            <article class="card_style_4">
                <div>
                    <span class="icono icon-ficha"></span>
                    <h2>{{$sociosPosta}}</h2>
                    <p>socios posta</p>
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
    
<section class="pd_tp_bt">
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
{!! $home2 !!}
    {{-- 
    <section class="resaltado_black pd_tp_bt pd_20">
        <div class="contenedor titulo_seccion_med">
            <h2>Más sobre <span class="color_amarillo">la Fundación</span></h2>
        </div>
        <div class="contenedor grilla_3">  
            <article class="item card_style_3">
                <div class="card_img">
                    <a href="{{url('novedades/voluntariado-y-biblioteca')}}">
                        <img src="{{url('recursos/front2021/novedades-1.jpg')}}" alt="Imagen sobre la fundacion"/>
                    </a>
                </div>
                <a href="{{url('novedades/voluntariado-y-biblioteca')}}">
                    <h3 class="color_amarillo">Desde 2021 la Fundación Orsai va a crear una Biblioteca de Escritores
                        Vivos</h3>
                </a>
                <p>La sede física (el exCine Español de Mercedes) recibirá los volúmenes donados y la comunidad los
                    grabará en voz alta.</p>
                <a href="{{url('novedades/voluntariado-y-biblioteca')}}" class="boton_redondeado resaltado_amarillo">
                    <span>Más info</span>
                </a> 
            </article>
            <article class="item card_style_3">
                <div class="card_img">
                    <a href="{{url('novedades/orsai-edicion-10-aniversario')}}">
                        <img src="{{url('recursos/front2021/novedades-2.jpg')}}" alt="Imagen sobre la fundacion"/>
                    </a>
                </div>
                <a href="{{url('novedades/orsai-edicion-10-aniversario')}}">
                    <h3 class="color_amarillo">Una maravilla en papel de 400 páginas para celebrar diez años de
                        Orsai</h3>
                </a>
                <p>Un catálogo que será frontera entre la Editorial y la Fundación. Y como dios manda: son historias de
                    los lectores.</p>
                <a href="{{url('novedades/orsai-edicion-10-aniversario')}}" class="boton_redondeado resaltado_amarillo">
                    <span>Más info</span>
                </a>
            </article>
            <article class="item card_style_3">
                <div class="card_img">
                    <a href="{{url('novedades/sistema-de-fichas')}}">
                        <img src="{{url('recursos/front2021/novedades-3.jpg')}}" alt="Imagen sobre la fundacion"/>
                    </a>
                </div>
                <a href="{{url('novedades/sistema-de-fichas')}}">
                    <h3 class="color_amarillo">La casa invita: el sistema de fichas en la comunidad y cómo
                        conseguirlas</h3>
                </a>
                <p>Las fichas serán recursos para valorar proyectos que ComunidadOrsai.org les entregará a sus
                    benefactores a cambio de tiempo o plata.</p>
                <a href="{{url('novedades/sistema-de-fichas')}}" class="boton_redondeado resaltado_amarillo">
                    <span>Más info</span>
                </a>
            </article> 
        </div>
    </section> --}}
@endsection
