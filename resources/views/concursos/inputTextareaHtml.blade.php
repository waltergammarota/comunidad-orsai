<div class="form_ctrl">
    <div class="input_err">
        <div class="label-two-columns-flex">
            <label class="text_medium" for="cuento">{{$title}}</label>
            @if($tutorial != "")
                <a class="btn_tutorial" href="#videotutorial-{{$id}}" rel="modal:open">Ver
                    tutorial</a>
            @endif
            <span class="disclaimer">{{$description}}</span>
        </div>
        <div class="content-input">
                                        <textarea name="{{$inputName}}" id="{{$inputName}}" cols="{{$cols}}"
                                                  rows="{{$rows}}"
                                                  class="{{$counterClass}}"
                                                  data-max="{{$counter_max}}"
                                                  placeholder="{{$placeholder}}">{{$value}}</textarea>
            <div class="content-count-words">Te quedan <span
                    class="count-words-text"> {{$counter_max}} </span> {{$palabras}}
            </div>
        </div>
    </div>
</div>

@if($tutorial != "")
    <div id="videotutorial-{{$id}}" class="modal videotutorial">
        <iframe width="800" height="600" src="{{$tutorial}}" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
    </div>
@endif
