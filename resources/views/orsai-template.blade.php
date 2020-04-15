<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
        href="https://fonts.googleapis.com/css?family=Space+Mono:400,400i,700,700i&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{url('estilos/menu.css')}}">
    <link rel="stylesheet" href="{{url('css/fontello.css')}}">
    <link rel="stylesheet" href="{{url('owlcarousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('owlcarousel/owl.theme.default.css')}}">
    <link rel="stylesheet" href="{{url('estilos/estilos.css')}}">
    <link rel="stylesheet" href="{{url('estilos/orsai-blade.css')}}">
    <script src="{{url('js/segment.js')}}"></script>
    <script src="{{url('js/ease.min.js')}}"></script>
    @if (Route::currentRouteName() == 'registrarse')
        <script src="https://www.google.com/recaptcha/api.js" async
                defer></script>
    @endif
    <title>{{ $title ?? '' }}</title>
    <meta name="description"
          content="Maximo 160 caracteres, la descripcion debe ser unica por cada pagina interna.">
</head>
<body>

<div class="fondo_blanco">
    <header class="contenedor">
        @include('header_footer')
    </header>

@yield('content')
</div>


<!-- footer -->
    <footer>
        <div class="fondo_blanco">
            <div class="footer_black">
                <div class="contenedor">
                    <div id="links_footer">
                        <div id="logo_footer">
                            <a href="#">Necesitamos un logo</a>
                        </div>
                        <div>
                            <ul>
                                <li><a href="#">Inicio</a></li>
                                <li><a href="#">Fundación</a></li>
                                <li><a href="#">Concursos</a></li>
                                <li><a href="#">Donaciones y fichas Estatuto</a>
                                </li>
                                <li><a href="#">Plan a tres años</a></li>
                                <li><a href="#">Contacto</a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="links_redes">
                        <ul>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Instagram</a></li>
                            <li><a href="#">Facebook</a></li>
                        </ul>
                    </div>
                    <div id="links_registro">
                        <span>Registro al concurso</span>
                        <div id="links_registro_a">
                            <a href="{{url('registrarse')}}"
                               class="texto_italica subrayado resaltado_amarillo">ser
                                miembro</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contenedor sub_footer">
            <div class="sub_footer_lf">
                <div>
                    <img src="recursos/orsai_logo_footer.svg"
                         alt="Logo Orsai Footer">
                </div>
                <div>
                    <p class="texto_italica">Un blog puede convertirse en
                        cualquier
                        cosa</p>
                </div>
            </div>
            <div class="sub_footer_ri">
                <div>
                    <ul>
                        <li><a href="{{url('terminos')}}">Terminos &amp; Condiciones</a></li>
                        <li><a href="{{url('privacidad')}}">Privacidad</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{url('js/jquery.js')}}"></script>
    <script src="{{url('js/main.js')}}"></script>
@yield('footer')
</body>
</html>
