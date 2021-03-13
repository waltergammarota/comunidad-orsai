<div class="form_ctrl">
    <div class="input_err">
        <div class="label-two-columns-flex">
            <label class="text_medium" for="tags">{{$title}}</label>
            @if($tutorial != "")
                <a class="btn_tutorial" href="#videotutorial-{{$id}}" rel="modal:open">Ver
                    tutorial</a>
            @endif
            <span
                class="disclaimer">{{$description}}</span>
        </div>
        <div class="content-input">
            <input type="text" name="{{$inputName}}" id="tags" class="tags"
                   value="{{old($inputName)? old($inputName): $value}}"
                   data-max="{{$counter_max}}">
            <div class="content-count-words">Separá las palabras con comas</div>
        </div>
    </div>
    @error($inputName) {{$message}} @enderror
</div>

@if($tutorial != "")
    <div id="videotutorial-{{$id}}" class="modal videotutorial">
        <iframe width="800" height="600" src="{{$tutorial}}" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
    </div>
@endif
