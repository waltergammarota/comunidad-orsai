@extends('2021-orsai-template')

@section('title', 'Redes sociales | Comunidad Orsai')
@section('description', 'Redes sociales')

@section('header')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url("admin/plugins/fontawesome-free/css/all.min.css")}}">
    <script src="https://cdn.jsdelivr.net/npm/libphonenumber-js@1.9.6/bundle/libphonenumber-min.js"></script>
@endsection

@section('content')

    <section class="resaltado_gris pd_20 pd_20_tp_bt pd_20_prueba">
        <div class="contenedor ft_size form_rel">
            <div class="grilla_perfil">
                <div class="miga_pan">
                    <ul>
                        <li><a href="{{url('panel')}}" rel="noopener noreferrer">Panel de usuario <span
                                    class="icon-right-open"></span></a></li>
                        <li><a href="{{url('perfil')}}" rel="noopener noreferrer">Información personal <span
                                    class="icon-right-open"></span></a></li>
                        <li><a href="#" class="activo" rel="noopener noreferrer">Redes Sociales</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="contenedor pd_20_tp_bt ft_size form_rel">
            @include('2021-menu-informacion-personal',["activo" => "redes-sociales"])
            <div class="grilla_perfil">
                <div id="redes_sociales" class="fondo_blanco">
                    <div class="titulo">
                        <h1 class="text_regular">Redes sociales</h1>
                    </div>
                    <div class="mg_20"></div>
                    <form action="#">
                        <div class="grilla_form">
                            <div class="form_ctrl input_ inp_y_btn col_3">
                                <div class="input_err">
                                    <label class="text_medium">Facebook</label>
                                    <input type="text" name="facebook" class="obligatorio" id="facebook"
                                           placeholder="Nombre de Usuario" value="{{$facebook}}" disabled>
                                    <span class="icono_aviso icon-check_circle"></span>
                                    <span class="icono_aviso icon-exclamacion_circle"></span>
                                </div>
                                <div class="button_lf_side">
                                    @if(!$facebook)
                                        <button class="conectar boton_redondeado btn_transparente text_bold"
                                                data-network="facebook">Conectar
                                        </button>
                                    @else
                                        <button class="conectar boton_redondeado text_bold"
                                                data-network="facebook">Desconectar
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="form_ctrl input_ inp_y_btn col_3">   {{-- inp_y_btn  --}}
                                <div class="input_err">
                                    <label class="text_medium">Twitter</label>
                                    <input type="text" name="twitter" class="obligatorio" placeholder="@nombredeusuario"
                                           id="twitter" value="{{$twitter}}" disabled>
                                    <span class="icono_aviso icon-check_circle"></span>
                                    <span class="icono_aviso icon-exclamacion_circle"></span>
                                </div>
                                @if(!$twitter)
                                    <button class="conectar boton_redondeado btn_transparente text_bold"
                                            data-network="twitter">Conectar
                                    </button>
                                @else
                                    <button class="conectar boton_redondeado text_bold"
                                            data-network="twitter">Desconectar
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="grilla_form">
                            <div class="form_ctrl input_ col_3">
                                <div class="input_err">
                                    <label class="text_medium">Instagram</label>
                                    <input type="text" name="instagram" class="obligatorio" placeholder="@instagram"
                                           id="instagram" value="{{$instagram}}"/>
                                </div>
                                {{--                                @if(!$instagram)--}}
                                {{--                                    <button class="conectar boton_redondeado btn_transparente text_bold"--}}
                                {{--                                            data-network="instagram">Conectar--}}
                                {{--                                    </button>--}}
                                {{--                                @else--}}
                                {{--                                    <button class="conectar boton_redondeado text_bold"--}}
                                {{--                                            data-network="instagram">Desconectar--}}
                                {{--                                    </button>--}}
                                {{--                                @endif--}}
                            </div>
                            <div class="form_ctrl input_ col_3">
                                <div class="input_err">
                                    <label class="text_medium">Linkedin</label>
                                    <input type="text" name="linkedin" class="obligatorio" placeholder="URL"
                                           id="linkedin" value="{{$linkedin}}"/>
                                </div>
                            </div>

                        </div>
                        <div class="grilla_form">
                            <div class="form_ctrl input_ col_3">
                                <div class="input_err">
                                    <label class="text_medium">Portfolio (Behance)</label>
                                    <input type="text" name="portfolio" class="obligatorio" placeholder="URL"
                                           id="portfolio" value="{{$portfolio}}">
                                </div>
                            </div>
                            <div class="form_ctrl input_ col_3">
                                <div class="input_err">
                                    <label class="text_medium">Sitio personal</label>
                                    <input type="text" name="web" class="obligatorio" placeholder="URL" id="web"
                                           value="web">
                                </div>
                            </div>
                        </div>
                        <div class="grilla_form">
                            <div class="form_ctrl input_ col_3">
                                <div class="input_err">
                                    <label class="text_medium">Medium</label>
                                    <input type="text" name="medium" class="obligatorio" placeholder="URL" id="medium"
                                           value="{{$medium}}">
                                </div>
                            </div>
                            <div class="form_ctrl input_ col_3">
                                <div class="input_err">
                                    <label class="text_medium">Otra (Pinterest, Tik Tok, etc)</label>
                                    <input type="text" name="redes" class="obligatorio" placeholder="URL" id="redes"
                                           value="{{$redes}}">
                                </div>
                            </div>
                        </div>
                        <div class="form_ctrl input_">
                            <div class="align_right">
                                <button type="submit"
                                        class="boton_redondeado resaltado_amarillo text_bold pd_50_lf_rg"
                                        onclick="save()">Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
    <div id="exito_msg" class="popup">
        <div>
            <div id="texto_exito">
                <span>Guardando</span>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        window.fbAsyncInit = function () {
            FB.init({
                appId: '{{env('FACEBOOK_APP_ID')}}',
                autoLogAppEvents: true,
                xfbml: true,
                version: 'v10.0'
            });
        };
    </script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
    <script>
        const facebook = $("#facebook");
        const twitter = $("#twitter");
        const instagram = $("#instagram");
        const linkedin = $("#linkedin");
        const portfolio = $("#portfolio");
        const web = $("#web");
        const medium = $("#medium");
        const redes = $("#redes");


        function save() {
            event.preventDefault();
            const url = '{{url('/profile/update/redes')}}';
            const exito = $("#exito_msg");
            exito.show();
            axios.post(url, {
                facebook: facebook.val(),
                twitter: twitter.val(),
                instagram: instagram.val(),
                linkedin: linkedin.val(),
                portfolio: portfolio.val(),
                web: web.val(),
                medium: medium.val(),
                redes: redes.val()
            }).then(data => {
                setTimeout(close(exito), 600);
            });
        }

        /* Menu logueado */
        if
        ($(window).width() < 1040) {
            $("#insertar_perfil").prepend($("#clonar_perfil"));
        }
        $(window).resize(function () {
            if ($(window).width() < 1040) {
                $("#insertar_perfil").prepend($("#clonar_perfil"));
            } else {
                $("#clonar_perfil").appendTo(".logueado");
            }
        });

        function loader(btn_, color_btn) {
            $(btn_).css("color", "transparent");
            $(btn_).addClass('btn_loader');
            $(btn_).removeClass('btn_loader');
            $(btn_).css("color", color_btn);
        }

        function toggle(success, btn_) {
            if (success) {
                if ($(btn_).hasClass('btn_transparente')) {
                    $(btn_).html('Desconectar');
                    $(btn_).removeClass('btn_transparente');
                }
                $(btn_).parent('.button_lf_side').siblings('.input_err').find('.icono_aviso.icon-check_circle').fadeIn();

                setTimeout(function () {
                    $(btn_).parent('.button_lf_side').siblings('.input_err').find('.icono_aviso.icon-check_circle').fadeOut();
                }, 3000);
            } else {
                $(btn_).html('Conectar');
                $(btn_).addClass('btn_transparente');
                $(btn_).parent('.button_lf_side').siblings('.input_err').find('.icono_aviso.icon-exclamacion_circle').fadeIn();
                setTimeout(function () {
                    $(btn_).parent('.button_lf_side').siblings('.input_err').find('.icono_aviso.icon-exclamacion_circle').fadeOut();
                }, 3000);
            }
        }

        function callFacebookApi(btn_, input) {
            FB.api('/me', function (response) {
                input.val(response.name);
                const url = '{{url("save-facebook")}}';
                axios.post(url, {
                    facebook_id: response.id,
                    facebook_user: response.name
                }).then(function (response) {
                    toggle(true, btn_);
                }).catch(function (error) {
                    toggle(false, btn_);
                    input.val("");
                });
            });
        }

        function connectFacebook(btn_, input) {
            FB.getLoginStatus(function (response) {
                if (response.authResponse) {
                    callFacebookApi(btn_, input);
                } else {
                    FB.login(function (response) {
                        console.log(response);
                        if (response.authResponse) {
                            callFacebookApi(btn_, input);
                            console.log('Welcome!  Fetching your information.... ');
                        } else {
                            toggle(false, btn_);
                            input.val("");
                            console.log('User cancelled login or did not fully authorize.');
                        }
                    }, {scope: 'instagram_basic'});
                }
            });
        }


        function connectInstagram() {
            console.log("instagram");
            const url = "https://graph.instagram.com/me?fields=id,username&access_token=";
            FB.getLoginStatus(function (response) {
                if (response.authResponse) {
                    axios.get(`${url}${response.authResponse.accessToken}`).then(function (data) {
                        console.log(data);
                    }).catch(function (error) {
                        console.log(error);
                    })
                }
            });
        }

        function connectTwitter() {
            console.log("twitter");
            const url = '{{url("twitter-login")}}';
            axios.post(url).then(function (response) {
                window.location = response.data.url;
            }).catch(function (error) {
                console.log(error);
            });
        }


        function disconnectInstagram(btn_, input) {
            $(btn_).html('Conectar');
            $(btn_).addClass('btn_transparente');
            input.val("");
            const url = '{{url("save-instagram")}}';
            axios.post(url, {
                facebook_id: null,
                facebook_user: null,
            }).catch(function (error) {
                console.log(error);
            });
        }

        function disconnectTwitter(btn_, input) {
            $(btn_).html('Conectar');
            $(btn_).addClass('btn_transparente');
            input.val("");
            const url = '{{url("save-twitter")}}';
            axios.post(url, {
                twiter_id: null,
                twitter_user: null,
            }).catch(function (error) {
                console.log(error);
            });
        }

        function disconnectFacebook(btn_, input) {
            $(btn_).html('Conectar');
            $(btn_).addClass('btn_transparente');
            input.val("");
            const url = '{{url("save-facebook")}}';
            axios.post(url, {
                facebook_id: null,
                facebook_user: null,
            }).catch(function (error) {
                console.log(error);
            });
        }


        /* ANIMACION BOTON REDES SOCIALES MI PERFIL */
        $('.conectar').click(function (event) {
            event.preventDefault();
            const btn_ = $(this);
            const color_btn = $(this).css("color");
            const input = $(this).parent().siblings('.input_err').find('input');
            input.attr('disabled', true);
            const network = btn_.data('network');
            // CASE CONECTAR HORRIBLE
            if ($(btn_).hasClass('btn_transparente')) {
                switch (network) {
                    case "facebook":
                        connectFacebook(btn_, input);
                        break;
                    case "instagram":
                        connectInstagram(btn_, input);
                        break;
                    case "twitter":
                        connectTwitter(btn_, input);
                        break;
                }
            } else {
                switch (network) {
                    case "facebook":
                        disconnectFacebook(btn_, input);
                        break;
                    case "instagram":
                        disconnectInstagram(btn_, input);
                        break;
                    case "twitter":
                        disconnectTwitter(btn_, input);
                        break;
                }
            }
        });


    </script>
@endsection
