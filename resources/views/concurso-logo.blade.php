@extends('orsai-template')

@section('title', 'Bases del concurso | Comunidad Orsai')
@section('description', 'Bases del concurso Logo Fundación Orsai')

@section('content') 

    <section id="page" class="contenedor intro_gral ">
      
        <div class="mg_100 cuerpo_texto">  
            <div class="titulo tit_term">
                <h1 class="span_h1">Paso a paso</h1>
                <p>Bases del concurso de logo de la <span class="subrayado">Fundación Orsai</span></p>
            </div>
            <ul id="bases">
                <li>
                    <p class="li_titulo subrayado">Objetivo</p>
                    <p class="li_texto">Crear un logo inédito que identifique a la Fundación Orsai, más conocida con su nombre de fantasía: ComunidadOrsai.org.</p>
                </li>
                <li>
                    <p class="li_titulo subrayado">Extensión de la convocatoria</p>
                    <p class="li_texto">La recepción de trabajos abre el miércoles 14 de octubre y cierra el miércoles 21 de octubre al mediodía de Argentina. Sí señor, con una semana es suficiente (tampoco estamos pidiendo la construcción de un oleoducto).</p>
                </li>
                <li>
                    <p class="li_titulo subrayado">¿Quiénes pueden participar?</p>
                    <p class="li_texto">Podrá participar cualquiera que se haya registrado como miembro de la ComunidadOrsai.org, aunque posiblemente gane gente que haya estudiado diseño o dibujo.</p>
                </li>
                <li>
                    <p class="li_titulo subrayado">Características del logo</p>
                    <p class="li_texto">El logo deberá tener, indistintamente, la palabra Fundación y la palabra Comunidad (nunca ambas a la vez) junto a la marca Orsai. Deberá ser un trabajo original, fácilmente reproducible en cualquier tamaño y deberá conservar su estructura tanto en color como en blanco y negro. Puede incluir un isotipo, aunque no es obligatorio. (Si la palabra «isotipo» les resulta desconocida, o les remite a una testeo hospitalario, no participen de este concurso.)</p>
                </li>
                <li>
                    <p class="li_titulo subrayado">Carga del logo</p>
                    <p class="li_texto">La carga del archivo se realizará desde esta web. les pediremos un título para el logo (sean poéticos), una descripción en menos de 280 caracteres (sean prácticos), una versión del logo negro sobre blanco en formato cuadrado (sean cuáqueros) y una versión oficial en formato JPG o PNG, con resolución a 300 dpi en A4.</p>
                </li>
                <li>
                    <p class="li_titulo subrayado">Presentación física de los trabajos</p>
                    <p class="li_texto">¿WTF? Ni en pedo, estamos en este siglo. Tampoco pediremos que el autor tenga seudónimo, ni tres copias certificadas, ni los obligaremos a que lleven un paquete al correo, ni que sean mayores de edad, ni ninguna otra burocracia.</p>
                </li>
                <li>
                    <p class="li_titulo subrayado">Logo ganador</p>
                    <p class="li_texto">El logo ganador será decidido por ustedes mismos, los socios de la comunidad, que le pondrán fichas a los trabajos presentados, desde esta galería. Podrán apostar hasta el miércoles 28 de octubre al mediodía de Argentina. Obviamente, el logo más fichado será el ganador</p>
                </li>
                <li>
                    <p class="li_titulo subrayado">Premio y reconocimientos</p>
                    <p class="li_texto">El autor o autora del trabajo ganador recibirá como premio nuestro agradecimiento y podrá utilizar esto en su curriculum para tener, en el futuro, mayores oportunidades laborales. No, mentira: por suerte no es un concurso de mierda. El premio será de dos mil dólares (en la moneda de residencia del autor, al cambio oficial de su país ese día) y se pagará el 28 de octubre. ¿El mismo día? Sí. Se pagará exactamente un minuto después de que sea elegido el logo ganador.</p>
                </li>
                <li>
                    <p class="li_titulo subrayado">Casos extraordinarios</p>
                    <p class="li_texto">En caso de que se presente un solo logo, iremos todos a cenar a la casa del autor. En caso de que un autor le ponga fichas a su propio trabajo, sonará una alarma y pondremos la foto del autor en una galería de vanidosos. En caso de que haya empate entre dos logos ganadores, ganará el que tenga los ojos más separados.</p>
                </li>
                <li>
                    <p class="li_titulo subrayado">Dudas y sugerencias</p>
                    <p class="li_texto">Escuchamos dudas, y a veces las respondemos, en los comentarios del posteo en donde anunciamos este concurso.</p>
                </li>
            </ul>
            <p>
                <a href="{{url('postulacion')}}" class="btn_postular_logo">Postulá tu logo &raquo;</a>
            </p>
            <p>
                <a href="{{url('concursos')}}" class="volver">&laquo; Volver al concurso</a>
            </p> 
            
        </div>
    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
</div>

@endsection

@section('footer')

@endsection
