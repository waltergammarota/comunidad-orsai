<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Space+Mono:400,400i,700,700i&display=swap" rel="stylesheet">
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
    <meta name="description" content="Maximo 160 caracteres, la descripcion debe ser unica por cada pagina interna.">

    <!-- Facebook -->
    <meta property="og:site_name" content="Fundación Orsai"/>
    <meta property="og:url" content="#"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="#"/>
    <meta property="og:description" content="#"/>
    <meta property="og:image" content="#"/>

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="#"/>
    <meta name="twitter:creator" content="#"/>
    <meta name="twitter:image" content="#"/>
    <meta property="og:title" content="#"/>
    <meta property="og:description" content="#"/>

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
                        <a href="{{url('logo')}}">Necesitamos un logo</a>
                    </div>
                    <div>
                        <ul>
                            <li><a href="{{url('/')}}">Inicio</a></li>
                            <li><a href="{{url('bases-concurso')}}">Bases del concurso</a></li>
                            <li><a href="{{url('noticias')}}">Noticias</a></li>
                            <li><a href="{{url('contacto')}}">Contacto</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="links_redes">
                    <span>Seguinos en redes</span> 
                    <ul>
                        <li><a href="http://twitter.com/fundacionorsai" target="_blank">Twitter</a></li>
                        <li><a href="https://instagram.com/fundacionorsai" target="_blank">Instagram</a></li>
                        <li><a href="https://facebook.com/fundacionorsai" target="_blank">Facebook</a></li>
                    </ul>
                </div> 
            </div>
        </div>
    </div>
    <div class="contenedor sub_footer">
        <div class="sub_footer_lf">
            <div>
                <img src="{{url('recursos/orsai_logo_footer.png')}}" alt="Orsai">
            </div>
            <div>
                <p class="texto_italica">Un blog puede convertirse en cualquier cosa</p>
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


<div id="cookies_msg" class="popup" style="display: none;">
    <div>
        <div class="contenedor">
            <p>Utilizamos <strong>cookies</strong> para personalizar el contenido, adaptar y evaluar los anuncios y ofrecer una
                experiencia más segura. Al navegar por el sitio web, aceptás el uso de cookies para recopilar información dentro y fuera de
                Orsai. Leé nuestra <a href="{{url('privacidad')}}" target="_blank" class="subrayado text_bold">Política de cookies</a> de cookies para obtener más información o accedé a las Preferencias de cookies para administrar tu configuración</p>
            <a  id="btn_cookies" class="subrayado resaltado_amarillo text_bold">Aceptar</a>
        </div>
    </div>
</div>

<script src="{{url('js/jquery.js')}}"></script>
<script src="{{url('js/main.js')}}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
<script>

    $(document).ready(() => {
        if (Cookies.get('approved-cookies') != "true") {
            $("#cookies_msg").show();
        }
    });

    if (document.getElementById("cookies_msg")) {
        var get_aceptar_cookies = document.getElementById("btn_cookies"); 
        get_aceptar_cookies.onclick = function () {  
            Cookies.set('approved-cookies', true);
            close(document.getElementById("cookies_msg"));
        };
    }
</script>
@yield('footer')
</body>
</html>
