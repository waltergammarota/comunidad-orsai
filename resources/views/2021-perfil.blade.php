@extends('2021-orsai-template')

@section('title', 'Perfil | Comunidad Orsai')
@section('description', 'Perfil')

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
                <li><a href="{{url('panel')}}" rel="noopener noreferrer">Panel de usuario <span class="icon-right-open"></span></a></li>
                <li><a href="{{url('perfil')}}" rel="noopener noreferrer">Información personal <span class="icon-right-open"></span></a></li>
                <li><a href="#" class="activo" rel="noopener noreferrer">Mi perfil</a></li>
            </ul>
        </div>
        </div>
    </div>
<div class="contenedor pd_20_prueba ft_size form_rel">
    @include('2021-menu-informacion-personal',["activo" => "perfil"])
    <div class="grilla_perfil">
        <div id="mi_perfil" class="fondo_blanco">
            <div class="titulo">
                <h1 class="text_regular">Mi perfil</h1>
            </div> 
            <div class="grilla_form">
                <div class="form_ctrl input_ col_6">
                    <div class="info_per_right">
                            <div class="input_err">
                                <div class="in_img">
                                    <div class="cont_box"> 
                                        <div class="box">
                                            <input type="file" name="foto_perfil" id="foto_perfil" class="inputfile_2 inputfile_per" accept="image/*"/>
                                            <img src="{{$avatar}}" alt="{{$username}}">
                                        </div>   
                                        <label for="foto_perfil" class="boton_redondeado resaltado_amarillo text_bold"><span> Cambiar avatar</span><span class="icono icon-editar"></span></label>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div> 
            </div>

            <form action="#">
            <div class="border_tp_form border_bt_form">
                <div class="grilla_form">
                    <div class="form_ctrl input_ col_3">
                        <div class="input_err">
                            <label class="text_medium">Usuario</label> 
                        	<input type="text" name="userName" placeholder="Usuario" value="{{$username}}" class="obligatorio" id="userName" disabled>
                        </div>
                    </div>
                    <div class="form_ctrl input_ col_3">
                        <div class="input_err">
                            <label class="text_medium">Correo Electrónico</label> 
                        	<input type="email" name="email" value="{{$email}}" class="obligatorio" placeholder="Correo Electrónico" disabled> 
                        </div>
                    </div>
                </div>
            </div>    

            <div class="grilla_form">
                <div class="form_ctrl input_ col_3">
                    <div class="input_err">
                        <label class="text_medium">Nombre</label> 
                        <input type="text" name="name" value="{{$name}}" id="name" class="obligatorio" placeholder="Nombre" minlength="3" required>
                        <span class="error">El campo Nombre es obligatorio.</span>
                    </div>
                </div>
                <div class="form_ctrl input_ col_3">
                    <div class="input_err">
                        <label class="text_medium">Apellido</label> 
                        <input type="text" name="lastName" value="{{$lastName}}" id="lastName" class="obligatorio" splaceholder="Apellido" minlength="3" required>
                        <span class="error">El campo Apellido es obligatorio.</span>
                    </div>
                </div>
            </div>

            <div class="grilla_form">
                <div class="form_ctrl input_ col_3">
                    <div class="input_err">
                        <label class="text_medium">Fecha de nacimiento</label>
                        <input type="date" name="birth_date" value="{{$birthDate}}" id="birthDate"> 
                    </div>
                </div>
                <div class="form_ctrl input_ col_3">
                    <div class="input_err">
                        <label class="text_medium">Número de documento / Pasaporte</label>
                        <input type="text" name="mail" class="obligatorio"      placeholder="Apellido">
                    </div>
                </div>
            </div>
            <div class="grilla_form">
                <div class="form_ctrl col_3">
                    <div class="input_err">
                        <label class="text_medium">País de nacimiento</label>
                        <div class="select"> 
                            <select name='country2' id='pais_suscriptor2' class=''>
                                @foreach($paises as $pais)
                                    <option
                                        value='{{$pais->nombre}}'
                                        {{strtolower($country) == strtolower($pais->nombre)? "selected":""}}
                                        data-iso="{{$pais->iso}}"
                                    >{{$pais->nombre}}</option>
                                @endforeach
                            </select>
                            <div class="select__arrow"></div>
                        </div>
                    </div>
                </div>
                <div class="form_ctrl col_3">
                    <div class="input_err">
                        <label class="text_medium">País de residencia</label>
                        <div class="select">
                            <select name='country' id='pais_suscriptor' class=''>
                                @foreach($paises as $pais)
                                    <option
                                        value='{{$pais->nombre}}'
                                        {{strtolower($country) == strtolower($pais->nombre)? "selected":""}}
                                        data-iso="{{$pais->iso}}"
                                    >{{$pais->nombre}}</option>
                                @endforeach
                            </select>
                            <div class="select__arrow"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grilla_form">
                <div class="form_ctrl col_3">
                    <div class="input_err">
                        <label class="text_medium">Provincia/Estado de residencia</label>
                        <div class="select">
                            <select name='provincia' id='provincias'
                                    class=''>
                                @if($provincia == "")
                                    <option id="select_pais" value='ninguno'
                                            selected hidden>Elegir...
                                    </option>
                                @endif
                            </select>
                            <div class="select__arrow"></div>
                        </div>
                    </div>
                </div>
                <div class="form_ctrl col_3">
                    <div class="input_err">
                        <label class="text_medium">Localidad de residencia</label>
                        <div class="select">
                            <select name='city' id='ciudades'
                                    class=''>
                                @if($city == "")
                                    <option id="select_pais" value='ninguno'
                                            selected hidden>Elegir...
                                    </option>
                                @endif
                            </select>
                            <div class="select__arrow"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form_ctrl input_">
                <div class="input_err"> 
					<span class="text_bold">¿No encontrás tu país, provincia o ciudad?
					<a class="subrayado" href="{{url('contacto')}}">Completá este formulario.</a></span> 
                </div>
            </div>
            <div class="form_ctrl input_">
                <div class="input_err">
                    <label class="text_medium">Descripción personal</label>
                    <textarea name="descripcion" placeholder="Escribir..."></textarea>
                </div>
            </div>
            <div class="form_ctrl input_">

            </div>

            <div class="form_ctrl input_">
                <div class="align_right">
                    <button type="submit" id="boton_perfil" class="boton_redondeado resaltado_amarillo text_bold pd_50_lf_rg">Guardar</button>
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
            }).sort(sortComparer);
        }

        provinciasCombo.change(function () {
            const provId = $(this).children("option:selected").data('prov');
            const options = filterCiudades(provId);
            generateProvinciasOptions(options, $("#ciudades"));
        });

        function filterProvincias(iso) {
            return provincias.filter((item) => {
                return item.pais == iso;
            }).sort(sortComparer);

        }

        function sortComparer(a, b) {
            if (a.nombre > b.nombre) {
                return 1;
            }
            if (a.nombre < b.nombre) {
                return -1;
            }
            return 0;
        }

        function generateProvinciasOptions(options, element, savedItem) {
            const html = options.map((item) => {
                const nombre = item.nombre;
                const selected = item.nombre == savedItem ? "selected" : "";
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

        $("#boton_perfil").click(function (event) {
            event.preventDefault();
            const formData = new FormData();
            formData.append('userName', $("#userName").val());
            formData.append('name', $("#name").val());
            formData.append('lastName', $("#lastName").val());
            formData.append('birth_date', $("#birthDate").val()); 
            formData.append('description', $("#description").val()); 
            formData.append('country', $("#pais_suscriptor").val());
            formData.append('provincia', $("#provincias").val() == null ? '' : $("#provincias").val());
            formData.append('city', $("#ciudades").val() == null ? '' : $("#ciudades").val());
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
                if (response.data.action == "validate phone") {
                    window.location = '{{url('validacion-usuario')}}'
                }
            }).catch((error) => {
                console.log(error);
                if (error.response.data.message == "Nombre y Apellido deben ser mayores a 3 caracteres") {
                    alert("Apellido y Nombre deben ser mayores a 3 letras");
                }
                const get_modal_exito = document.getElementById("exito_msg");
                const efecto1 = setTimeout(close(get_modal_exito), 600);
            })
            if ($("#foto_perfil")[0].files.length > 0) {
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
            const provincia = provincias.find(item => {
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
            if (savedProvincia == "null" || savedProvincia == '' || savedProvincia == null) {
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