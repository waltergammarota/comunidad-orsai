@extends('2021-orsai-template')

@section('title', 'Validación de perfil | Comunidad Orsai')
@section('description', 'Validación de perfil')
@section('header')
    <link rel="stylesheet" href="{{url('estilos/front2021/informacion_personal.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/libphonenumber-js@1.9.6/bundle/libphonenumber-min.js"></script>
@endsection
@section('content')
    <style>
        .nroInvalido {
            border: 1px solid red;
            color: red;
        }

        .nroValido {
            border: 1px solid green;
            color: green;
        }
    </style>
    <section class="resaltado_gris pd_20 pd_20_tp_bt">
        <article class="contenedor_interna blog_articulo_completo">
            <div class="cuerpo_interna">
                <div class="box_heading">
                    <h1 class="titulo_blog text_bold">AGREGÁ TU NÚMERO DE CELULAR</h1>
                    <p class="subtitulo">Necesitamos esta información para resguardar tu perfil.</p>
                    <p class="subtitulogris">Es posible que se apliquen tarifas de mensajes y datos.</p>
                </div>
                <hr/>
                <div class="alert alert-error hide" id="numeroEnUso">
                    <div class="alert-content">
                        <span class="icon icon-exclamacion_circle"></span>
                        <p>Este número ya está en uso.</p>
                        <p>Hay otro perfil que asoció el número de teléfono:<br/>
                            <strong id="telefono"></strong>.</p>
                        <p>Por favor, agregá otro número</p>
                    </div>
                </div>

                <div class="alert alert-error hide" id="generic-error">
                    <div class="alert-content">
                        <span class="icon icon-exclamacion_circle"></span>
                        <strong>No pudimos validar tu teléfono.</strong><br/>
                        <p>Ha ocurrido un error. Inténtalo más tarde</p>
                    </div>
                </div>

                <form action="{{url('agregar-telefono')}}" class="validation_sms" method="POST">
                    @csrf
                    <p><label for=""><strong>Prefijo país</strong></label>
                        <select name="prefijo" id="prefijo" class="selectgrey">
                            @foreach($countries as $country)
                                @if($country->prefijoTel == $prefijo)
                                    <option value="{{$country->prefijoTel}}" selected>
                                        (+{{$country->prefijoTel}}) {{utf8_encode($country->nombre)}}
                                    </option>
                                @else
                                    <option value="{{$country->prefijoTel}}">
                                        (+{{$country->prefijoTel}}) {{utf8_encode($country->nombre)}}
                                    </option>
                                @endif
                            @endforeach
                        </select></p>
                    <p><label for=""><strong>Número de celular</strong></label>
                        <input placeholder="(Ej. 115XXXXXXX)" class="textgrey" type="text" name="telefono"
                               id="phoneNumber" value=""></p>
                    <div class="box_button">
                        <button type="submit" id="enviarTelefono"
                                class="boton_redondeado boton-largo resaltado_amarillo text_bold">Agregar
                        </button>
                    </div>
                </form>
                <div class="bottom_exit">
                    <a href="{{url('panel')}}">Ahora no</a>
                </div>
            </div>
        </article>
    </section>
@endsection


@section('footer')
    <script>
        $(document).ready(function () {
            const prefijo = $('#prefijo');
            const telefono = $('#phoneNumber');
            const btn = $("#enviarTelefono");
            const numberUsed = $("#numeroEnUso");
            const genericError = $("#generic-error");
            const errorPhoneNumber = $("#telefono");

            const phoneValidator = libphonenumber.parsePhoneNumber;
            const oldPhone = '+{{$prefijo}}{{$whatsapp}}';

            telefono.val(phoneValidator(oldPhone).formatNational());

            function validatePhone(prefix, value) {
                const phoneNumber = phoneValidator(`+${prefix}${value}`);
                if (phoneNumber.isValid()) {
                    telefono.val(phoneNumber.formatNational());
                    telefono.removeClass('nroInvalido');
                    telefono.addClass('nroValido');
                } else {
                    telefono.addClass('nroInvalido');
                    telefono.removeClass('nroValido');
                }
            }

            prefijo.change(function () {
                const currentValue = $(this).val();
                const prefix = prefijo.val();
                validatePhone(prefix, currentValue);
            });

            telefono.keyup(function () {
                const currentValue = $(this).val();
                const prefix = prefijo.val();
                validatePhone(prefix, currentValue);
            });

            btn.click(function (event) {
                event.preventDefault();
                const phoneNumber = telefono.val();
                const prefix = prefijo.val();
                const completePhone = `+${prefix} ${phoneNumber}`;
                const rawPhone = phoneValidator(completePhone);
                const phoneLength = 10;
                if (prefix > 0 && completePhone.length >= phoneLength) {
                    const url = '{{url('verificar-no-usado')}}';
                    axios.post(url, {
                        prefijo: prefix,
                        telefono: rawPhone.nationalNumber
                    }).then(function (response) {
                        const urlSendCode = '{{url('agregar-telefono')}}';
                        axios.post(urlSendCode, {
                            prefijo: prefix,
                            telefono: rawPhone.nationalNumber
                        }).then(function (response) {
                            window.location = '{{url('validacion-codigo')}}';
                        }).catch(function (error) {
                            genericError.fadeIn('slow');
                            numberUsed.hide();
                        });
                    }).catch(function (error) {
                        errorPhoneNumber.empty();
                        errorPhoneNumber.append(`(+${prefix}) ${phoneNumber}`);
                        numberUsed.fadeIn('slow');
                        genericError.hide();
                    });
                } else {
                    console.log("telefono incorrecto");
                }
            });

        });
    </script>

@endsection
