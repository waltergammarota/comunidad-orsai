@extends('orsai-template')


@section('content')
    <section id="intro" class="contenedor intro_registro">
        <div>
            <h1>Registro <span class="span_block">de postulación</span></h1>
        </div>
        <div>
            <p class="texto_italica span_h2">
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed
                diam nonummy nibh.
            </p>
        </div>
    </section>
    <section id="postulacion_js" class="contenedor form_postulacion">
        <form action="{{url('postulacion')}}" method="POST"
              enctype="multipart/form-data" id="cpa_form">
            @isset($cap_id)
                <input type="hidden" value="{{$cap_id}}" name="cap_id"/>
            @else
                <input type="hidden" value="0" name="cap_id"/>
            @endif
            @csrf
            <div id="postulacion_form">
                <div class="aclara">
                    <span>Obligatorios</span>'
                </div>
                <div class="contenedor_campos">
                    <div class="inp_lf">
                        <div class="input_err">
                            <label>Título* <span
                                    class="ask_icon">(?)</span></label>
                            <div class="modal_asq oculto">
                                <span class="close_asq">(x)</span>
                                <div class="recuadro_black">
                                    <p>dajlkd asd jdklsajd ad alkjdal dlask dla
                                        dla dlas dlkas dlkaj dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda. dajlkd asd jdklsajd ad alkjdal
                                        dlask dla dla dlas dlkas dlkaj
                                        dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda.dajlkd asd jdklsajd ad alkjdal
                                        dlask dla dla dlas dlkas dlkaj
                                        dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda.
                                    </p>
                                </div>
                            </div>
                            <input type="text" name="title"
                                   class="obligatorio"
                                   value="{{$cap_title?? old('title') }}"
                                   id="title">'
                            @if ($errors->has('title'))
                                <span class="error">
                                    <strong>El campo título es obligatorio.</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input_err">
                            <label>Descripción* <span
                                    class="ask_icon">(?)</span></label>
                            <div class="modal_asq oculto">
                                <span class="close_asq">(x)</span>
                                <div class="recuadro_black">
                                    <p>dajlkd asd jdklsajd ad alkjdal dlask dla
                                        dla dlas dlkas dlkaj dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda. dajlkd asd jdklsajd ad alkjdal
                                        dlask dla dla dlas dlkas dlkaj
                                        dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda.dajlkd asd jdklsajd ad alkjdal
                                        dlask dla dla dlas dlkas dlkaj
                                        dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda.
                                    </p>
                                </div>
                            </div>
                            <textarea name="description"
                                      id="text_area"
                                      cols="30" rows="10"
                                      maxlength="288"
                                      class="obligatorio">{{$cap_description?? old('description')}}</textarea>
                            <span
                                class="logo_sp_size">Caracteres restantes: <span
                                    id="cant_car">288</span></span>
                            @if ($errors->has('description'))
                                <span class="error">
                                    <strong>El campo descripción es obligatorio.</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="inp_rt">
                        <div class="input_err cont_in_field">
                            <label>Imagen principal (Logo)* <span
                                    class="ask_icon">(?)</span></label>
                            <div class="modal_asq oculto">
                                <span class="close_asq">(x)</span>
                                <div class="recuadro_black">
                                    <p>dajlkd asd jdklsajd ad alkjdal dlask dla
                                        dla dlas dlkas dlkaj dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda. dajlkd asd jdklsajd ad alkjdal
                                        dlask dla dla dlas dlkas dlkaj
                                        dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda.dajlkd asd jdklsajd ad alkjdal
                                        dlask dla dla dlas dlkas dlkaj
                                        dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda.
                                    </p>
                                </div>
                            </div>
                            <div class="cont_box">
                                <div class="box imageApp">
                                    <input type="file" name="logo[]"
                                           id="file-1"
                                           class="inputfile inputfile-3 obligatorio"
                                           accept="image/*"/>
                                    @if($cap_id > 0)
                                        <label
                                            for="file-1"><span>Cambiar Logo</span></label>
                                        <img
                                            src="{{url('storage/logo/'.$cap_logos[0]['file_name'].".".$cap_logos[0]['file_extension'])}}"/>
                                    @else
                                        <label
                                            for="file-1"><span>Adjuntar</span></label>
                                    @endif
                                </div>
                                <span class="logo_sp_size"
                                      id="file-1-sp">Formato: 1024X1024px / JPG / PNG / 25MB</span>
                                @if ($errors->has('logo'))
                                    <span class="error">
                                            <strong>El logo es obligatorio.</strong>
                                        </span>
                                @endif
                            </div>
                            <!-- <span class="error">hola este es un error</span> -->
                        </div>
                        <div
                            class="input_err cont_in_field small_25">
                            <label>Aplicaciones del logo* <a
                                    href="#"
                                    class="ask_icon">(?)</a></label>
                            <div class="modal_asq oculto">
                                <span class="close_asq">(x)</span>
                                <div class="recuadro_black">
                                    <p>dajlkd asd jdklsajd ad alkjdal dlask dla
                                        dla dlas dlkas dlkaj dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda. dajlkd asd jdklsajd ad alkjdal
                                        dlask dla dla dlas dlkas dlkaj
                                        dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda.dajlkd asd jdklsajd ad alkjdal
                                        dlask dla dla dlas dlkas dlkaj
                                        dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda.
                                    </p>
                                </div>
                            </div>
                            <div class="caja_boxes">
                                <div class="cont_box">
                                    <div class="box box_sm imageApp">
                                        <input type="file"
                                               name="images[0]"
                                               id="file-2"
                                               onchange="next_hno(this)"
                                               class="inputfile inputfile-3 obligatorio"
                                               accept="image/*"/>
                                        @if($cap_id > 0 && array_key_exists(0, $cap_images))
                                            <label
                                                for="file-2"><span>&#x0002B;</span></label>
                                            <img
                                                src="{{url('storage/images/'.$cap_images[0]['file_name'].".".$cap_images[0]['file_extension'])}}" />
                                        @else
                                            <label
                                                for="file-2"><span>&#x0002B;</span></label>
                                        @endif

                                    </div>
                                </div>
                                <div class="cont_box">
                                    <div class="box imageApp">
                                        <input type="file"
                                               name="images[1]"
                                               id="file-3"
                                               onchange="next_hno(this)"
                                               class="inputfile inputfile-3"
                                               accept="image/*"
                                        />
                                        @if($cap_id > 0 && array_key_exists(1, $cap_images))
                                            <label
                                                for="file-3"><span>&#x0002B;</span></label>
                                            <img
                                                src="{{url('storage/images/'.$cap_images[1]['file_name'].".".$cap_images[1]['file_extension'])}}"/>
                                        @else
                                            <label
                                                for="file-3"><span>&#x0002B;</span></label>
                                        @endif
                                    </div>
                                </div>
                                <div class="cont_box" >
                                    <div class="box imageApp">
                                        <input type="file"
                                               name="images[2]"
                                               id="file-4"
                                               onchange="next_hno(this)"
                                               class="inputfile     inputfile-3"
                                               accept="image/*"
                                        />
                                        @if($cap_id > 0 && array_key_exists(2, $cap_images))
                                            <label
                                                for="file-4"><span>&#x0002B;</span></label>
                                            <img
                                                src="{{url('storage/images/'.$cap_images[2]['file_name'].".".$cap_images[2]['file_extension'])}}"/>
                                        @else
                                            <label
                                                for="file-4"><span>&#x0002B;</span></label>
                                        @endif
                                    </div>
                                </div>
                                <div class="cont_box">
                                    <div class="box imageApp">
                                        <input type="file"
                                               name="images[3]"
                                               id="file-5"
                                               onchange="next_hno(this)"
                                               class="inputfile     inputfile-3"
                                               accept="image/*"
                                        />
                                        @if($cap_id > 0 && array_key_exists(3, $cap_images))
                                            <label
                                                for="file-5"><span>&#x0002B;</span></label>
                                            <img
                                                src="{{url('storage/images/'.$cap_images[3]['file_name'].".".$cap_images[3]['file_extension'])}}"/>
                                        @else
                                            <label
                                                for="file-5"><span>&#x0002B;</span></label>
                                        @endif
                                    </div>
                                </div>
                                <div class="cont_box">
                                    <div class="box imageApp">
                                        <input type="file"
                                               name="images[4]"
                                               id="file-6"
                                               onchange="next_hno(this)"
                                               class="inputfile     inputfile-3"
                                               accept="image/*"
                                        />
                                        @if($cap_id > 0 && array_key_exists(4, $cap_images))
                                            <label
                                                for="file-6"><span>&#x0002B;</span></label>
                                            <img
                                                src="{{url('storage/images/'.$cap_images[4]['file_name'].".".$cap_images[4]['file_extension'])}}"/>
                                        @else
                                            <label
                                                for="file-6"><span>&#x0002B;</span></label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <span class="logo_sp_size"
                                  id="sp_aplicaciones">Formato: 1024X1024px / JPG / PNG / 25MB</span>
                            @if ($errors->has('images.*') || $errors->has('images'))
                                <span class="error">
                                    <strong>Las aplicaciones de logo son obligatorias</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="line_dashed"></div>
                <div class="aclara">
                    <span>Opcionales</span>
                </div>
                <div class="contenedor_campos">
                    <div class="inp_lf">
                        <div class="input_err input_op">
                            <label class=''>Archivo PDF <span
                                    class="ask_icon">(?)</span></label>
                            <div class="modal_asq oculto">
                                <span class="close_asq">(x)</span>
                                <div class="recuadro_black">
                                    <p>dajlkd asd jdklsajd ad alkjdal dlask dla
                                        dla dlas dlkas dlkaj dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda. dajlkd asd jdklsajd ad alkjdal
                                        dlask dla dla dlas dlkas dlkaj
                                        dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda.dajlkd asd jdklsajd ad alkjdal
                                        dlask dla dla dlas dlkas dlkaj
                                        dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda.
                                    </p>
                                </div>
                            </div>
                            <div class="modal_asq oculto">
                                <span class="close_asq">(x)</span>
                            </div>
                            <div class="cont_box">
                                <input type="hidden" id="pdf_deleted"
                                       name="pdf_deleted"
                                       value="0"/>
                                <div class="box">
                                    <input type="file" name="pdf[]"
                                           id="file-7"
                                           class="inputfile inputfile-3"
                                           accept="application/pdf"/>
                                    <label for="file-7">
                                        <span
                                            class="adj_span">Adjuntar...</span>
                                        <span
                                            class="adj_span_mas">&#x0002B;</span>
                                    </label>

                                </div>
                                <span
                                    class="logo_sp_size">Formato: PDF  25MB</span>
                            </div>
                        </div>
                    </div>
                    <div class="inp_rt">
                        <div class="input_err input_op">
                            <label class=''>Link <span
                                    class="ask_icon">(?)</span></label>
                            <div class="modal_asq oculto">
                                <span class="close_asq">(x)</span>
                                <div class="recuadro_black">
                                    <p>dajlkd asd jdklsajd ad alkjdal dlask dla
                                        dla dlas dlkas dlkaj dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda. dajlkd asd jdklsajd ad alkjdal
                                        dlask dla dla dlas dlkas dlkaj
                                        dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda.dajlkd asd jdklsajd ad alkjdal
                                        dlask dla dla dlas dlkas dlkaj
                                        dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda.
                                    </p>
                                </div>
                            </div>
                            <div class="modal_asq oculto">
                                <span class="close_asq">(x)</span>
                                <div class="recuadro_black">
                                    <p>dajlkd asd jdklsajd ad alkjdal dlask dla
                                        dla dlas dlkas dlkaj dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda. dajlkd asd jdklsajd ad alkjdal
                                        dlask dla dla dlas dlkas dlkaj
                                        dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda.dajlkd asd jdklsajd ad alkjdal
                                        dlask dla dla dlas dlkas dlkaj
                                        dlkadjasljd
                                        jdlskadjklasdja daklsdj askldjalskdj
                                        alda.
                                    </p>
                                </div>
                            </div>
                            <input type="text" name="link"
                                   value="{{$cap_link ?? old('link')}}">
                        </div>
                    </div>
                </div>
                <div class="line_dashed"></div>
                <div id="boton_submit">
                    <button
                        class="subrayado resaltado_amarillo text_bold"
                        id="boton_postulacion">
                        Postularme
                    </button>
                </div>

            </div>
        </form>
    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
@endsection

@section('footer')
    <script>

            @if($cap_id > 0 && !empty($cap_pdfs))
        const createPdfFileName = () => {
                const box = $(".box");
                const fileName = "{{$cap_pdfs[0]['file_original_name']}}";
                const posicion = 6;
                var change_span = box[posicion].getElementsByTagName("span");
                var addclass_label = box[posicion].getElementsByTagName("label");
                addclass_label[0].classList.add("seleccion");
                change_span[0].innerHTML = fileName;
                change_span[1].innerHTML = "";
                var create_span = box[posicion].appendChild(document.createElement("span"));
                create_span.className = "adj_span_del icon-trash-empty";
                create_span.onclick = function () {
                    var borrar_value = box[posicion].getElementsByTagName("input");
                    borrar_value[0].value = "";
                    change_span[0].innerHTML = "Adjuntar...";
                    box[posicion].removeChild(create_span);
                    addclass_label[0].classList.remove("seleccion");
                    change_span[1].innerHTML = "&#x0002B;";
                    $('#pdf_deleted').val(1);
                };
            };
        $(document).ready(() => {
            createPdfFileName();
        });
        @endif

        function borrarMensajesError() {
            $('.error').hide();
        }


        $('#boton_postulacion').click((event) => {
            event.preventDefault();
            borrarMensajesError();
            const validations = [];
            validations.push(validateTexts());
            @if($cap_id == 0)
            validations.push(validateLogo());
            @endif
                const allValid =[...validations,...validateImages()];
                console.log(allValid);
            if (allValid.every((item) => item == true)) {
                console.log("submit");
                $('#cpa_form').submit();
            }
        });

        const validateImages = () => {
            const elements = $('.imageApp');
            return elements.map((index, item) => {
                const type = index == 0? "logo":"";
                return validateImage($(item), type);
            }).get();
        }

        const validateImage = (element, type) => {
            const image = element.find('img');
            if(image.length == 0) {
                return true;
            }
            if(image[0].naturalHeight == 1024 && image[0].naturalWidth ==  1024) {
                return true;
            }
            if(type == "logo")  {
                createErrorMessage($('#file-1-sp'), "El logo debe ser 1024 x 1024", "errorLogo");
            } else {
                createErrorMessage($('#sp_aplicaciones'), "Las imágenes deben ser 1024 x 1024", "errorMinis");
            }
            return false;
        }

        const validateAplicaciones = () => {
            const filesAplicaciones = $('input[name="images[]"]');
            const arrayFilesAplicaciones = filesAplicaciones.toArray();
            const areCompletedFileInputs = arrayFilesAplicaciones.every((item) => item.files.length > 0);
            if (areCompletedFileInputs) {
                return true;
            }
            createErrorMessage($('#sp_aplicaciones'), "Las aplicaciones de logo son obligatorias", "errorMinis");
            return false;
        };

        const validateLogo = () => {
            const inputLogo = $('#file-1');
            if (inputLogo[0].files.length > 0) {
                return true;
            }
            createErrorMessage($('#file-1-sp'), "El logo es obligatorio", "errorLogo");
            return false;
        };

        const validateTexts = () => {
            const titleElement = $('#title');
            const descriptionElement = $('#text_area');
            if (titleElement.val() != "" && descriptionElement.val() != "") {
                return true;
            }
            if (titleElement.val() == "") {
                createErrorMessage(titleElement, "El título es obligatorio", "errorTitle");
            }
            if (descriptionElement.val() == "") {
                createErrorMessage(descriptionElement, "El título es obligatorio", "errorDescription");
            }
            return false;
        };

        function createErrorMessage(element, message, type) {
            const cssClassName = `.${type}`;
            const isAlreadyThere = $(cssClassName).find().length;
            if (isAlreadyThere == 0) {
                const errorElement = `<span class="error ${type}">
                                    <strong>${message}</strong>
                                </span>`;
                element.after(errorElement);
            }
        }


        $(document).on('keyup', "[maxlength]", function (e) {
            var este = $(this),
                maxlength = este.attr('maxlength'),
                maxlengthint = parseInt(maxlength),
                textoActual = este.val(),
                currentCharacters = este.val().length;
            remainingCharacters = maxlengthint - currentCharacters,
                espan = $('#cant_car');
            if (document.addEventListener && !window.requestAnimationFrame) {
                if (remainingCharacters <= -1) {
                    remainingCharacters = 0;
                }
            }
            espan.html(remainingCharacters);
        });


        var pat_text = new RegExp(/[a-z]{3}/);
        var pat_text_area = new RegExp(/([a-z ]){30,}/);
        var pat_mail = new RegExp(/[\w-\.]{3,}@([\w-]{2,}\.)([\w-]{2,4}\.)?[\w-]{2,4}$/);
        var pat_img = new RegExp(/\.(jpg|png|gif)$/i);
        var pat_pdf = new RegExp(/\.(pdf)$/i);


    </script>
@endsection
