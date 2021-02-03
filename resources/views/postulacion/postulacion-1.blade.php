@extends('orsai-template')

@section('title', 'Postulación | Comunidad Orsai')
@section('description', 'Postulación')

@section('header')
    <link rel="stylesheet" href="{{url('estilos/estilos_conc.css')}}">
@endsection

@section('content')
    <div class="fondo_blanco">
        <section id="intro" class="contenedor intro_gral contenedor_newform">
            <div>
                <h1 class="span_h1">Completá los datos de tu postulación</h1>
            </div>
            <div class="pasos">
                <span>1/2</span>
            </div>
        </section>

        <section class="contenedor contenedor_newform">
            <form method="POST" id="concursos" action="{{url('postulaciones')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$concurso->id}}" name="contest_id">
                <input type="hidden" value="{{$postulacion? $postulacion->id: 0}}" name="cap_id">
                <div class="new_form">
                    <div class="input_err">
                        <label>Título de la obra *</label>
                        <div class="tooltip_new">
                            <span class="ask_icon">(?)</span>
                            <div class="modal_asq oculto">
                                <span class="close_asq">(x)</span>
                                <div class="recuadro_black">
                                    <p>Elegí las palabras que más identifican tu narrativa.</p>
                                </div>
                            </div>
                        </div>
                        <input type="text" name="title" class="obligatorio"
                               value="{{$postulacion? $postulacion->title: ""}}">

                    </div>
                </div>
                <div class="new_form">
                    <div class="input_err">
                        <label>Descripción *</label>
                        <div class="tooltip_new">
                            <span class="ask_icon">(?)</span>
                            <div class="modal_asq oculto">
                                <span class="close_asq">(x)</span>
                                <div class="recuadro_black">
                                    <p>Contanos de qué se trata.</p>
                                </div>
                            </div>
                        </div>
                        <textarea name="description" id="" cols=""
                                  rows="">{{$postulacion? $postulacion->description: ""}}</textarea>
                    </div>
                </div>
                <div class="new_form">
                    <div class="input_err">
                        <label>¿Querés sumar una imagen de portada?</label>
                        <div class="tooltip_new">
                            <span class="ask_icon">(?)</span>
                            <div class="modal_asq oculto">
                                <span class="close_asq">(x)</span>
                                <div class="recuadro_black">
                                    <p>Tener una portada te asegura un X% más de visualizaciones.</p>
                                </div>
                            </div>
                        </div>
                        <input type="file" name="images[]" id="img-btn" accept="image/png, image/jpeg, image/jpg"
                               hidden/>
                        <input type="hidden" value="0" name="image_flag" id="image_flag">
                        @if($hasImage)
                            <span id="img_nombre" class="nombre_archivo">{{$hasImage->original_name}}</span>
                        @else
                            <span id="img_nombre" class="nombre_archivo">No hay ningun archivo seleccionado</span>
                        @endif
                        <label for="img-btn" class="btn_file">+</label>
                        <label for="" class="btn_file" onclick="deleteImage()">x</label>
                    </div>
                </div>
                <div class="new_form">
                    <div class="input_err">
                        <label>Link</label>
                        <div class="tooltip_new">
                            <span class="ask_icon">(?)</span>
                            <div class="modal_asq oculto">
                                <span class="close_asq">(x)</span>
                                <div class="recuadro_black">
                                    <p>Compartí una URL en donde podamos ver más.</p>
                                </div>
                            </div>
                        </div>
                        <input type="text" name="link" class="obligatorio"
                               value="{{$postulacion? $postulacion->link: ""}}">
                    </div>
                </div>
                <div class="new_form">
                    <div class="input_err">
                        <label>¿Querés sumar un archivo? </label>
                        <div class="tooltip_new">
                            <span class="ask_icon">(?)</span>
                            <div class="modal_asq oculto">
                                <span class="close_asq">(x)</span>
                                <div class="recuadro_black">
                                    <p>Subí un archivo en formato pdf.</p>
                                </div>
                            </div>
                        </div>
                        <input type="file" name="pdf[]" id="pdf-btn" accept="application/pdf, .doc, .docx, .odf"
                               hidden/>
                        <input type="hidden" name="pdf_flag" value="0" id="pdf_flag">
                        @if($hasPdf)
                            <span id="pdf_nombre" class="nombre_archivo">{{$hasPdf->original_name}}</span>
                        @else
                            <span id="pdf_nombre" class="nombre_archivo">No hay ningun archivo seleccionado</span>
                        @endif
                        <label for="pdf-btn" class="btn_file">+</label>
                        <label for="" class="btn_file" onclick="deletePdf()">x</label>

                    </div>
                </div>
                <div class="info_per_nota">
                    <strong>*</strong> = <span class="subrayado">Campos obligatorios.</span>
                </div>
                <div class="new_form">
                    <div class="btn_right">
                        <button type="submit" id="btn_concurso"
                                class="boton_redondeado resaltado_amarillo text_bold pd_50_lf_rg font_16">
                            Siguiente &raquo;
                        </button>
                    </div>
                </div>
            </form>
        </section>
        <div class="mg_100">

        </div>
    </div
@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
    <script>
        const actualBtn = document.getElementById('img-btn');

        const fileChosen = document.getElementById('img_nombre');
        actualBtn.addEventListener('change', function () {
            fileChosen.textContent = this.files[0].name
        });

        var pdf_btn = document.getElementById('pdf-btn');

        var pdf_nombre = document.getElementById('pdf_nombre');

        pdf_btn.addEventListener('change', function () {
            pdf_nombre.textContent = this.files[0].name
        });


        window.addEventListener('load', init, false);
        var asq_form = document.getElementsByClassName("modal_asq");
        var close_asq = document.getElementsByClassName("close_asq");
        for (var x = 0; x < close_asq.length; x++) {
            close_asq[x].posicion = x;
            close_asq[x].onclick = function () {
                asq_form[this.posicion].classList.add("oculto");
            }
        }
        var ask_icon = document.getElementsByClassName("ask_icon");
        for (var x = 0; x < ask_icon.length; x++) {
            ask_icon[x].posicion = x;
            ask_icon[x].onclick = function () {
                for (var i = 0; i < asq_form.length; i++) {
                    if (!asq_form[i].classList.contains("oculto")) {
                        asq_form[i].classList.add("oculto");
                    }
                }
                asq_form[this.posicion].classList.remove("oculto");
            }
        }
        ;


        $(".contenedor_concursos").fadeIn(600).css("display", "inline-block");

        if (document.getElementById("ordenar")) {
            var get_ordenar = document.getElementById("ordenar");
            get_ordenar.onclick = function () {
                var get_icon = get_ordenar.getElementsByClassName("ordenar_bt")[0].getElementsByTagName("span")[0];
                var get_lista_orden = document.getElementsByClassName("buscador_links_filtros")[0].getElementsByTagName("ul")[0];
                if (get_lista_orden.classList.contains("orden_abierto")) {
                    get_icon.classList.remove("icon-angle-up");
                    get_icon.classList.add("icon-angle-down");
                    get_lista_orden.classList.remove("orden_abierto");
                } else {
                    get_icon.classList.remove("icon-angle-down");
                    get_icon.classList.add("icon-angle-up");
                    get_lista_orden.classList.add("orden_abierto");
                }
            }
        }


        $(function () {
            $("#btn_concurso").on("click", function () {
                $("#concursos").validate({
                    ignore: "",
                    rules: {
                        title: {required: true, minlength: 2, maxlength: 255},
                        description: {required: true, minlength: 2, maxlength: 255},
                        link: {url: true},
                        "images[]": {extension: "png|jpe|jpg"},
                        "pdf[]": {extension: "pdf"}
                    },
                    messages: {
                        title: "El campo Nombre es obligatorio (de 2 a 255 caracteres)",
                        description: "La descripcion es obligatoria (de 2 a 255 caracteres)",
                        link: "La url ingresada no es valida",
                        "images[]": "El archivo seleccionado no es valido",
                        "pdf[]": "El archivo seleccionado no es valido"
                    },
                    errorElement: 'span'
                });
            });
        });

        function deletePdf() {
            console.log("delete pdf");
            const pdf = $("#pdf-btn");
            const nombre = $("#pdf_nombre");
            const flag = $("#pdf_flag");
            pdf.val('');
            nombre.empty();
            const legend = 'No hay ningun archivo seleccionado';
            nombre.append(legend);
            flag.val(1);
        }

        function deleteImage() {
            console.log("delete image");
            const imagen = $("#img-btn");
            const nombre = $("#img_nombre");
            const flag = $("#image_flag");
            imagen.val('');
            nombre.empty();
            const legend = 'No hay ningun archivo seleccionado';
            nombre.append(legend);
            flag.val(1);
        }

    </script>
@endsection
