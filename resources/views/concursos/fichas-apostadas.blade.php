<div class="selecc_fichas">
    <p>Elegí la cantidad de fichas</p>
    <div class="fichas_">
        @for($i=0;$i < $fichasApostadas; $i++)
            <div class="fichin apostado">
                <span class="icon-ficha"></span>
            </div>
        @endfor
        @for($i=0;$i < $currentRonda->cost - $fichasApostadas; $i++)
            <div class="fichin">
                <span class="icon-ficha"></span>
            </div>
        @endfor
    </div>
    <div class="form_ctrl input_">
        <div class="align_center">
            <button class="boton_redondeado resaltado_amarillo width_100" onclick="apostar()"
                    data-cap_id="{{$cpa->id}}">Apostar
            </button>
        </div>
    </div>
</div>
