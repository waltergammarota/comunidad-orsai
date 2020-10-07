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
                <h1 class="span_h1">Confirmanos que quieres desactivar tu cuenta</h1>
                <span class="autor gris span_block"></span>
            </div>
            <div class="texto">
                Las fichas asociadas a esta cuenta van a desaparecer. <br>
                Tus datos van a ser anonimizados, tu información personal será borrada del sistema. <br>
                <br>
                Cancelar: <a href="{{url('panel')}}" class="subrayado">Me quiero quedar, saquenme de aquí</a>
                <br><br>
                <form action="{{url('confirmar-desactivar-cuenta')}}" method="POST">
                    @csrf
                    <div class="input_err">
                        <label for="confirmar">Escribe "confirmar" para desactivar tu cuenta</label>
                        <div class="in_sp obligatorio editar">
                            <input type="text" value="" name="confirmar"
                                   placeholder="confirmar">
                        </div>
                        <br>
                    </div>
                    <button type="submit" class="subrayado resaltado_amarillo text_bold marginTop10">
                        Definitivamente quiero desactivar mi cuenta
                    </button>
                </form>
            </div>
        </div>

    </section>


    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
@endsection

@section('footer')

@endsection
