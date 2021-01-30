@extends('2021-orsai-template')

@section('title', 'Seguridad | Comunidad Orsai')
@section('description', 'Seguridad')

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
                        <li><a href="#" class="activo" rel="noopener noreferrer">Seguridad</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="contenedor pd_20_tp_bt ft_size form_rel">
            @include('2021-menu-informacion-personal',["activo" => "seguridad"])
            <div class="grilla_perfil">
                <div id="seguridad" class="fondo_blanco">
                    <div class="titulo">
                        <h1 class="text_regular">Seguridad</h1>
                    </div>
                    <div class="mg_20"></div>
                    <form action="#">
                        <div class=" border_bt_form">
                            <div class="grilla_form">
                                <div class="form_ctrl input_ col_2">
                                    <div class="input_err">
                                        <label class="text_medium">Prefijo país</label>
                                        <input type="text" name="prefijo" class="obligatorio"
                                               placeholder="1155555555"
                                               value="(+{{$prefijo_guardado['prefijoTel']}}) {{utf8_encode($prefijo_guardado['nombre'])}}"
                                               id="prefijo" disabled id="prefijo">
                                    </div>
                                </div>
                                <div class="form_ctrl input_ inp_y_btn col_4">
                                    <div class="input_err">
                                        <label class="text_medium">Número de celular</label>
                                        <input type="text" name="telefono" class="obligatorio" placeholder="1155555555"
                                               value="{{$whatsapp}}" id="whatsapp" disabled id="phoneNumber">
                                        <a href="{{url('editar-telefono')}}" class="edit_link link_subrayado_regular">Editar</a>
                                        <span class="icono_aviso icon-check_circle"></span>
                                        <span class="icono_aviso icon-exclamacion_circle"></span>
                                    </div>
                                    <div class="button_lf_side">
                                        @if(!$phone_verified_at && $prefijo != 0)
                                            <button id="val_tel" class="boton_redondeado text_bold">
                                                Validar teléfono
                                            </button>
                                        @else
                                            <button id="val_tel" class="boton_redondeado text_bold" disabled>
                                                Validar teléfono
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grilla_form">
                            <div class="form_ctrl input_ col_3">
                                <div class="input_err">
                                    <label class="text_medium">Contraseña actual</label>
                                    <input type="password" name="current_password" class="obligatorio"
                                           placeholder="********" id="current_password">
                                    <span class="form_min_text color_rojo hidden" id="current_password_legend">Mínimo 8 caracteres</span>
                                </div>
                            </div>
                        </div>
                        <div class="grilla_form">
                            <div class="form_ctrl input_ col_3">
                                <div class="input_err">
                                    <label class="text_medium">Nueva contraseña</label>
                                    <input type="password" name="new_password" class="obligatorio"
                                           placeholder="********" id="new_password">
                                    <span class="form_min_text color_gris hidden"
                                          id="new_password_legend">Mínimo 8 caracteres</span>
                                </div>
                            </div>
                            G
                            <div class="form_ctrl input_ col_3">
                                <div class="input_err">
                                    <label class="text_medium">Repita nueva contraseña</label>
                                    <input type="password" name="confirmation_password" class="obligatorio"
                                           placeholder="********" id="confirmation_password">
                                    <span class="form_min_text color_gris" id="confirmation_password_legend">Mínimo 8 caracteres</span>
                                </div>
                            </div>
                        </div>
                        <div class="form_ctrl input_">
                            <div class="align_right">
                                <button type="submit"
                                        class="boton_redondeado resaltado_amarillo text_bold pd_50_lf_rg"
                                        onclick="changePassword()">Guardar
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

        /* Menu logueado */
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


        /*Editar campo deshabilitado*/
        // $(".edit_link").click(function (e) {
        //     $(this).siblings('input').attr('disabled', false);
        // });


        /* ANIMACION BOTON VALIDAR TELEFONO MI PERFIL */
        $('#val_tel').click(function () {
            //   $('#val_tel').hide();
            event.preventDefault();
            const color_btn = $('#val_tel').css("color");
            $(this).siblings('.input_err').find('input').attr('disabled', true);
            const btn_ = $('#val_tel');

            $(btn_).css("color", "transparent");
            $(btn_).addClass('btn_loader');
            window.location = '{{url("validacion-usuario")}}';
            setTimeout(function () {
                $(btn_).removeClass('btn_loader');
                $(btn_).css("color", color_btn);
                // $('#val_tel').show();
            }, 2000);
            setTimeout(function () {
                $(btn_).parent('.button_lf_side').siblings('.input_err').find('.icono_aviso.icon-exclamacion_circle').fadeIn();
            }, 2000);

            setTimeout(function () {
                $(btn_).parent('.button_lf_side').siblings('.input_err').find('.icono_aviso.icon-exclamacion_circle').fadeOut();
            }, 3000);
        });


        const telefono = $('#whatsapp');
        const phoneValidator = libphonenumber.parsePhoneNumber;
        const oldPhone = '+{{$prefijo}}{{$whatsapp}}';
        console.log(oldPhone);
        const isPhoneValidated = {{$phone_verified_at? 1: 0}};

        $(document).ready(function () {
            try {
                const formattedPhone = phoneValidator(oldPhone);
                telefono.val(`${formattedPhone.formatNational()}`);
                if (isPhoneValidated == 1) {
                    $(".icon-check_circle").show();
                } else {
                    $("#val_tel").addClass('resaltado_amarillo');
                }

            } catch (error) {
                telefono.val("");
                $(".icon-exclamacion_circle").show();
            }

        });

        const current_password = $("#current_password");
        const new_password = $("#new_password");
        const confirmation_password = $("#confirmation_password");
        const current_password_legend = $("#current_password_legend");
        const new_password_legend = $("#new_password_legend");
        const confirmation_password_legend = $("#confirmation_password_legend");
        current_password_legend.hide();
        new_password_legend.hide();
        confirmation_password_legend.hide();

        function changePassword() {
            event.preventDefault();
            const url = `{{url('change-password')}}`;
            const result = [];
            if (current_password.val() != "" && current_password.val().length >= 8) {
                result.push(true);
                current_password_legend.hide();
            } else {
                result.push(false);
                current_password_legend.show();
            }

            if (new_password.val() == confirmation_password.val() && new_password.val().length >= 8) {
                result.push(true);
                new_password_legend.hide();
                confirmation_password_legend.hide();
            } else {
                result.push(false);
                new_password_legend.show();
                confirmation_password_legend.show();
            }
            if (result.every(item => item)) {
                const exito = $("#exito_msg");
                exito.show();
                axios.post(url, {
                    current_password: current_password.val(),
                    new_password: new_password.val(),
                    confirmation_password: confirmation_password.val()
                }).then(data => {
                    setTimeout(close(exito), 600);
                }).catch(error => {
                    console.log(error);
                    setTimeout(close(exito), 600);
                });
            }
        }
    </script>
@endsection
