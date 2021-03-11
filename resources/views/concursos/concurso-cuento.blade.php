@extends('2021-orsai-template')

@section('title', 'Linea de tiempo Orsai | Comunidad Orsai')
@section('description','Linea de tiempo Orsai | Comunidad Orsai')


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
                        @csrf
                        <div class="concurso__form">
                            @if($form)
                                @include('concursos.form', $form)
                            @endif
                            <div class="form_ctrl">
                                <div class="input_err">
                                    <div class="label-centers">
                                        <label class="text_medium checkboxes" for="bases">
                                            @if($bases)
                                                Acepto las <a href="{{url($bases->slug)}}" target="_blank">bases del
                                                    concurso</a>
                                            @endif
                                            <input type="checkbox" name="bases" id="bases">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form_ctrl buttons">
                                <div class="input_err">
                                    <div class="label-centers">
                                        <button class="rounded-save" id="save">
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
                                        <button class="rounded-save--yellow" type="submit">Enviar mi postulación
                                        </button>
                                    </div>
                                    <span class="disclaimer-center">Te costará {{$concurso->cost_per_cpa}} fichas</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </article>
            </div>
            <div class="concurso-footer">
                <a href="{{url('concursos/')}}" class="btn-back">Volver</a>
            </div>
        </div>
    </section>
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <p>Some text in the Modal..</p>
        </div>
    </div>
@endsection

@section('footer')
    @include("fundacion.footer-fundacion")
    <script type="text/javascript">
        $(function () {

            $('#tags').tagsInput({
                width: 'auto',
                'defaultText': '',
                height: 'auto'
            });


            var modal = document.getElementById("modal");

            // Get the button that opens the modal
            var btn = document.getElementById("save");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close-modal")[0];

            // When the user clicks on the button, open the modal
            btn.onclick = function (event) {
                event.preventDefault();
                modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function () {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

        });

        $('.count-words').keypress(function () {
            var maxWords = $(this).data('max');
            var $this, wordcount;
            $this = $(this);
            wordcount = $this.val().split(/\b[\s,\.-:;]*/).length;
            if (wordcount > maxWords) {
                $this.parent().find('.count-words-text').text(0);
                alert("Alcanzaste el máximo de palabras permitidas.");
                return false;
            } else {
                return $this.parent().find('.count-words-text').text(maxWords - wordcount);
            }
        });

        $('.count-words').change(function () {
            var maxWords = $(this).data('max');
            var words = $(this).val().split(/\b[\s,\.-:;]*/);
            if (words.length > maxWords) {
                var cut = $(this).val().split(" ").splice(0, maxWords).join(" ");
                $(this).val(cut);
                alert("Alcanzaste el máximo de palabras permitidas. Se removerán las palabras o espacios extras.");
            }
        });


        $('.count-characters').on('keypress', function () {
            var maxWords = $(this).data('max');
            var $this, wordcount;
            $this = $(this);
            wordcount = $(this).val().length;
            if (wordcount > maxWords) {
                $this.parent().find('.count-words-text').text(0);
                alert("Alcanzaste el máximo de caracteres permitidos.");
                return false;
            } else {
                return $this.parent().find('.count-words-text').text(maxWords - wordcount);
            }
        });

        $('.count-characters').change(function () {
            var maxWords = $(this).data('max');
            if ($(this).val().length > maxWords) {
                var cut = $(this).val().substring(0, maxWords);
                $(this).val(cut);
                alert("Alcanzaste el máximo de palabras permitidas. Se removerán las palabras o espacios extras.");
            }
        });
    </script>
@endsection
