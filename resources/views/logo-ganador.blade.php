@extends('orsai-template')

@section('title', 'Ganador | Comunidad Orsai')
@section('description', 'Ganador de concurso')

@section('content')
    <section id="intro" class="contenedor intro_gral concurso_ganador">
        <div class="titulo">
            <h1 class="span_h1">Nuevo logo de ComunidadOrsai.org, la primera gran apuesta de la fase beta</h1>
            <p class="texto"><strong>Una lavada de cara.</strong> Les presentamos en sociedad el <strong>logo que identificará a la web de la Comunidad Orsai</strong> de ahora en más. A partir de hoy podemos mostrar una imagen (un poquito) más respetable ante el mundo.</p>
            <p class="texto">Este es el logo que la comunidad eligió:</p>
        </div>
        <div id="logo_concurso_ganador">
            <div id="logo_lg_ganador">
                <img src="{{$logo}}" alt="Imagen Logo large">
            </div>
        </div>
        <div id="cv_concurso_ganador">
            <div class="datos_pcpales">
                <div id="user_img">
                    <img src="{{$avatar}}" alt="Imagen usuario">
                </div>
                <div id="user_alias">
                    <span class="text_bold">{{$userName}}</span>
                </div>
                <div id="fichas_asignadas">
                    <div>
                        <span class="fichas_finales">{{$votes}}</span>
                        <span>Fichas</span>
                    </div>
{{--                    TODO IMPLEMENTAR LISTA YA EXISTE VARIABLE TXS CON 10 EN RANDOM--}}
{{--                    <span id="btn_ver_quien" class="resaltado_amarillo">Ver</span>--}}
                </div>
            </div>
            <div class="datos_contacto">
                <div>
                    <ul>
                        <li><strong>Nombre: </strong><span>{{$name}}</span></li>
                        <li><strong>Apellido: </strong><span>{{$lastName}}</span></li>
                        <li><strong>País: </strong><span>{{$country}}</span></li>
                    </ul>
                </div>
                <div>
                    <ul>
                        <li><strong>Facebook: </strong><span class="subrayado">{{$facebook}}</span></li>
                        <li><strong>Instagram: </strong><span class="subrayado">{{$instagram}}</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="line_dashed"></div>
    </section>

    <section id="what_next" class="contenedor">
        <div class="next_preview">
            <p class="span_block"><strong>Agradecemos</strong> a {{$name}} {{$lastName}} y al resto de los postulantes que llevaron sus neuronas al extremo poniendo su arte al servicio de esta comunidad. A todos los socios que apostaron y fueron fundamentales para que todo esto pasara en el <strong>primer Concurso de la Fundación Orsai</strong>. </p>
            <ul>
                <li>{{$totalesPresentados}} logos presentados</li>
                <li>{{$totalSociosApostadores}} socios apostaron</li>
                <li>{{$totalDeFichasEnJuego}} fichas en juego</li>
            </ul>
            <p><strong>No hay premio consuelo.</strong> Si bien la plata ya fue transferida al ganador, todas las obras merecen ser apreciadas. Vayan a dar una vuelta por este museo virtual que las aloja y contemplen el arte en su sentido más puro.</p>
            <a href="{{url('concursos')}}" class="subrayado resaltado_amarillo">Ir a galería</a>
        </div>
    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
@endsection

@section('footer')

@endsection
