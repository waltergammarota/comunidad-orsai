<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{url('estilos/front2021/style.css')}}">
    <link rel="stylesheet" href="{{url('estilos/front2021/animate.css')}}">
    <link rel="stylesheet" href="{{url('estilos/front2021/linea-de-tiempo.css')}}">
    <link rel="stylesheet" href="{{url('estilos/front2021/fontello/fontello.css')}}">
    <link rel="stylesheet" href="{{url('estilos/jquery.tagsinput.min.css')}}">
    <link rel="stylesheet" href="{{url('owlcarousel/owl.carousel.min.css')}}">
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
        <meta property="og:image" content="{{url('recursos/comunidad-orsai-share-new.jpg')}}"/>
    <!--   <meta property="og:app_id" content="{{url('recursos/comunidad-orsai-share-new.jpg')}}"/> -->
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
        <meta name="twitter:image" content="{{url('recursos/comunidad-orsai-share-new.jpg')}}"/>
    @endif
    @yield('header')

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{url('recursos/favicon-apple-new.png')}}">
    <link rel="shortcut icon" href="{{url('recursos/favicon-new.ico')}}">
    @yield('coral')
</head>
<body class="page">
@include('2021-header')

@yield('content')

@include('2021-footer')


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
            <a id="btn_cookies" class="boton_redondeado resaltado_amarillo"><span>Aceptar</span></a>
        </div>
    </div>
</div>
<div class="icono_up">
    <span class="icon-angle-up"></span>
</div>
<script src="{{url('js/jquery.js')}}"></script>
<script src="{{url('js/front2021/owl.carousel2/dist/owl.carousel.min.js')}}"></script>
<script src="{{url('js/front2021/segment.js')}}"></script>
<script src="{{url('js/front2021/ease.min.js')}}"></script>
<script src="{{url('js/front2021/main.js')}}"></script>
<script src="{{url('js/front2021/carousel.js')}}"></script>
<script src="{{url('js/jquery.tagsinput.min.js')}}"></script>


<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if ($(window).width() < 1040) {
        $(".submenu").parent("li").click(function () {
            $(this).find('.submenu').toggleClass('abierto');
        })
    }
    if ($(window).width() < 1040) {
        $("#insertar_perfil").prepend($("#clonar_perfil"));
    }
    $(window).resize(function () {
        if ($(window).width() < 1040) {
            $("#insertar_perfil").prepend($("#clonar_perfil"));
        } else {
            $("#clonar_perfil").appendTo(".logueado");
        }
    });
    $('.icono_up').click(function () {
        $("html, body").animate({scrollTop: 0}, 1000);
        return false;
    });
    $(window).scroll(function () {
        if ($(window).scrollTop() >= 300) {
            $(".icono_up").fadeIn();
        } else {
            $(".icono_up").fadeOut();
        }
        if ($(window).width() > 991) {
            if ($(this).scrollTop() > 140) {
                $('.menu_lateral_izq ul').addClass('fixed');
            } else {
                $('.menu_lateral_izq ul').removeClass('fixed');
            }
        }

    });
    $(document).ready(() => {
        if (Cookies.get('approved-cookies') != "true") {
            $("#cookies_msg").show();
        }
        @if(Auth::check())
        updateNotifications();
        @endif
    });

    if (document.getElementById("cookies_msg")) {
        var get_aceptar_cookies = document.getElementById("btn_cookies");
        get_aceptar_cookies.onclick = function () {
            Cookies.set('approved-cookies', true, {expires: 365});
            close(document.getElementById("cookies_msg"));
        };
    }

    function updateNotifications() {
        const bell = $('.campanita');
        const options = {
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        };
        axios.get('{{url('notificaciones/counter')}}', {}, options)
            .then(response => {
                const amount = response.data.amount;
                bell.empty();
                bell.append(`<span class="cant_avisos">${amount}</span>`);
                if (amount > 0) {
                    bell.css('visibility', 'visible');
                }
            }).catch(error => {
            console.log(error);
        });
    }


    function alertLogout() {
        console.log("logout");
        localStorage.setItem('force-reload', new Date().getTime());
    }

    window.addEventListener('storage', function (event) {
        if (event.key == 'force-reload') {
            console.log("reloading");
            setTimeout(function () {
                location.reload();
            }, 3000);
        }
    });

</script>
@yield('footer')
</body>
</html>
