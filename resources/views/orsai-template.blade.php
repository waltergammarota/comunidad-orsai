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
    @if (Route::currentRouteName() == 'registrarse' || Route::currentRouteName() == 'ingresar' || Route::currentRouteName() == 'home')
        <script src="https://www.google.com/recaptcha/api.js" async
                defer></script>
    @endif
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">

    @hasSection('facebook')
        @yield('facebook')
    @else
    <!-- Facebook -->
        <meta property="og:site_name" content="Comunidad Orsai"/>
        <meta property="og:url" content="{{url()->full()}}"/>
        <meta property="og:type" content="article"/>
        <meta property="og:title" content="@yield('title')"/>
        <meta property="og:description" content="@yield('description')"/>
        <meta property="og:image:alt" content="Comunidad Orsai"/>
        <meta property="og:image" content="{{url('recursos/comunidad-orsai-share.jpg')}}"/>
    <!--   <meta property="og:app_id" content="{{url('recursos/comunidad-orsai-share.jpg')}}"/> -->
    @endif

    @if(env('ORSAI_ENV') == 'production')
    <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-176303994-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'UA-176303994-1');
        </script>
    @endif


    @hasSection('twitter')
        @yield('twitter')
    @else
    <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image"/>
        <meta name="twitter:site" content="{{env('TWITTER_SITE', '@comunidadorsai')}}"/>
        <meta name="twitter:creator" content="{{env('TWITTER_CREATOR', '@comunidadorsai')}}"/>
        <meta property="twitter:title" content="@yield('title')"/>
        <meta property="twitter:description" content="@yield('description')"/>
        <meta name="twitter:image" content="{{url('recursos/comunidad-orsai-share.jpg')}}"/>
    @endif
    @yield('header')

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{url('recursos/favicon-apple.png')}}">
    <link rel="shortcut icon" href="{{url('recursos/favicon.ico')}}">
    @yield('coral')
</head>
<body class="page">

<div class="fondo_blanco">
    <header class="contenedor">
        @include('header_footer')
    </header>

    @yield('content')
</div>


<!-- footer -->
<footer>
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
                    <li><a href="{{url('terminos-y-condiciones')}}">Términos &amp; Condiciones</a></li>
                    <li><a href="{{url('politica-de-privacidad')}}">Política de privacidad</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>


<div id="cookies_msg" class="popup" style="display: none;">
    <div>
        <div class="contenedor">
            <p>Utilizamos <strong>cookies</strong> para personalizar el contenido, adaptar y evaluar los anuncios y
                ofrecer una
                experiencia más segura. Al navegar por el sitio web, aceptás el uso de cookies para recopilar
                información dentro y fuera de
                Orsai. Leé nuestra <a href="{{url('politica-de-cookies')}}" target="_blank"
                                      class="subrayado text_bold">Política
                    de cookies</a> para obtener más información o accedé a las Preferencias de cookies para
                administrar tu configuración</p>
            <a id="btn_cookies" class="subrayado resaltado_amarillo text_bold">Aceptar</a>
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
        updateNotifications();
    });

    if (document.getElementById("cookies_msg")) {
        var get_aceptar_cookies = document.getElementById("btn_cookies");
        get_aceptar_cookies.onclick = function () {
            Cookies.set('approved-cookies', true);
            close(document.getElementById("cookies_msg"));
        };
    }

    function updateNotifications() {
        const bell = $('.notification-amount');
        axios.get('{{url('notificaciones/counter')}}')
            .then(response => {
                const amount = response.data.amount;
                bell.empty();
                bell.append(`<span>${amount}</span>`);
                if (amount > 0) {
                    bell.css('visibility', 'visible');
                }
            }).catch(error => {
            console.log(error);
        });
    }

</script>
@yield('footer')
</body>
</html>
