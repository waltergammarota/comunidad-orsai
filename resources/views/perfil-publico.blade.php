@extends('orsai-template')

@section('title', 'Perfil público de '.$user->userName.' | Comunidad Orsai')
@section('description', $user->userName)

@section('content')
    <section id="intro" class="contenedor intro_gral panel">
        <div class="user_prop">
            <div id="user_img">
                <img src="{{$avatar}}" alt="Imagen usuario">
            </div>
            <div id="user_alias">
                <h1>{{$user->name}} {{$user->lastName}}</h1> 
            </div>

        </div>
    </section>

    <section id="panel_user_profile" class="contenedor profile_public">
        <div class="form_left">
            <div class="input_err">
                <label>Nombre y apellido</label>
                <div class="in_sp obligatorio editar">
                    <p>{{$user->name}} {{$user->lastName}}</p>
                </div>
                <div class="line_dashed"></div>
            </div>
            <div class="input_err select">
                <label class='oculto'>País</label>
                <div class="in_sp editar">
                    <p class="pais_select">{{$user->country}}</p>
                </div>
                <div class="line_dashed"></div>
            </div>
        </div>
        <div class="form_right">
            <div class="input_err">
                <label>Nombre de usuario</label>
                <div class="in_sp obligatorio editar">
                    <p>{{$user->userName}}</p>
                </div>
                <div class="line_dashed"></div>
            </div>
            <div class="input_err">
                <label>Profesión</label>
                <div class="in_sp obligatorio editar">
                    <p>{{$user->profesion}}&nbsp;</p>
                </div>
                <div class="line_dashed"></div>
            </div>
        </div>

    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
    </div>
@endsection

@section('footer')

@endsection
