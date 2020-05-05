<div class="menu_lateral_izq">
    <nav>
        <ul>
            <li {{($activo=="fundacion")?'class=activo':''}}><a href="{{url('fundacion-orsai')}}">Sobre la Fundación</a>
            </li>
            <li {{($activo=="plan")?'class=activo':''}}><a href="{{url('plan')}}">Plan a tres años</a></li>
            <li {{($activo=="consejo")?'class=activo':''}}><a href="{{url('consejo')}}">Consejo directivo</a></li>
            <li {{($activo=="areas")?'class=activo':''}}><a href="{{url('areas')}}">Áreas</a></li>
            <li {{($activo=="donaciones")?'class=activo':''}}><a href="{{url('donaciones')}}">Donaciones y fichas</a>
            </li>
            <li {{($activo=="historia")?'class=activo':''}}><a href="{{url('historia')}}">Historia</a></li>
        </ul>
    </nav>
</div>
