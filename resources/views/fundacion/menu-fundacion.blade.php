<div class="menu_lateral_izq">
    <nav>
        <ul>
            <li {{($activo=="fundacion")?'class=activo':''}}><a href="{{url('fundacion')}}">Sobre la Fundación</a>
            </li>
            <li {{($activo=="plan")?'class=activo':''}}><a href="{{url('fundacion/plan')}}">Plan a tres años</a></li>
            <li {{($activo=="consejo")?'class=activo':''}}><a href="{{url('fundacion/consejo')}}">Consejo directivo</a></li>
            <li {{($activo=="areas")?'class=activo':''}}><a href="{{url('fundacion/areas')}}">Áreas</a></li>
            <li {{($activo=="donaciones")?'class=activo':''}}><a href="{{url('fundacion/donaciones')}}">Donaciones y fichas</a>
            </li>
            <li {{($activo=="historia")?'class=activo':''}}><a href="{{url('fundacion/historia')}}">Historia</a></li>
        </ul>
    </nav>
</div>
