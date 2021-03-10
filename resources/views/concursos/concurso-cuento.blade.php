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
        <p class="nota"><strong>¡No te estreses!</strong> Tomate el tiempo para completar el formulario. Vas a poder editarlo cuantas veces quieras con el botón GUARDAR. Solo cuando creas que ya está listo usá el botón ENVIAR. <strong>Pero tampoco te cuelgues</strong>, recordá que podés enviar tu cuento hasta el 1 de abril a la medianoche de Argentina.</p>
        <hr>
        <form action="#!">
          <div class="concurso__form">
            <div class="form_ctrl">
              <div class="input_err">
                <div class="label-two-columns-flex"> 
                    <label class="text_medium" for="motivo">Leit motiv</label>
                    <a class="btn_tutorial" href="#videotutorial-1" rel="modal:open">Ver tutorial</a> 
                    <span class="disclaimer">Si tuvieras que vendernos tu cuento en una frase corta, ¿qué pondrías?</span> 
                </div>
                <div class="content-input">
                  <input type="text" name="motivo" id="motivo" value="" class="count-words" data-max="12" placeholder="[TEXTO]">
                  <div class="content-count-words">Te quedan <span class="count-words-text"> 12  </span> palabras</div>
                </div>
              </div>
            </div>  
            <div class="form_ctrl">
              <div class="input_err">
                <div class="label-two-columns-flex"> 
                    <label class="text_medium" for="descripcion">Descripción</label>
                    <a href="#!" class="btn_tutorial" target="_blank">Ver tutorial</a>
                    <span class="disclaimer">Explicá tu cuento en un tuit, pero sin espoilers.</span>  
                </div>
                <div class="content-input">
                  <textarea name="descripcion" id="descripcion" class="count-characters" data-max="280" cols="30" rows="10" placeholder="[PÁRRAFO]"></textarea>
                  <div class="content-count-words">Te quedan <span class="count-words-text"> 280 </span> caracteres</div>
                </div>
              </div>
            </div>
            <div class="form_ctrl">
              <div class="input_err">
                <div class="label-two-columns-flex"> 
                    <label class="text_medium" for="tags">Nube de tags</label>
                    <a href="#!" class="btn_tutorial" target="_blank">Ver tutorial</a> 
                    <span class="disclaimer">Agregá hasta cinco palabras que orienten tu historia.</span> 
                </div>
                <div class="content-input">
                  <input type="text" name="tags" id="tags" class="tags">
                  <div class="content-count-words">Separá las palabras con comas</div>
                </div>
              </div>
            </div> 
            <div class="form_ctrl">
              <div class="input_err">
                <div class="label-two-columns-flex"> 
                    <label class="text_medium" for="categoria">Categoría</label>
                    <a href="#!" class="btn_tutorial" target="_blank">Ver tutorial</a> 
                    <span class="disclaimer">Ayudá a que el jurado encuentre tu cuento por tema.</span> 
                </div>
                <div class="content-input">
                  <select name="categoria" id="categoria">
                    <option value="" selected="true" disabled="disabled">Elegir</option>
                    <option value="">Opcion 1</option>
                    <option value="">Opcion 2</option>
                    <option value="">Opcion 3</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form_ctrl">
              <div class="input_err">
                <div class="label-two-columns-flex"> 
                    <label class="text_medium" for="motivo">Título del cuento</label>
                    <a href="#!" class="btn_tutorial" target="_blank">Ver tutorial</a>
                    <span class="disclaimer">Acá te dejamos a solas (que la inspiración te ayude).</span>  
                </div>
                <div class="content-input">
                  <input type="text" name="motivo" id="motivo" class="count-characters" data-max="72" placeholder="[TEXTO]">
                  <div class="content-count-words">Te quedan <span class="count-words-text"> 72 </span> caracteres</div>
                </div>
              </div>
            </div> 
            <div class="form_ctrl">
              <div class="input_err">
                <div class="label-two-columns-flex"> 
                    <label class="text_medium" for="cuento">El cuento</label>
                    <a href="#!" class="btn_tutorial" target="_blank">Ver tutorial</a>
                    <span class="disclaimer">No permitimos estilos ni HTML para que no te distraigas.</span> 
                </div>
                <div class="content-input">
                  <textarea name="cuento" id="cuento" cols="30" rows="20" class="count-words" data-max="600" placeholder="[PÁRRAFO]"></textarea>
                  <div class="content-count-words">Te quedan <span class="count-words-text"> 600 </span> palabras</div>
                </div>
              </div>
            </div><div class="form_ctrl input_">
              <div class="align_center">
              <div class="input_err">
                  <div id="check_div" class="input_err obligatorio">
                      <label class="checkbox-container letra_chica">
                          Acepto las <a href="https://comunidadorsai.org/terminos-y-condiciones" target="_blank" rel="noopener noreferrer" class="subrayado">Bases del concurso</a>. 
                 <input type="checkbox" id="cbox1" name="terminos" class="check_cond" value="1">
                          <span class="crear_check"></span> 
                      </label>
                  </div>
                                      </div>
              </div>
          </div> 
            <div class="form_ctrl buttons">
              <div class="input_err">
                <div class="label-centers">
                  <button class="rounded-save" id="save">
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
                  <a class="rounded-save--yellow" href="#sin_fichas" rel="modal:open">Enviar mi postulación</a> 
                </div>
                <span class="disclaimer-center">Te costará 5 fichas</span>
              </div>
            </div>
          </div>
        </form>
      </article>
    </div> 
    <div class="form_ctrl input_" style="margin-top:20px;">
      <div class="align_left btn_noti_ico">
          <a href="#" class="boton_redondeado btn_transparente"><span class="icon-angle-left"></span> Volver</a>
      </div>
  </div>
  </div>
</section>  
<div id="sin_fichas" class="modal modal_sinfichas"> 
  <div class="title_modal">
    <img src="{{url('estilos/front2021/assets/icon_warning.svg')}}"  />
    <h5>No te alcanzan las Fichas</h5>
  </div>
  <div class="content_modal">
    <p>Hacé una donación para conseguir más.</p> 
  </div>
  <div class="align_center">
    <a href="{{url('donar')}}" class="boton_redondeado resaltado_amarillo text_bold width_100">Donar</a>
    <a href="#" rel="modal:close" class="boton_decline width_100">Ahora no</a> 
  </div>
</div>
<div id="videotutorial-1" class="modal videotutorial">
  <iframe width="800" height="600" src="https://www.youtube.com/embed/l1KAWIsilM4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>

@endsection
 
@section('footer')
  @include("fundacion.footer-fundacion") 
  <script src="{{url('js/front2021/jquery.modal/jquery.modal.min.js')}}"></script>
  <script type="text/javascript"> 
    $('#tags').tagsInput({
      width:'auto',
      'defaultText':'',
      height: 'auto'
    });
  
    $('.count-words').on('input',function() { 
      return ContadorPalabras($(this));
    }); 
    
    //uno dos tres cuatro cinco seis siete ocho nueve diez once doce trece

    function ContadorPalabras($this){  
      var maxWords = $this.data('max');  
       
      if( !$this.val() ) { 
        wordcount = 0; 
      }else{ 
        wordcount = $this.val().split(/\s+/gi).length; 
      }

      count = maxWords - wordcount;
      
      if (wordcount > maxWords) {
        $this.parent().find('.content-count-words').addClass("error");
      }else{
        $this.parent().find('.content-count-words').removeClass("error");
      } 
      return $this.parent().find('.count-words-text').text(count); 
    } 

    $('.count-characters').on('input', function() {
      return ContadorCaracteres($(this));
    });

    function ContadorCaracteres($this){
      var maxWords = $this.data('max');
      var wordcount; 
      wordcount = $this.val().length;
      if (wordcount > maxWords) {
        $this.parent().find('.content-count-words').addClass("error");
      }else {
        $this.parent().find('.content-count-words').removeClass("error");
      }
      return $this.parent().find('.count-words-text').text(maxWords - wordcount);
    } 
 
  </script>
@endsection