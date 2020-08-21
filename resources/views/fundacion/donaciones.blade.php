@extends('orsai-template')

@section('title', 'Donaciones | Fundación Orsai')
@section('description','Donaciones | Fundación Orsai')


@section('content')
    <section class="contenedor sobre_fundacion">
        @include('fundacion.menu-fundacion',["activo" => "donaciones"])
        <div class="contenido_menu_lateral_dcha">
            <h1>Fundación Orsai</h1>
            <article id="donaciones">
                <h2>#Donaciones y fichas</h2>
                <p>La <strong>Fundación Orsai</strong> recibe donaciones de la comunidad para premiar proyectos, becar
                    estudiantes y financiar investigaciones sobre una disciplina única: <u>la narrativa</u>.</p>
                <p><strong>Todo funciona como un juego.</strong> Vos donás dinero a la Fundación y a cambio recibís
                    fichas que podés apostar en concursos donde sos el jurado. Así se genera un pozo que crece en tiempo
                    real. Ese &laquo;pozo&raquo;es dinero en metálico que luego recibe el proyecto mejor valorado.</p>
                <p>La Fundación no tiene jurados propios ni toma decisiones a dedo: sos vos quien &laquo;le pone fichas&raquo;
                    a los proyectos que más te gusten. <strong>Orsai únicamente vigila que todo salga bien.</strong></p>
                <p><strong>Por ejemplo:</strong> podés ponerle fichas a estudiantes que no llegan a pagar su posgrado, a
                    trabajos de investigación demasiado costosos, a ideas de novela que necesitan tiempo, a cuentistas
                    inéditos que quieren publicar su libro, a guiones de cine o teatro, a podcasts semanales... Todo
                    ocurre de una forma tan transparente que parece un reality.</p>
                <p>También podés usar tus fichas para recibir <strong>streaming en directo</strong> de cursos,
                    conferencias y espectáculos culturales producidos con las donaciones.</p><br/><br/>
                <h3>Conseguir fichas sin donar</h3>
                <p>En esta primera etapa, solo tenés que completar tu <a href="{{url('registrarse')}}" class="resaltado_amarillo">completar
                        tu membresía</a> las primeras setecientos cincuenta (750) fichas gratis. Una vez adentro, <strong>empezá a
                        apostar fuerte a la Fundación.</strong></p>
                <p>Durante 2020 tendremos varios concursos. Abrimos el juego
                    con uno que no requiere de tu dinero real. Para empezar, la Fundación necesita un logo, una
                    identidad que la defina. Por eso muchos diseñadores están <a href="{{url('postulacion')}}" class="resaltado_amarillo">presentando
                        propuestas</a>. Desde ahora mismo, podés espiar los bocetos, uno por uno, y &laquo;ponerle
                    fichas&raquo; al logo que nos acompañará durante los próximos veinte años.</p><br/><br/>
                <h3>Donar con los ojos cerrados</h3>
                <p>Si querés donar dinero ahora mismo, solamente porque te carcome la ansiedad y el altruismo, podés
                    hacerlo. Te convertirás en miembro vitalicio de la Fundación.</p>
            </article>
        </div>
    </section>

    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
    </div>
    <div class="icono_up">
        <span class="icon-angle-up"></span>
    </div>
@endsection

@section('footer')
    @include("fundacion.footer-fundacion")
@endsection
