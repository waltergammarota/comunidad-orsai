@extends('2021-orsai-template')

@section('title', 'Validación de perfil | Comunidad Orsai')
@section('description', 'Validación de perfil')
@section('header')
    <link rel="stylesheet" href="{{url('estilos/front2021/informacion_personal.css')}}">
@endsection
@section('content')
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
                                <option value="{{$country->prefijoTel}}">
                                    (+{{$country->prefijoTel}}) {{utf8_encode($country->nombre)}}
                                </option>
                            @endforeach
                        </select></p>
                    <p><label for=""><strong>Número de celular</strong></label>
                        <input placeholder="(Ej. 115XXXXXXX)" class="textgrey" type="number" name="telefono"
                               id="phoneNumber"></p>
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

            btn.click(function (event) {
                event.preventDefault();
                const phoneNumber = telefono.val();
                const prefix = prefijo.val();
                const completePhone = prefix + phoneNumber;
                const phoneLength = 10;
                if (prefix > 0 && completePhone.length >= phoneLength) {
                    const url = '{{url('verificar-no-usado')}}';
                    axios.post(url, {
                        prefijo: prefix,
                        telefono: phoneNumber
                    }).then(function (response) {
                        const urlSendCode = '{{url('agregar-telefono')}}';
                        axios.post(urlSendCode, {
                            prefijo: prefix,
                            telefono: phoneNumber
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
