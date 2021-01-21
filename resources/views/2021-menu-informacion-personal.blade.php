<div class="menu_lateral">
    <div id="menu_miperfil">
        <ul id="ul_menu">
            <li><a href="{{url('perfil')}}" {{($activo=="perfil")?'class=active_menu_lateral':''}}>Mi perfil</a></li>
            <li><a href="{{url('redes-sociales')}}" {{($activo=="redes-sociales")?'class=active_menu_lateral':''}}>Redes sociales</a></li>
            <li><a href="{{url('seguridad')}}" {{($activo=="seguridad")?'class=active_menu_lateral':''}}>Seguridad</a></li>
            <li><a href="{{url('formacion-y-experiencia')}}" {{($activo=="formacion-y-experiencia")?'class=active_menu_lateral':''}}>Formación y experiencia</a></li>
        </ul>
    </div>
</div>