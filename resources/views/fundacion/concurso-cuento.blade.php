@extends('2021-orsai-template')

@section('title', 'Linea de tiempo Orsai | Comunidad Orsai')
@section('description','Linea de tiempo Orsai | Comunidad Orsai')


@section('content')

<section class="resaltado_gris">
  <div class="contenedor_interna concurso">
    <div class="cuerpo_interna">  
      <article>
        <p class="inscripcion">Incripción</p>
        <h2 class="title">CONCURSO INTERNACIONAL DE CUENTO CORTO CON JURADO POPULAR Y PREMIO INCALCULABLE EN DÓLARES</h2>
        <p class="nota">¡No te estreses! Tomate el tiempo para completar el formulario. Vas a poder editarlo cuantas veces quieras con el botón GUARDAR. Solo cuando creas que ya está listo usá el botón ENVIAR. Pero tampoco te cuelgues, recordá que podés enviar tu cuento hasta el 1 de abril a la medianoche de Argentina.</p>
        <hr>
        <form action="#!" method="POST">
          <div class="concurso__form">
            <div class="form_ctrl">
              <div class="input_err">
                <div class="label-two-columns">
                  <div class="left">
                    <label class="text_medium" for="motivo">Leit motiv</label>
                    <span class="disclaimer">Si tuvieras que vendernos tu cuento en una frase corta, ¿qué pondrías?</span>
                  </div>
                  <div class="right">
                    <a href="#!" target="_blank">Ver tutorial</a>
                  </div>
                </div>
                <div class="content-input">
                  <input type="text" name="motivo" id="motivo" class="count-words" data-max="12" placeholder="[TEXTO]">
                  <div class="content-count-words">Te quedan <span class="count-words-text"> 12 </span> palabras</div>
                </div>
              </div>
            </div> 
            <div class="form_ctrl">
              <div class="input_err">
                <div class="label-two-columns">
                  <div class="left">
                    <label class="text_medium" for="descripcion">Descripción</label>
                    <span class="disclaimer">Explicá tu cuento en un tuit, pero sin espoilers.</span>
                  </div>
                  <div class="right">
                    <a href="#!" target="_blank">Ver tutorial</a>
                  </div>
                </div>
                <div class="content-input">
                  <textarea name="descripcion" id="descripcion" class="count-characters" data-max="280" cols="30" rows="10" placeholder="[PÁRRAFO]"></textarea>
                  <div class="content-count-words">Te quedan <span class="count-words-text"> 280 </span> caracteres</div>
                </div>
              </div>
            </div>
            <div class="form_ctrl">
              <div class="input_err">
                <div class="label-two-columns">
                  <div class="left">
                    <label class="text_medium" for="tags">Nube de tags</label>
                    <span class="disclaimer">Agregá hasta cinco palabras que orienten tu historia.</span>
                  </div>
                  <div class="right">
                    <a href="#!" target="_blank">Ver tutorial</a>
                  </div>
                </div>
                <div class="content-input">
                  <input type="text" name="tags" id="tags" class="tags">
                  <div class="content-count-words">Separá las palabras con comas</div>
                </div>
              </div>
            </div> 
            <div class="form_ctrl">
              <div class="input_err">
                <div class="label-two-columns">
                  <div class="left">
                    <label class="text_medium" for="categoria">Categoría</label>
                    <span class="disclaimer">Ayudá a que el jurado encuentre tu cuento por tema.</span>
                  </div>
                  <div class="right">
                    <a href="#!" target="_blank">Ver tutorial</a>
                  </div>
                </div>
                <div class="content-input">
                  <select name="categoria" id="categoria">
                    <option value="" selected="true" disabled="disabled">Elegir</option>
                    <option value="">Opcion 1</option>
                    <option value="">Opcion 2</option>
                    <option value="">Opcion 3</option>
                  </select>
                  <div class="content-count-words">Separá las palabras con comas</div>
                </div>
              </div>
            </div>
            <div class="form_ctrl">
              <div class="input_err">
                <div class="label-two-columns">
                  <div class="left">
                    <label class="text_medium" for="motivo">Título del cuento</label>
                    <span class="disclaimer">Acá te dejamos a solas (que la inspiración te ayude).</span>
                  </div>
                  <div class="right">
                    <a href="#!" target="_blank">Ver tutorial</a>
                  </div>
                </div>
                <div class="content-input">
                  <input type="text" name="motivo" id="motivo" class="count-characters" data-max="72" placeholder="[TEXTO]">
                  <div class="content-count-words">Te quedan <span class="count-words-text"> 72 </span> caracteres</div>
                </div>
              </div>
            </div> 
            <div class="form_ctrl">
              <div class="input_err">
                <div class="label-two-columns">
                  <div class="left">
                    <label class="text_medium" for="cuento">El cuento</label>
                    <span class="disclaimer">No permitimos estilos ni HTML para que no te distraigas.</span>
                  </div>
                </div>
                <div class="content-input">
                  <textarea name="cuento" id="cuento" cols="30" rows="20" class="count-words" data-max="600" placeholder="[PÁRRAFO]"></textarea>
                  <div class="content-count-words">Te quedan <span class="count-words-text"> 600 </span> palabras</div>
                </div>
              </div>
            </div>
            <div class="form_ctrl">
              <div class="input_err">
                <div class="label-centers">
                  <label class="text_medium checkboxes" for="bases">
                    Acepto las <a href="#!" target="_blank">bases del concurso</a>
                    <input type="checkbox" name="bases" id="bases">
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="form_ctrl buttons">
              <div class="input_err">
                <div class="label-centers">
                  <button class="rounded-save">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 428.544 428.544" style="enable-background:new 0 0 428.544 428.544;" xml:space="preserve"><g><g><path d="M416.729,110.592L321.497,5.12C318.425,2.048,314.328,0,309.721,0H23.513C14.809,0,7.64,7.168,7.64,15.872v396.8
                      c0,8.704,7.168,15.872,15.872,15.872h381.44c8.704,0,15.872-7.168,15.872-15.872v-291.84
                      C421.337,116.736,419.289,113.152,416.729,110.592z M88.536,31.232h198.656v70.656H88.536V31.232z M213.977,349.696
                      c-48.64,0-88.064-39.424-88.064-88.064s39.424-88.064,88.064-88.064c48.64,0,88.064,39.424,88.064,88.064
                      S262.617,349.696,213.977,349.696z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                    Guardar
                  </button>
                </div>
              </div>
            </div>
            <div class="form_ctrl buttons">
              <div class="input_err">
                <div class="label-centers">
                  <button class="rounded-save--yellow" type="submit">Enviar mi postulación</button>
                </div>
                <span class="disclaimer-center">Te costará 5 fichas</span>
              </div>
            </div>
          </div>
        </form>
      </article>
    </div>
    <div class="concurso-footer">
      <a href="#!" class="btn-back">Volver</a>
    </div>
  </div>
</section>
@endsection
 
@section('footer')
  @include("fundacion.footer-fundacion")
  <script type="text/javascript">
    $(function() {

      $('#tags').tagsInput({
        width:'auto',
        'defaultText':'',
        height: 'auto'
      });
    });

    $('.count-words').keypress(function() {
      var maxWords = $(this).data('max');
      var $this, wordcount;
      $this = $(this);
      wordcount = $this.val().split(/\b[\s,\.-:;]*/).length;
      if (wordcount > maxWords) {
        $this.parent().find('.count-words-text').text(0);
        alert("Alcanzaste el máximo de palabras permitidas.");
        return false;
      }
      else {
        return $this.parent().find('.count-words-text').text(maxWords - wordcount);
      }
    });

    $('.count-words').change(function() {
      var maxWords = $(this).data('max');
      var words = $(this).val().split(/\b[\s,\.-:;]*/);
      if (words.length > maxWords) {
        var cut = $(this).val().split(" ").splice(0,maxWords).join(" ");
        $(this).val(cut);
        alert("Alcanzaste el máximo de palabras permitidas. Se removerán las palabras o espacios extras.");
      }
    });


    $('.count-characters').on('keypress', function() {
      var maxWords = $(this).data('max');
      var $this, wordcount;
      $this = $(this);
      wordcount = $(this).val().length;
      if (wordcount > maxWords) {
        $this.parent().find('.count-words-text').text(0);
        alert("Alcanzaste el máximo de caracteres permitidos.");
        return false;
      }
      else {
        return $this.parent().find('.count-words-text').text(maxWords - wordcount);
      }
    });

    $('.count-characters').change(function() {
      var maxWords = $(this).data('max');
      if ($(this).val().length > maxWords) {
        var cut = $(this).val().substring(0,maxWords);
        $(this).val(cut);
        alert("Alcanzaste el máximo de palabras permitidas. Se removerán las palabras o espacios extras.");
      }
    });
  </script>
@endsection