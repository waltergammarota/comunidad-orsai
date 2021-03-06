@extends('orsai-template')

@section('title', 'Perfil | Fundación Orsai')
@section('description', 'Perfil')

@section('content')
    <section id="intro" class="contenedor intro_gral panel info_personal">
        <div class="info_per_left">
            <div class="">
                <div id="links_back">
                    <a href="{{url('panel')}}">Panel de usuario</a>
                    <span>Información personal</span>
                </div>
                <div id="user_alias">
                    <h1>Información <span class="span_block">personal</span>
                    </h1>
                </div>
            </div>
        </div>
        <div class="info_per_right">
            <form action="#">
                <div class="input_err">
                    <div class="in_img">
                        <div class="cont_box">
                            <div class="box">
                                <input type="file" name="" id="foto_perfil"
                                       class="inputfile_2 inputfile_per"
                                       accept="image/*"/>
                                <img src="{{$avatar}}"
                                     alt="">
                            </div>
                            <label for="foto_perfil"><span
                                    class="subrayado resaltado_amarillo cambia_avatar">Cambiar avatar</span></label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section id="panel_user_profile" class="contenedor">
        <div class="form_left">
            <form action="#">
                <div class="input_err">
                    <label>Usuario<strong>*</strong></label>
                    <div class="in_sp obligatorio editar">
                        <input type="text" name="userName" value="{{$username}}" id="userName">
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>

            <form action="#">
                <div class="input_err">
                    <label>Correo electrónico<strong>*</strong></label>
                    <div class="in_sp obligatorio editar">
                        <input type="email" name="email" value="{{$email}}" disabled>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>

            <form action="#">
                <div class="input_err">
                    <label>Nombre<strong>*</strong></label>
                    <div class="in_sp obligatorio editar">
                        <input type="text" name="name" value="{{$name}}" id="name">
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
            <form action="#">
                <div class="input_err">
                    <label>Apellido<strong>*</strong></label>
                    <div class="in_sp obligatorio editar">
                        <input type="text" name="lastName" value="{{$lastName}}" id="lastName">
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
            <form action="#">
                <div class="input_err select">
                    <label class='oculto'>País<strong>*</strong></label>
                    <div class="in_sp editar">
                        <div class="arm_sel">
                            <select name='country' id='pais_suscriptor'
                                    class=''>
                                @foreach($paises as $pais)
                                    <option
                                        value='{{$pais->nombre}}'
                                        {{strtolower($country) == strtolower($pais->nombre)? "selected":""}}
                                        data-iso="{{$pais->iso}}"
                                    >{{$pais->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>

            <form action="#">
                <div class="input_err select">
                    <label class='oculto'>Provincia/Estado<strong>*</strong></label>
                    <div class="in_sp editar">
                        <div class="arm_sel">
                            <select name='provincia' id='provincias'
                                    class=''>
                                @if($provincia == "")
                                    <option id="select_pais" value='ninguno'
                                            selected hidden>Elegir...
                                    </option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>

            <form action="#">
                <div class="input_err select">
                    <label class='oculto'>Ciudad/Barrio<strong>*</strong></label>
                    <div class="in_sp editar">
                        <div class="arm_sel">
                            <select name='city' id='ciudades'
                                    class=''>
                                @if($city == "")
                                    <option id="select_pais" value='ninguno'
                                            selected hidden>Elegir...
                                    </option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>

        </div>
        <div class="form_right">

            <form action="#">
                <div class="input_err">
                    <label>Fecha de nacimiento<strong>*</strong></label>
                    <div class="in_sp obligatorio editar">
                        <input type="date" name="birth_date"
                               value="{{$birthDate}}" id="birthDate">
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
            <form action="#">
                <div class="input_err">
                    <label>Profesión<strong>*</strong></label>
                    <div class="in_sp obligatorio editar">
                        <input type="text" name="profesion"
                               value="{{$profesion}}" id="profesion">
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
            <form action="#">
                <div class="input_err">
                    <label>Descripción<strong>*</strong></label>
                    <div class="in_sp obligatorio editar">
                        <input type="text" name="description"
                               value="{{$description}}" id="description">
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>

            <form action="#">
                <div class="input_err">
                    <label>Whatsapp<strong>*</strong></label>
                    <div class="in_sp editar">
                        <input type="number" name="whatsapp" value="{{$whatsapp}}" id="whatsapp">
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>

            <form action="#">
                <div class="input_err">
                    <label>Facebook<strong>*</strong></label>
                    <div class="in_sp editar">
                        <input type="text" name="facebook" value="{{$facebook}}" style="padding: 8px;" id="facebook">
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
            <form action="#">
                <div class="input_err">
                    <label>Twitter<strong>*</strong></label>
                    <div class="in_sp editar">
                        <input type="text" name="twitter" value="{{$twitter}}" style="padding: 5px;" id="twitter">
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
            <form action="#">
                <div class="input_err">
                    <label>Instagram<strong>*</strong></label>
                    <div class="in_sp editar">
                        <input type="text" name="instagram"
                               value="{{$instagram}}" style="padding: 5px;" id="instagram">
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
        </div>
        <div class="info_per_nota">
            <strong>*</strong> = <span class="subrayado">Obligatorios para obtener fichas extra.</span>
        </div>
        <div id="boton_submit">
            <button
                class="subrayado resaltado_amarillo text_bold"
                id="boton_perfil">
                Guardar
            </button>
        </div>

    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>

    @if(Session::get('alert') == "profile_not_completed")
        <div class="general_profile_msg popup top_msg">
            <div class="contenedor msg_position_rel">
                <div id="texto_exito">
                    <span>Suma más fichas completando todo tu perfil.</span>
                </div>
                <div class="cerrar">
                    <span>X</span>
                </div>
            </div>
        </div>
    @endif
@endsection
<div id="exito_msg" class="popup">
    <div>
        <div id="texto_exito">
            <span>Guardando</span>
        </div>
    </div>
</div>

@section('footer')

    <script>
        const provincias = {!! $provincias !!};
        const ciudades = {!! $ciudades !!};

        const paisCombo = $("#pais_suscriptor");
        const provinciasCombo = $("#provincias");
        const citiesCombo = $("#ciudades");

        paisCombo.change(function () {
            const iso = $(this).children("option:selected").data('iso');
            const options = filterProvincias(iso);
            const cityOptions = filterCiudadesByCountry(iso);
            generateProvinciasOptions(options, $("#provincias"));
            generateProvinciasOptions(options, $("#ciudades"));
        });

        function filterCiudades(provId) {
            return ciudades.filter((item) => {
                return item.idProvincia == provId;
            });
        }

        provinciasCombo.change(function () {
            const provId = $(this).children("option:selected").data('prov');
            const options = filterCiudades(provId);
            generateProvinciasOptions(options, $("#ciudades"));
        });

        function filterProvincias(iso) {
            return provincias.filter((item) => {
                return item.pais == iso;
            });
        }

        function generateProvinciasOptions(options, element, savedItem) {
            const html = options.map((item) => {
                const nombre = item.nombre;
                const selected = item.nombre == savedItem? "selected":"";
                return `<option value="${nombre}" data-prov="${item.id}" ${selected}>
                                       ${nombre}
                                  </option>`;
            });
            const firstOption = `<option id="select_pais" value='ninguno'
                                        disabled selected hidden>Elegir...
                                </option>`;
            element.empty();
            element.append(firstOption);
            element.append(html);
        }



        if (document.getElementsByClassName("general_profile_msg")) {
            var get_general_msg = document.getElementsByClassName("general_profile_msg");
            for (var x = 0; x < get_general_msg.length; x++) {
                get_general_msg[x].numerito = x;
                var get_close_modal = get_general_msg[x].getElementsByClassName("cerrar")[0];
                get_close_modal.onclick = function () {
                    close(this.parentNode.parentNode);
                };
            }
        }

        function submitImage() {
            console.log("subiendo imagen");
            const imageFile = $("#foto_perfil")[0].files[0];
            const url = '{{url('/profile/image')}}';
            const formData = new FormData();
            formData.append('images[]', imageFile, imageFile.filename);
            axios({
                url: url,
                method: 'post',
                data: formData,
                headers: {
                    'accept': 'application/json',
                    'Accept-Language': 'en-US,en;q=0.8',
                    'Content-Type': `multipart/form-data; boundary=${formData._boundary}`
                }
            }).then(response => {
                console.log(response.data);
                const get_modal_exito = document.getElementById("exito_msg");
                const efecto1 = setTimeout(close(get_modal_exito), 600);
                location.reload();
            }).catch(error => {
                console.log(error);
            });
        }

        function submit(element, _type) {
            console.log("submiteando");
            const input = (_type == "select") ? $(element).find('select') : $(element).find('input');
            const value = input.val();
            const type = input.attr("name");
            update(type, value).then((response) => {
                console.log(response.data);
                const get_modal_exito = document.getElementById("exito_msg");
                const efecto1 = setTimeout(close(get_modal_exito), 600);
            }).catch((error) => {
                console.log(error);
                const get_modal_exito = document.getElementById("exito_msg");
                const efecto1 = setTimeout(close(get_modal_exito), 600);
            });
            window.location.reload();
        }

        $("#boton_perfil").click(function(event) {
            event.preventDefault();
            const formData = new FormData();
            formData.append('userName', $("#userName").val());
            formData.append('name', $("#name").val());
            formData.append('lastName', $("#lastName").val());
            formData.append('birth_date', $("#birthDate").val());
            formData.append('profesion', $("#profesion").val());
            formData.append('description', $("#description").val());
            formData.append('whatsapp', $("#whatsapp").val());
            formData.append('facebook', $("#facebook").val());
            formData.append('twitter', $("#twitter").val());
            formData.append('instagram', $("#instagram").val());
            formData.append('country', $("#pais_suscriptor").val());
            formData.append('provincia', $("#provincias").val() == null? '': $("#provincias").val());
            formData.append('city', $("#ciudades").val() == null? '':$("#ciudades").val());
            $("#exito_msg").show();
            const url = '{{url('/profile/update')}}';
            axios({
                url: url,
                method: 'post',
                data: formData,
                headers: {
                    'accept': 'application/json',
                    'Accept-Language': 'en-US,en;q=0.8',
                    'Content-Type': `multipart/form-data; boundary=${formData._boundary}`
                }
            }).then(response => {
                const get_modal_exito = document.getElementById("exito_msg");
                const efecto1 = setTimeout(close(get_modal_exito), 600);
            }).catch((error) => {
                console.log(error);
                const get_modal_exito = document.getElementById("exito_msg");
                const efecto1 = setTimeout(close(get_modal_exito), 600);
            })
            if($("#foto_perfil")[0].files.length > 0) {
                submitImage();
            }
        });

        function update(type, value) {
            const url = '{{url('/profile/update')}}';
            return axios.post(url, {
                type: type,
                value: value
            });

        }

        function filterCiudadesByCountry(iso) {
            const idsProvincias = filterProvincias(iso);
            const provs = idsProvincias.map(item => {
                return filterCiudades(item.id);
            });
            return provs.flat();

        }

        function getProvIdByName(provinciaName) {
            const provincia =  provincias.find(item => {
                return item.nombre.toLowerCase() == provinciaName.toLowerCase();
            });
            return provincia.id;
        }

        $(document).ready(function () {
            const savedProvincia = '{{$provincia}}';
            const savedCity = '{{$city}}';
            const iso = $('#pais_suscriptor').children("option:selected").data('iso');
            const options = filterProvincias(iso);
            generateProvinciasOptions(options, $("#provincias"), savedProvincia);
            if(savedProvincia == "null" || savedProvincia == '' || savedProvincia == null) {
                const cityOptions1 = filterCiudadesByCountry(iso);
                generateProvinciasOptions(cityOptions1, $("#ciudades"), savedCity);
            } else {
                const provId = getProvIdByName(savedProvincia);
                const cityOptions2 = filterCiudades(provId);
                generateProvinciasOptions(cityOptions2, $("#ciudades"), savedCity);
            }

        });


    </script>
@endsection
