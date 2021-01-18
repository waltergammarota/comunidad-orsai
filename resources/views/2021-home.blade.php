@extends('2021-orsai-template')

@section('title', 'Home | Comunidad Orsai')
@section('description', 'Página de Inicio')

@section('content') 
    @php
        require "slider.php";
    @endphp 
   {{-- <section class="mainslider">
        <div>
            <div id="owlMainSlider" class="owl-carousel owl-theme">
                <div>
                    <div class="item"><img src="{{url('recursos/front2021/cine-1.jpg')}}" alt="Orsai producirá cine y será una película aparte">
                        <div class="banner_text_inside">
                            <h1 class="contenedor">Orsai producirá cine y será <span class="block_item">una película aparte</span>
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
                    <div class="item"><img src="{{url('recursos/front2021/cine-2.jpg')}}" alt="Nuestra sede física: una historia que empezó hace 40 años">
                        <div class="banner_text_inside">
                            <h1 class="contenedor">Nuestra sede física: una historia <span class="block_item">que empezó hace 40 años</span>
                            </h1>
                            <div class="contenedor">
                                <p class="contenedor">Nos cedieron el ex Cine de Mercedes hasta el año 2040, y vamos a
                                    hacer que ese lugar se convierta en la capital hispanoamericana de la narrativa del
                                    siglo veintiuno.</strong></p>
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
    </section>--}}
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
    @php
        include "fundacion.php";
    @endphp 
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
