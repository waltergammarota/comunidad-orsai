@extends('orsai-template')

@section('title', 'Ganador')

@section('content')
    <section id="intro" class="contenedor intro_gral ganador">
        <div class="titulo">
            <h1 class="">Habemus logo</h1>
            <span class="span_block">Este es el veridicto final del jurado popular. Agradecemos a todos los diseñadores que quemaron sus neuronas para crear una imagen que identifique a la Fundación Orsai.</span>
        </div>
        <div id="logo_ganador">
            <div id="logo_lg_ganador">
                <img src="{{$logo}}" alt="Imagen Logo large">
            </div>
        </div>
        <div id="cv_ganador">
            <div class="datos_pcpales">
                <div id="user_img">
                    <img src="{{$avatar}}" alt="Imagen usuario">
                </div>
                <div id="user_alias">
                    <span class="text_bold">{{$userName}}</span>
                </div>
                <div id="fichas_asignadas">
                    <div>
                        <span>Fichas asignadas:</span>
                        <span class="resaltado_amarillo">{{$votes}}</span>
                    </div>
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
            <h2>Y ahora... ¿qué sigue?</h2>
            <p class="span_block">Para subsistir el proyecto de la <strong class="subrayado resaltado_amarillo text_regular">Fundación Orsai</strong> requerirá la colaboración de toda la comunidad. Necesitamos un séquito de creativos solidarios que nos acompañen para seguir contando buenas historias. <strong>Si querés saber más de lo que viene ¡unite!</strong></p>
        </div>
        <div class="next_join">
            <h3 class="text_bold">¿Querés ser parte del juego?</h3>
            <a href="#" target="_blank" class="subrayado resaltado_amarillo text_bold">Empezar a jugar</a>
        </div>
    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
@endsection

@section('footer')

@endsection
