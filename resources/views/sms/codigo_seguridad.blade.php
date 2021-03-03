@extends('2021-orsai-template')

@section('title', 'Validación de perfil | Comunidad Orsai')
@section('description', 'Validación de perfil')
@section('header')
    <link rel="stylesheet" href="{{url('estilos/front2021/informacion_personal.css')}}">
@endsection

@section('content')
    <style>
        #sms .contenedor_interna {
            max-width: 615px !important;
        }
    </style>
    <section id="sms" class="resaltado_gris pd_20 pd_20_tp_bt">
        <article class="contenedor_interna blog_articulo_completo">
            <div class="cuerpo_interna">
                <div class="box_heading">
                    <h1 class="titulo_blog text_bold">INGRESÁ TU CÓDIGO DE SEGURIDAD</h1>
                    <p class="normal">Ya te enviamos un código por mensaje de texto al<br/>
                        <strong id="telefono">+{{$prefijo}} {{$whatsapp}}</strong>.</p>
                    <p class="subtitulogris">El SMS puede tardar unos minutos.</p>
                </div>
                <hr/>
                <div class="alert alert-error hide" id="generic-error">
                    <div class="alert-content">
                        <span class="icon icon-exclamacion_circle"></span>
                        <strong>No pudimos validar tu teléfono.</strong><br/>
                        <p>Ha ocurrido un error. Inténtalo más tarde</p>
                    </div>
                </div>
                <div class="alert alert-error hide" id="invalid-code">
                    <div class="alert-content">
                        <span class="icon icon-exclamacion_circle"></span>
                        <strong>No pudimos validar tu perfil.</strong><br/>
                        <p>El código es inválido. Inténtalo de nuevo.</p>
                    </div>
                </div>
                <div class="alert alert-ok hide" id="new-code">
                    <div class="alert-content">
                        <span class="icon icon-check_circle"></span>
                        <strong>Nuevo código enviado.</strong><br/>
                        <p>Te enviamos un nuevo código por mensaje de texto.</p>
                    </div>
                </div>
                <div class="alert alert-ok hide" id="valid-phone">
                    <div class="alert-content">
                        <span class="icon icon-check_circle"></span>
                        <p>Ya validamos tu perfil con el siguiente número de celular.<br/>
                            <strong>+{{$prefijo}} {{$whatsapp}}</strong>
                    </div>
                </div>
                <div class="">
                    <p class="text_bold">Código de seguridad:</p>
                </div>
                <form action="{{url('verificar-codigo')}}" method="POST">
                    <input placeholder="X" class="codigoinputtext" type="text" maxlength="1"/>
                    <input placeholder="X" class="codigoinputtext" type="text" maxlength="1"/>
                    <input placeholder="X" class="codigoinputtext" type="text" maxlength="1"/>
                    <input placeholder="X" class="codigoinputtext" type="text" maxlength="1"/>
                </form>
                <div class="bottom_exit">
                    <strong>¿No recibiste el código?</strong>
                    <a href="#" onclick="return resendCode()">Enviar de nuevo</a>
                </div>
            </div>
        </article>
    </section>
@endsection


@section('footer')
    <script>

        const validPopup = $('#valid-phone');
        const invalidCode = $("#invalid-code");
        const newCode = $("#new-code");
        const genericError = $("#generic-error");

        $(document).ready(function () {
            $(".codigoinputtext").keyup(function () {
                validateCode();
                const value = parseInt($(this).val());
                if (value >= 0) {
                    $(this).next().focus();
                }
            });
        });
        const inputs = $('.codigoinputtext');

        function validateCode() {
            const values = inputs.map(function (index, item) {
                const input = $(item);
                const number = parseInt(input.val());
                if (number >= 0) {
                    return input.val();
                }
                input.val("");
            });
            if (values.length == 4) {
                sendCode(values.toArray());
            }

        }

        function sendCode(values) {
            const code = values.join('');
            const url = '{{url('verificar-telefono')}}'
            axios.post(url, {
                code: code
            }).then(function (data) {
                validPopup.fadeIn('slow');
                newCode.hide();
                invalidCode.hide();
                genericError.hide();
                setTimeout(function () {
                    window.location = '{{url('panel')}}'
                }, 3000);
            }).catch(function (error) {
                invalidCode.fadeIn('slow');
                cleanInputs();
                newCode.hide();
                validPopup.hide();
                genericError.hide();
                setTimeout(function () {
                    invalidCode.fadeOut('slow');
                }, 2000);
            });
        }

        function cleanInputs() {
            inputs.each(function (index, item) {
                $(item).val("");
            });
        }

        function resendCode() {
            cleanInputs();
            const url = '{{url('reenviar-codigo')}}';
            axios.post(url, {}).then(function (data) {
                newCode.fadeIn('slow');
                validPopup.hide();
                invalidCode.hide();
                genericError.hide();
            }).catch(function (error) {
                genericError.fadeIn('slow');
                validPopup.hide();
                invalidCode.hide();
                newCode.hide();
            });
            return false;
        }
    </script>

@endsection
