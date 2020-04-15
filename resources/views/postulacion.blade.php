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
            @csrf
            <div id="postulacion_form">
                <div class="aclara">
                    <span>Obligatorios</span>
                </div>
                <div class="contenedor_campos">
                    <div class="inp_lf">
                        <div class="input_err">
                            <label>Título* <span
                                    class="ask_icon">(?)</span></label>

                            <input type="text" name="title" class="obligatorio"
                                   value="{{$title?? old('title') }}" id="title">'
                            @if ($errors->has('title'))
                                <span class="error">
                                    <strong>El campo título es obligatorio.</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input_err">
                            <label>Descripción* <span
                                    class="ask_icon">(?)</span></label>
                            <textarea name="description" id="text_area"
                                      cols="30" rows="10"
                                      maxlength="288"
                                      class="obligatorio">{{old('description')}}</textarea>
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
                            <div class="cont_box">
                                <div class="box">
                                    <input type="file" name="logo[]"
                                           id="file-1"
                                           class="inputfile inputfile-3 obligatorio"
                                           accept="image/*"/>

                                    <label
                                        for="file-1"><span>Adjuntar</span></label>
                                </div>
                                <span class="logo_sp_size" id="file-1-sp">Formato: 1024X1024px / JPG / PNG / 25MB</span>
                                @if ($errors->has('logo'))
                                    <span class="error">
                                            <strong>El logo es obligatorio.</strong>
                                        </span>
                                @endif
                            </div>
                            <!-- <span class="error">hola este es un error</span> -->
                        </div>
                        <div class="input_err cont_in_field small_25">
                            <label>Aplicaciones del logo* <a href="#"
                                                             class="ask_icon">(?)</a></label>
                            <div class="caja_boxes">
                                <div class="cont_box">
                                    <div class="box box_sm">
                                        <input type="file" name="images[]"
                                               id="file-2"
                                               onchange="next_hno(this)"
                                               class="inputfile inputfile-3 obligatorio"
                                               accept="image/*"/>
                                        <label
                                            for="file-2"><span>&#x0002B;</span></label>
                                    </div>
                                </div>
                                <div class="cont_box">
                                    <div class="box">
                                        <input type="file" name="images[]"
                                               id="file-3"
                                               onchange="next_hno(this)"
                                               class="inputfile inputfile-3"
                                               accept="image/*" disabled/>
                                        <label
                                            for="file-3"><span>&#x0002B;</span></label>
                                    </div>
                                </div>
                                <div class="cont_box">
                                    <div class="box">
                                        <input type="file" name="images[]"
                                               id="file-4"
                                               onchange="next_hno(this)"
                                               class="inputfile     inputfile-3"
                                               accept="image/*" disabled/>
                                        <label
                                            for="file-4"><span>&#x0002B;</span></label>
                                    </div>
                                </div>
                                <div class="cont_box">
                                    <div class="box">
                                        <input type="file" name="images[]"
                                               id="file-5"
                                               onchange="next_hno(this)"
                                               class="inputfile     inputfile-3"
                                               accept="image/*" disabled/>
                                        <label
                                            for="file-5"><span>&#x0002B;</span></label>
                                    </div>
                                </div>
                                <div class="cont_box">
                                    <div class="box">
                                        <input type="file" name="images[]"
                                               id="file-6"
                                               onchange="next_hno(this)"
                                               class="inputfile     inputfile-3"
                                               accept="image/*" disabled/>
                                        <label
                                            for="file-6"><span>&#x0002B;</span></label>
                                    </div>
                                </div>
                            </div>
                            <span class="logo_sp_size" id="sp_aplicaciones">Formato: 1024X1024px / JPG / PNG / 25MB</span>
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
                            <label class=''>Archivo PDF <span class="ask_icon">(?)</span></label>
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
                                <div class="box">
                                    <input type="file" name="" id="file-7"
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
                            <input type="text" name="link"
                                   value="{{old('link')}}">
                        </div>
                    </div>
                </div>
                <div class="line_dashed"></div>
                <div id="boton_submit">
                    <button class="subrayado resaltado_amarillo text_bold"
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

        // $('#boton_postulacion').click((event) => {
        //     event.preventDefault();
        //     const validations = [];
        //     validations.push(validateTexts());
        //     validations.push(validateLogo());
        //     validations.push(validateAplicaciones());
        //     if(validations.every((item) => item == true)) {
        //         $('#cpa_form').submit();
        //     }
        // });

        const validateAplicaciones = () => {
            const filesAplicaciones = $('input[name="images[]"]');
            const arrayFilesAplicaciones = filesAplicaciones.toArray();
            console.log(arrayFilesAplicaciones);
            const areCompletedFileInputs = arrayFilesAplicaciones.every((item) => item.files.length > 0);
            if (areCompletedFileInputs) {
                return true;
            }
            createErrorMessage($('#sp_aplicaciones'), "Las aplicaciones de logo son obligatorias");
            return false;
        };

        const validateLogo = () => {
            const inputLogo = $('#file-1');
            if (inputLogo[0].files.length > 0) {
                return true;
            }
            createErrorMessage($('#file-1-sp'), "El logo es obligatorio");
            return false;
        };

        const validateTexts = () => {
            const titleElement = $('#title');
            const descriptionElement = $('#text_area');
            if (titleElement.val() != "" && descriptionElement.val() != "") {
                return true;
            }
            if(titleElement.val() == "") {
                createErrorMessage(titleElement, "El título es obligatorio");
            }
            if(descriptionElement.val() == "") {
                createErrorMessage(descriptionElement, "El título es obligatorio");
            }
            return false;
        };

        function createErrorMessage(element, message) {
            const errorElement = ` <span class="error">
                                    <strong>${message}</strong>
                                </span>`;
            element.after(errorElement);
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
