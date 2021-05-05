<div class="selecc_fichas"> 
    @if($fichasApostadas == $currentRonda->cost)
    <p>Ya apostaste el máximo de fichas</p>
    @else
    <p>Ponele fichas</p>
    @endif
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
    @if($fichasApostadas != $currentRonda->cost)
    <div class="form_ctrl input_">
        <div class="align_center">
            <button class="boton_redondeado resaltado_amarillo width_100" onclick="apostar()"
                    data-cap_id="{{$cpa->id}}">Apostar
            </button>
        </div>
    </div>
    @endif
</div>
