<div class="form_ctrl">
    <div class="input_err">
        <div class="label-two-columns-flex">
            <label class="text_medium" for="categoria">{{$title}}</label>
            @if($tutorial != "")
                <a class="btn_tutorial" href="#videotutorial-{{$id}}" rel="modal:open">Ver
                    tutorial</a>
            @endif
            <span
                class="disclaimer">{{$description}}</span>
        </div>
        <div class="content-input">
            <select name="{{$inputName}}" id="{{$inputName}}">
                <option value="" selected="true" disabled="disabled">Elegir</option>
                @foreach($options as $option)
                    @if($option == $value)
                        <option value="{{$option}}" selected>{{$option}}</option>
                    @else
                        <option value="{{$option}}">{{$option}}</option>
                    @endif
                @endforeach
            </select>
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
