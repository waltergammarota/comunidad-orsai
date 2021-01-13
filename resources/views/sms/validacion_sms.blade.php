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
    <section id="sms" class="resaltado_gris pd_20 pd_20_tp_bt">
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
                            <strong class="telefono"></strong>.</p>
                        <p>Por favor, agregá otro número</p>
                    </div>
                </div>

                <div class="alert alert-ok hide" id="yaValidado">
                    <div class="alert-content">
                        <span class="icon icon-check_circle"></span>
                        <p>Ya validamos tu perfil con el siguiente número de celular:<br/>
                            <strong class="telefono"></strong>.</p>
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
                                @if(($country->prefijoTel == $prefijo && $country->prefijoTel != "") || ($prefijo == 0 && $country->prefijoTel == 54))
                                    <option value="{{$country->prefijoTel}}" selected data-iso="{{$country->iso}}">
                                        (+{{$country->prefijoTel}}) {{utf8_encode($country->nombre)}}
                                    </option>
                                @else
                                    <option value="{{$country->prefijoTel}}" data-iso="{{$country->iso}}">
                                        (+{{$country->prefijoTel}}) {{utf8_encode($country->nombre)}}
                                    </option>
                                @endif
                            @endforeach
                        </select></p>
                    <p><label for=""><strong>Número de celular</strong> <small id="example_phone"></small></label>
                        <input class="textgrey" type="text" name="telefono"
                               id="phoneNumber" value=""><span id="feedback_phone"></span></p>

                    <div class="box_button">
                        <button type="submit" id="enviarTelefono" class="boton_redondeado boton-largo text_bold"
                                disabled>Agregar
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
            const feedback = $('#feedback_phone');
            const btn = $("#enviarTelefono");
            const numberUsed = $("#numeroEnUso");
            const genericError = $("#generic-error");
            const isValidatedError = $("#yaValidado");
            const errorPhoneNumber = $(".telefono");
            const example_phone = $("#example_phone");
            const phone_examples = {
                "AC": "40123",
                "AD": "312345",
                "AE": "501234567",
                "AF": "701234567",
                "AG": "2684641234",
                "AI": "2642351234",
                "AL": "672123456",
                "AM": "77123456",
                "AO": "923123456",
                "AR": "91123456789",
                "AS": "6847331234",
                "AT": "664123456",
                "AU": "412345678",
                "AW": "5601234",
                "AX": "412345678",
                "AZ": "401234567",
                "BA": "61123456",
                "BB": "2462501234",
                "BD": "1812345678",
                "BE": "470123456",
                "BF": "70123456",
                "BG": "48123456",
                "BH": "36001234",
                "BI": "79561234",
                "BJ": "90011234",
                "BL": "690001234",
                "BM": "4413701234",
                "BN": "7123456",
                "BO": "71234567",
                "BQ": "3181234",
                "BR": "11961234567",
                "BS": "2423591234",
                "BT": "17123456",
                "BW": "71123456",
                "BY": "294911911",
                "BZ": "6221234",
                "CA": "5062345678",
                "CC": "412345678",
                "CD": "991234567",
                "CF": "70012345",
                "CG": "061234567",
                "CH": "781234567",
                "CI": "01234567",
                "CK": "71234",
                "CL": "221234567",
                "CM": "671234567",
                "CN": "13123456789",
                "CO": "3211234567",
                "CR": "83123456",
                "CU": "51234567",
                "CV": "9911234",
                "CW": "95181234",
                "CX": "412345678",
                "CY": "96123456",
                "CZ": "601123456",
                "DE": "15123456789",
                "DJ": "77831001",
                "DK": "32123456",
                "DM": "7672251234",
                "DO": "8092345678",
                "DZ": "551234567",
                "EC": "991234567",
                "EE": "51234567",
                "EG": "1001234567",
                "EH": "650123456",
                "ER": "7123456",
                "ES": "612345678",
                "ET": "911234567",
                "FI": "412345678",
                "FJ": "7012345",
                "FK": "51234",
                "FM": "3501234",
                "FO": "211234",
                "FR": "612345678",
                "GA": "06031234",
                "GB": "7400123456",
                "GD": "4734031234",
                "GE": "555123456",
                "GF": "694201234",
                "GG": "7781123456",
                "GH": "231234567",
                "GI": "57123456",
                "GL": "221234",
                "GM": "3012345",
                "GN": "601123456",
                "GP": "690001234",
                "GQ": "222123456",
                "GR": "6912345678",
                "GT": "51234567",
                "GU": "6713001234",
                "GW": "955012345",
                "GY": "6091234",
                "HK": "51234567",
                "HN": "91234567",
                "HR": "921234567",
                "HT": "34101234",
                "HU": "201234567",
                "ID": "812345678",
                "IE": "850123456",
                "IL": "502345678",
                "IM": "7924123456",
                "IN": "8123456789",
                "IO": "3801234",
                "IQ": "7912345678",
                "IR": "9123456789",
                "IS": "6111234",
                "IT": "3123456789",
                "JE": "7797712345",
                "JM": "8762101234",
                "JO": "790123456",
                "JP": "9012345678",
                "KE": "712123456",
                "KG": "700123456",
                "KH": "91234567",
                "KI": "72001234",
                "KM": "3212345",
                "KN": "8697652917",
                "KP": "1921234567",
                "KR": "1020000000",
                "KW": "50012345",
                "KY": "3453231234",
                "KZ": "7710009998",
                "LA": "2023123456",
                "LB": "71123456",
                "LC": "7582845678",
                "LI": "660234567",
                "LK": "712345678",
                "LR": "770123456",
                "LS": "50123456",
                "LT": "61234567",
                "LU": "628123456",
                "LV": "21234567",
                "LY": "912345678",
                "MA": "650123456",
                "MC": "612345678",
                "MD": "62112345",
                "ME": "67622901",
                "MF": "690001234",
                "MG": "321234567",
                "MH": "2351234",
                "MK": "72345678",
                "ML": "65012345",
                "MM": "92123456",
                "MN": "88123456",
                "MO": "66123456",
                "MP": "6702345678",
                "MQ": "696201234",
                "MR": "22123456",
                "MS": "6644923456",
                "MT": "96961234",
                "MU": "52512345",
                "MV": "7712345",
                "MW": "991234567",
                "MX": "12221234567",
                "MY": "123456789",
                "MZ": "821234567",
                "NA": "811234567",
                "NC": "751234",
                "NE": "93123456",
                "NF": "381234",
                "NG": "8021234567",
                "NI": "81234567",
                "NL": "612345678",
                "NO": "40612345",
                "NP": "9841234567",
                "NR": "5551234",
                "NU": "8884012",
                "NZ": "211234567",
                "OM": "92123456",
                "PA": "61234567",
                "PE": "912345678",
                "PF": "87123456",
                "PG": "70123456",
                "PH": "9051234567",
                "PK": "3012345678",
                "PL": "512345678",
                "PM": "551234",
                "PR": "7872345678",
                "PS": "599123456",
                "PT": "912345678",
                "PW": "6201234",
                "PY": "961456789",
                "QA": "33123456",
                "RE": "692123456",
                "RO": "712034567",
                "RS": "601234567",
                "RU": "9123456789",
                "RW": "720123456",
                "SA": "512345678",
                "SB": "7421234",
                "SC": "2510123",
                "SD": "911231234",
                "SE": "701234567",
                "SG": "81234567",
                "SH": "51234",
                "SI": "31234567",
                "SJ": "41234567",
                "SK": "912123456",
                "SL": "25123456",
                "SM": "66661212",
                "SN": "701234567",
                "SO": "71123456",
                "SR": "7412345",
                "SS": "977123456",
                "ST": "9812345",
                "SV": "70123456",
                "SX": "7215205678",
                "SY": "944567890",
                "SZ": "76123456",
                "TA": "8999",
                "TC": "6492311234",
                "TD": "63012345",
                "TG": "90112345",
                "TH": "812345678",
                "TJ": "917123456",
                "TK": "7290",
                "TL": "77212345",
                "TM": "66123456",
                "TN": "20123456",
                "TO": "7715123",
                "TR": "5012345678",
                "TT": "8682911234",
                "TV": "901234",
                "TW": "912345678",
                "TZ": "621234567",
                "UA": "501234567",
                "UG": "712345678",
                "US": "2015550123",
                "UY": "94231234",
                "UZ": "912345678",
                "VA": "3123456789",
                "VC": "7844301234",
                "VE": "4121234567",
                "VG": "2843001234",
                "VI": "3406421234",
                "VN": "912345678",
                "VU": "5912345",
                "WF": "501234",
                "WS": "7212345",
                "XK": "43201234",
                "YE": "712345678",
                "YT": "639012345",
                "ZA": "711234567",
                "ZM": "955123456",
                "ZW": "712345678"
            };

            const phoneValidator = libphonenumber.parsePhoneNumber;
            const oldPhone = '+{{$prefijo}}{{$whatsapp}}';

            try {
                telefono.val(phoneValidator(oldPhone).formatNational());
                if (phoneValidator(oldPhone).isValid()) {
                    telefono.removeClass('nroInvalido');
                    telefono.addClass('nroValido');
                    btn.addClass('resaltado_amarillo');
                    btn.removeAttr('disabled');
                } else {
                    showInvalid();
                }
            } catch (error) {
                showInvalid('noPhone');
            }

            function validatePhone(prefix, value) {
                try {
                    const phoneNumber = phoneValidator(`+${prefix}${value}`);
                    if (phoneNumber.isValid()) {
                        telefono.val(phoneNumber.formatNational());
                        telefono.removeClass('nroInvalido');
                        telefono.addClass('nroValido');
                        feedback.html('');
                        example_phone.html('');
                        btn.addClass('resaltado_amarillo');
                        btn.removeAttr('disabled');
                    } else {
                        showInvalid();
                    }
                } catch (error) {
                    showInvalid();
                }
            }

            function showInvalid(options) {
                const country = $("#prefijo option:selected").data('iso');
                const examplePhone = libphonenumber.getExampleNumber(country.toUpperCase(), phone_examples);
                example_phone.html("Ejemplo: " + examplePhone.nationalNumber);
                telefono.removeClass('nroValido');
                if (options != "noPhone") {
                    telefono.addClass('nroInvalido');
                    feedback.html('El teléfono que ingresaste no es válido');
                }
                btn.removeClass('resaltado_amarillo');
                btn.attr('disabled', 'disabled');
            }

            prefijo.change(function () {
                const currentValue = telefono.val();
                const prefix = $(this).val();
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
                        if (error.response.data.status == "validated") {
                            isValidatedError.fadeIn('slow');
                            numberUsed.hide();
                        } else {
                            numberUsed.fadeIn('slow');
                            isValidatedError.hide();
                        }
                        genericError.hide();
                    });
                } else {
                    console.log("telefono incorrecto");
                }
            });
        })
        ;
    </script>

@endsection
