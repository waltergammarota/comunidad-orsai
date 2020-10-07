@extends('orsai-template')

@section('title', 'Perfil público | Comunidad Orsai')
@section('description', 'Perfil público')

@section('content')
    <section id="novedad" class="contenedor intro_gral ">
        <div class="info_per_breadcrumb">
            <div class="breadcrumbs">
                <div id="links_back">
                    <a href="{{url('novedades')}}">Panel de usuario</a>
                    <span>Desactivar cuenta</span>
                </div>
            </div>
        </div>
        <div class="cuerpo_texto texto_noticia">
            <div class="titulo">
                <h1 class="span_h1">Querés desactivar tu cuenta</h1>
                <span class="autor gris span_block"></span>
            </div>
            <div class="texto">
                Las fichas asociadas a esta cuenta van a desaparecer. <br>
                No vas a poder acceder a la información de la cuenta. <br>
                <br>
                Cancelar: <a href="{{url('panel')}}" class="subrayado">Me quiero quedar, saquenme de aquí</a>
                <br><br>
                Desactivar mi cuenta: <a href="{{url('confirmar-desactivar-cuenta')}}" class="subrayado">Me quiero ir</a>
            </div>
        </div>

    </section>


    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
@endsection

@section('footer')

@endsection
