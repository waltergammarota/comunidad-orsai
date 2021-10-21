@extends('2021-orsai-template')

@section('title', $concurso->name.' | Comunidad Orsai')
@section('description','Concurso | Comunidad Orsai')


@section('content')
    <section class="resaltado_gris">
        <div class="contenedor_interna concurso">
            <div class="cuerpo_interna">
                <article>
                    <p class="inscripcion">Inscripción</p>
                    <h2 class="title">{{$concurso->name}}</h2>
                    <p class="nota">{{$concurso->bajada_corta}}</p>
                    <hr>
                    <form method="POST" id="concursos" action="{{url('postulaciones')}}" enctype="multipart/form-data">
                        <input type="hidden" name="contest_id" value="{{$concurso->id}}">
                        <input type="hidden" value="{{$concurso->cost_per_cpa}}" id="pricePerCpa">
                        @if($postulacion)
                            <input type="hidden" name="cap_id" value="{{$postulacion->id}}">
                        @else
                            <input type="hidden" name="cap_id" value="0">
                        @endif

                        @csrf
                        <div class="concurso__form">
                            @if($form)
                                @include('concursos.form', [
                                        "form" => $form,
                                        "answers" => $answers
                                ])
                            @endif
                            @if($buttons)
                                <div class="form_ctrl">
                                    <div class="input_err">
                                        <div class="label-centers">
                                            <label class="text_medium checkboxes" for="bases">
                                                @if($bases)
                                                    Acepto las <a href="{{url($bases->slug)}}" target="_blank">bases y
                                                        condiciones del
                                                        concurso</a>
                                                @endif
                                                <input type="checkbox" name="bases" id="bases" value="1" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form_ctrl buttons">
                                    <div class="input_err">
                                        <div class="label-centers">
                                            <button class="rounded-save" id="save" name="guardar" value="guardar"
                                                    type="submit">
                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     viewBox="0 0 428.544 428.544"
                                                     style="enable-background:new 0 0 428.544 428.544;"
                                                     xml:space="preserve"><g>
                                                        <g>
                                                            <path d="M416.729,110.592L321.497,5.12C318.425,2.048,314.328,0,309.721,0H23.513C14.809,0,7.64,7.168,7.64,15.872v396.8
                      c0,8.704,7.168,15.872,15.872,15.872h381.44c8.704,0,15.872-7.168,15.872-15.872v-291.84
                      C421.337,116.736,419.289,113.152,416.729,110.592z M88.536,31.232h198.656v70.656H88.536V31.232z M213.977,349.696
                      c-48.64,0-88.064-39.424-88.064-88.064s39.424-88.064,88.064-88.064c48.64,0,88.064,39.424,88.064,88.064
                      S262.617,349.696,213.977,349.696z"/>
                                                        </g>
                                                    </g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g></svg>
                                                Guardar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form_ctrl buttons">
                                    <div class="input_err">
                                        <div class="label-centers">
                                            <button class="rounded-save--yellow" type="submit" name="enviar"
                                                    value="enviar" id="enviar">
                                                Enviar mi postulación
                                            </button>
                                        </div>
                                        <span
                                            class="disclaimer-center">Te costará {{$concurso->cost_per_cpa}} fichas</span>
                                    </div>
                                </div>
                        </div>
                        @endisset
                    </form>
                </article>
            </div>
            <div class="form_ctrl input_" style="margin-top:20px;">
                <div class="align_left btn_noti_ico">
                    <a href="{{url('concursos')}}"
                       class="boton_redondeado btn_transparente"><span class="icon-angle-left"></span>
                        Volver al concurso</a>
                </div>
            </div>
        </div>
    </section>

    <div id="sin_completar" class="modal modal_sincompletar">
        <div class="title_modal">
            <img src="{{url('estilos/front2021/assets/icon_warning.svg')}}"/>
            <h5>Te pedimos que completes algún campo antes de avanzar</h5>
        </div>
    </div>

    <div id="sin_fichas" class="modal modal_sinfichas">
        <div class="title_modal">
            <img src="{{url('estilos/front2021/assets/icon_warning.svg')}}"/>
            <h5>No te alcanzan las Fichas</h5>
        </div>
        <div class="content_modal">
            <p>Hacé una donación para conseguir más.</p>
        </div>
        <div class="align_center">
            <a href="#" onclick="donar()" class="boton_redondeado resaltado_amarillo text_bold width_100">Donar</a>
            <a href="#" rel="modal:close" class="boton_decline width_100">Ahora no</a>
        </div>
    </div>

@endsection

@section('footer')

    @include("fundacion.footer-fundacion")
    <script src="{{url('js/front2021/jquery.modal/jquery.modal.min.js')}}"></script>
    <script type="text/javascript">
        $('#tags').tagsInput({
            width: 'auto',
            'defaultText': '',
            height: 'auto'
        });

        $('.count-words').on('input', function () {
            return ContadorPalabras($(this));
        });

        const form = $('#concursos');
        const pricePerCpa = parseInt($("#pricePerCpa").val());
        const modal = $(".modal_sinfichas");
        const modalSinCompletar = $(".modal_sincompletar");

        function userHasCompletedSomething() {
            const inputs = form.serializeArray();
            const checkeableInputs = inputs.filter(item => item.name.includes('input@'));
            return checkeableInputs.some(item => item.value != '');
        }

        function showFillSomethingModal() {
            modalSinCompletar.modal();
        }

        form.submit(function (event) {
            event.preventDefault();
            if (!userHasCompletedSomething()) {
                showFillSomethingModal();
                return;
            }
            getBalance().then(balance => {
                const enviar = $(document.activeElement).val();
                if (enviar == "guardar" || enviar == "") {
                    event.currentTarget.submit();
                    return;
                }
                if (balance >= pricePerCpa && enviar == "enviar") {
                    console.log("enviando");
                    modal.hide();
                    if (enviar == "enviar") {
                        const input = $("<input>")
                            .attr("type", "hidden")
                            .attr("name", "enviar").val("enviar");
                        form.append(input);
                    }
                    event.currentTarget.submit();
                } else {
                    modal.modal();
                }
            });
        });

        function getBalance() {
            const url = '{{url('my-balance')}}';
            return axios.get(url).then(function (response) {
                return response.data.msg;
            }).catch(error => {
                console.log(error);
            });
        }

        function
        ContadorPalabras($this) {
            var maxWords = $this.data('max');

            if (!$this.val()) {
                wordcount = 0;
            } else {
                wordcount = $this.val().split(/\s+/gi).length;
            }

            count = maxWords - wordcount;

            if (wordcount > maxWords) {
                $this.parent().find('.content-count-words').addClass("error");
            } else {
                $this.parent().find('.content-count-words').removeClass("error");
            }
            return $this.parent().find('.count-words-text').text(count);
        }

        $('.count-characters').on('input', function () {
            return ContadorCaracteres($(this));
        });

        function ContadorCaracteres($this) {
            var maxWords = $this.data('max');
            var wordcount;
            wordcount = $this.val().length;
            if (wordcount > maxWords) {
                $this.parent().find('.content-count-words').addClass("error");
            } else {
                $this.parent().find('.content-count-words').removeClass("error");
            }
            return $this.parent().find('.count-words-text').text(maxWords - wordcount);
        }

        function donar() {
            event.preventDefault();
            const input = $("<input>")
                .attr("type", "hidden")
                .attr("name", "redirect").val("donar");
            form.append(input);
            console.log("donandooooo....");
            $("#save").trigger('click');
        }

    </script>
@endsection
