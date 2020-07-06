@extends('orsai-template')

@section('title', 'Bases del concurso | Fundación Orsai')
@section('description', 'Bases del concurso Logo Fundación Orsai')

@section('content')

    <section id="intro" class="contenedor intro_gral">
        <div class="grid_70">
            <span class="span_h1">Paso a paso</span>
            <h1>Bases del concurso de logo de la <span class="subrayado">Fundación Orsai</span></h1>
        </div>
    </section>

    <section class="contenedor">
        <div class="grid_70 mg_100">
            <ul id="bases">
                <li>
                    <p class="li_titulo subrayado">Objetivo</p>
                    <p class="li_texto">Crear un logotipo inédito que   identifique a la flamante Fundación Orsai.</p>
                </li>
                <li>
                    <p class="li_titulo subrayado">Inicio de la convocatoria</p>
                    <p class="li_texto">La recepción de trabajos ya está abierta    y cierra el 15 de abril.</p>
                </li>
                <li>
                    <p class="li_titulo subrayado">¿Quiénes pueden participar?</p>
                    <p class="li_texto">Cualquiera que se haya registrado como  miembro de la fundación Orsai, aunque posiblemente gane  alguien que haya estudiado diseño o dibujo.</p>
                </li>
                <li>
                    <p class="li_titulo subrayado">Caracteristicas del logo</p>
                    <p class="li_texto">Deberá ser un trabajo original(<sup>*</sup>), fácilmente reproducible en cualquier tamaño y deberá  conservar su estructura tanto en color como en blanco y  negro.</p>
                    <p class="li_aclara">(<sup>*</sup>) Obviamente, usaremos una    aplicación gratuita que avisa de plagios, y seria muy  vergonzoso tener que señalar a alguien con el dedo del   aprobio.</p>
                </li>
                <li>
                    <p class="li_titulo subrayado">Presentación del logo</p>
                    <p class="li_texto">La presentación se realizará desde  nuestra plataforma de carga, en la que pedimos un título de  fantasía para el logo (sean poéticos), una descripción en    280 caracteres (sean prácticos), una versión del logo negro    sobre blanco en formato cuadrado (sean cuáqueros) y una    versión oficial(<sup>*</sup>) en formato JPG, BMP, TIFF, GIF   o PNG, con resolución a 300 dpi en A4.</p>
                </li>
                <li>
                    <p class="li_titulo subrayado">Presentación física de los   trabajos</p>
                    <p class="li_texto">Ni en pedo, por suerte tenemos wi-fi.   Tampoco pediremos que el autor tenga seudónimo, ni tres   copias certificadas, ni te obligaremos a que lleves un    paquete al correo, ni ninguna otra burocracia de gente     aburrida.</p>
                </li>
                <li>
                    <p class="li_titulo subrayado">Elección del logo ganador</p>
                    <p class="li_texto">El logotipo ganador será decidido por la    comunidad de la Fundación Orsai a pleno. Todos los miembros    registrados podrán <a href="{{url('donaciones')}}" class="subrayado resaltado_amarillo">&#x000AB;ponerle fichas&#x000BB;</a> a los  logotipos presentados, desde el 1 de abril a las 00:01 y     hasta el 29 de abril a las 23:59(<sup>*</sup>). El logotipo     más fichado será el ganador. Un minuto después, la web de   Fundación Orsai tendrá &#x02500;por fin&#x02500; una  identidad.</p>
                </li>
                <li>
                    <p class="li_titulo subrayado">Premio y reconocimientos</p>
                    <p class="li_texto">El autor del trabajo ganador recibirá   como premio ser el autor del logo de la Fundación Orsai y     podrá utilizar esto en su curriculum para tener, en el  futuro, mayores oportunidades laborales.</p>
                    <p class="li_texto">No, mentira: por suerte no es un    concurso de mierda.</p>
                    <p class="li_texto">El premio serán mil quinientos dólares  (en la moneda de residencia del autor, y al cambio oficial   de su país ese día) y se pagarán el 30 de abril a las 00:01,  exactamente un minuto después de que sea elegido el logo ganador.</p>
                </li>
            </ul>
            <a href="{{url('postulacion')}}" class="btn_postular_logo">Postulá tu logo &raquo;</a>
        </div>
    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
</div>

@endsection

@section('footer')

@endsection
