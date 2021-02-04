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
                <h1 class="span_h1">Subí tu postulación</h1>
            </div>
            <div class="pasos">
                <span>2/2</span>
            </div>
        </section>

        <section class="contenedor contenedor_newform">
            <form action="{{url('capitulos')}}" id="concursos" method="POST">
                @csrf
                <input type="hidden" name="cap_id" value="{{$postulacion->id}}">
                <input type="hidden" name="orden" value="{{$orden}}">

                <div class="new_form">
                    @if($concurso->type == 1)
                    @else
                        <label class="capitulo">Capitulo {{$orden == 0? 1: $orden}}</label>
                    @endif
                </div>
                <div class="new_form">
                    <div class="input_err">
                        <label>Título*</label>
                        <div class="tooltip_new">
                            <span class="ask_icon">(?)</span>
                            <div class="modal_asq oculto">
                                <span class="close_asq">(x)</span>
                                <div class="recuadro_black">
                                    <p>Elegí el título del capítulo.</p>
                                </div>
                            </div>
                        </div>
                        <input type="text" name="title" class="obligatorio" data-error="#errNm1"
                               value="{{$capitulo? $capitulo->title:""}}" id="title">
                        <span id="errNm1" class="error"></span>
                    </div>
                </div>
                <div class="new_form">
                    <div class="input_err">
                        <label>Cuerpo*</label>
                        <div class="tooltip_new">
                            <span class="ask_icon">(?)</span>
                            <div class="modal_asq oculto">
                                <span class="close_asq">(x)</span>
                                <div class="recuadro_black">
                                    <p>Añadí el texto completo de tu postulación.</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <textarea name="body" id="summernote"
                                      data-error="#errNm2">{{$capitulo? $capitulo->body: ""}}</textarea>
                        </div>
                        <div id="errNm2" class="error"></div>
                    </div>
                </div>

                <div class="info_per_nota">
                    <strong>*</strong> = <span class="subrayado">Campos obligatorios.</span>
                </div>
                <div class="new_form">
                    @if($concurso->type == 2)
                        <div class="btn_right">
                            <button id="btn_cargar_capitulo" type="submit"
                                    class="boton_redondeado subrayado resaltado_amarillo text_bold">
                                Siguiente capítulo &raquo;
                            </button>
                        </div>
                    @endif
                    <div class="btn_left">
                        @if($orden > 1)
                            <button class="boton_redondeado subrayado resaltado_amarillo text_bold"
                                    onclick="goToChapter('{{$orden - 1}}')">
                                &laquo; Capítulo anterior
                            </button>
                        @else
                            <a onclick="goToCpa()" target="_blank"
                               class="boton_redondeado resaltado_gris font_14 pd_50_lf_rg">&laquo; Volver</a>
                        @endif
                    </div>
                </div>
                {{--
                    Debería dejarte borrar el capitulo pero si es que ya se cargó.
                    Ahora lo deje así para que no te deje eliminar el primero.
                     --}}
                @if($concurso->type == 2 && $orden > 1 && $capitulo)
                    <div class="align_center">
                        <button class="boton_redondeado subrayado resaltado_rojo_circ text_bold width_100 mg_bt_20"
                                data-orden="{{$orden}}"
                                id="btn_delete">
                            Eliminar capitulo
                        </button>
                    </div>
                @endif
                <div class="new_form">
                    <div class="new_form">
                        <div class="align_center">
                            <button id="btn_concurso"
                                    class="boton_redondeado resaltado_amarillo text_bold pd_50_lf_rg font_16 width_100"
                                    onclick="finalizar('{{$postulacion->id}}')">
                                Finalizar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="mg_100"></div>
        </section>
    </div>
@endsection

<div class="modal_msg">
    <div class="mensaje">
        <div>
            <span class="text_bold">¿Querés eliminar el capítulo?</span>
            <span class="boton_redondeado resaltado_rojo_circ confirma_eliminar btn_modal resaltado_rojo text_bold"
                  onclick="deleteCpa('{{$orden}}')">Eliminar</span>
            <span class="boton_redondeado cerrar btn_modal resaltado_amarillo text_bold">Cancelar</span>
        </div>
    </div>
</div>

@section('footer')
    <style>
        .error {
            color: red;
            font-size: 12px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 120,
            toolbar: [
                //   ['style', ['style']],
                ['font', ['bold', 'underline', 'size']],
                ['color', ['color']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                //   ['table', ['table']],
                //   ['insert', ['link', 'picture', 'video']],
                //   ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onPaste: function (e) {
                    const bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    const div = document.createElement("div");
                    div.innerHTML = bufferText;
                    const text = div.textContent || div.innerText || "";
                    document.execCommand('insertHtml', false, text);
                }
            }
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

        function validar_capitulo() {
            $("#concursos").validate({
                submit: false,
                ignore: ":hidden:not(#summernote),.note-editable.panel-body",
                rules: {
                    title: {required: true, minlength: 2, maxlength: 120},
                    summernote: {required: true, minlength: 2, maxlength: {{$concurso->cant_caracteres}} }
                },
                messages: {
                    title: {
                        required: "El campo Título es obligatorio (de 2 a 50 caracteres)",
                        minlength: "Dale media pila, escribí más",
                        maxlength: "No se pueden escribir más de {0} caracteres"
                    },
                    summernote: "El texto es obligatorio (de 2 a {{$concurso->cant_caracteres}} caracteres)"
                },
                errorPlacement: function (error, element) {
                    if (element.attr("name") == "body") {
                        console.log('d2', element.attr("name"))
                        error.appendTo("#errNm2");
                    } else {
                        console.log('d1', element.attr("name"))
                        error.insertAfter(element)
                    }
                }
            });
        }


        function popup() {
            $(".modal_msg").fadeIn();
        };

        $(".cerrar").on("click", function () {
            $(".modal_msg").fadeOut();
        });
        $(".confirma_eliminar").on("click", function () {
            $(".modal_msg").fadeOut();
        });

        $(function () {
            // $("#btn_concurso").on("click", function () {
            //     validar_capitulo();
            // });
            $("#btn_cargar_capitulo").on("click", function () {
                validar_capitulo();
            });
            $("#btn_delete").on("click", function () {
                event.preventDefault();
                popup();
            });
        });

        function goToChapter(chapterNumber) {
            event.preventDefault();
            window.location = `{{url('postulaciones/'.$concurso->id.'/'.$concurso->name.'/capitulos')}}/${chapterNumber}`;
        }

        function goToCpa() {
            event.preventDefault();
            window.location = `{{url('postulaciones/'.$concurso->id.'/'.$concurso->name)}}`;
        }

        function deleteCpa(orden) {
            event.preventDefault();
            const url = `{{url('borrar-capitulo')}}`;
            axios.post(url, {
                cap_id: {{$postulacion->id}},
                orden: orden
            }).then(response => {
                console.log(response);
                window.location = response.data.url;
            }).catch(error => {
                console.log(error);
            });
        }

        function validateInput(text, min, max, element) {
            element.empty();
            const msg1 = `Este campo es obligatorio (de ${min} a ${max} caracteres)`;
            const msg2 = `No se pueden escribir más de ${max} caracteres`;
            if (text.length > min && text.length <= max) {
                return {
                    status: true,
                    msg: ""
                }
            }
            if (text.length <= max) {
                element.append(msg1)
                return {
                    status: false,
                    msg: msg1
                }
            }
            element.append(msg2)
            return {
                status: false,
                msg: msg2
            }
        }


        function finalizar(capId) {
            event.preventDefault();
            const url = '{{url('capitulos')}}';
            const title = $("#title").val();
            const body = $("#summernote").val();
            const error1 = $("#errNm1");
            const error2 = $("#errNm2");
            console.log(body);
            const validTitle = validateInput(title, 2, 120, error1);
            const validBody = validateInput(body, 10, {{$concurso->cant_caracteres}}, error2);
            if (validTitle && validBody) {
                axios.post(url, {
                    "cap_id": {{$postulacion->id}},
                    "orden": {{$orden}},
                    "title": title,
                    "body": body
                }).then(response => {
                    window.location = `{{url('postulaciones/'.$concurso->id.'/'.$concurso->name.'/finalizar')}}/${capId}`;
                }).catch(error => {
                    console.log(error);
                    alert("Ha ocurrido un error");
                });
            }
        }
    </script>
@endsection
