@extends('orsai-template')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Preferencias | Comunidad Orsai')
@section('description', 'Preferencias')

@section('content')
    <section id="intro" class="contenedor intro_gral panel info_personal">
        <div class="info_per_left">
            <div class="">
                <div id="links_back">
                    <a href="{{url('panel')}}">Panel de usuario</a>
                    <span>Configuración de privacidad</span>
                </div>
                <div id="user_alias">
                    <h1>Configuración de <span class="span_block">privacidad</span>
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <section class="contenedor intro_gral">
        <div>
            <ul>
                <li>
                    Nuestros términos y condiciones: <a href="{{url('terminos-y-condiciones')}}" class="subrayado">Ver</a>
                </li>
                <li>
                    Nuestra política de privacidad: <a href="{{url('politica-de-privacidad')}}" class="subrayado">Ver</a>
                </li>
                <li>
                    Nuestra política de cookies: <a href="{{url('politica-de-cookies')}}" class="subrayado">Ver</a>
                </li>
            </ul>
        </div>

    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>

    <div id="exito_msg" class="popup">
        <div>
            <div id="texto_exito">
                <span>Guardando</span>
            </div>
        </div>
    </div>
@endsection

@section('footer')

@endsection
