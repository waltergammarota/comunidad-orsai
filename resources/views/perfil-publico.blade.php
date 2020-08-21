@extends('orsai-template')

@section('title', 'Perfil público | Fundación Orsai')
@section('description', 'Perfil público')

@section('content')
<section id="intro" class="contenedor intro_gral panel">
    <div class="user_prop">
        <div id="user_img">
            <img src="{{$avatar}}" alt="Imagen usuario">
        </div>
        <div id="user_alias">
            <h1>{{"@".$user->userName}}</h1>
        </div>
    </div>
</section>

<section id="panel_user_profile" class="contenedor profile_public">
    <div class="form_left">
        <div class="input_err">
            <label>Usuario*</label>
            <div class="in_sp obligatorio editar">
                <p>{{$user->userName}}</p>
            </div>
            <div class="line_dashed"></div>
        </div>
        <div class="input_err">
            <label>Nombre*</label>
            <div class="in_sp obligatorio editar">
                <p>{{$user->name}}</p>
            </div>
            <div class="line_dashed"></div>
        </div>
        <div class="input_err">
            <label>Apellido*</label>
            <div class="in_sp obligatorio editar">
                <p>{{$user->lastName}}</p>
            </div>
            <div class="line_dashed"></div>
        </div>
        <div class="input_err">
            <label>Ciudad*</label>
            <div class="in_sp obligatorio editar">
                <p>{{$user->city}}</p>
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
            <label>Fecha de nacimiento*</label>
            <div class="in_sp obligatorio editar">
                <p>29/12/1982</p>
            </div>
            <div class="line_dashed"></div>
        </div>
        <div class="input_err">
            <label>Profesión*</label>
            <div class="in_sp obligatorio editar">
                <p>{{$user->profesion}}</p>
            </div>
            <div class="line_dashed"></div>
        </div>
        <div class="input_err">
            <label>Descripción*</label>
            <div class="in_sp obligatorio editar">
                <p>{{$user->description}}</p>
            </div>
            <div class="line_dashed"></div>
        </div>
        <div class="input_err">
            <label>Facebook</label>
            <div class="in_sp editar">
                <p>{{$user->facebook}}</p>
            </div>
            <div class="line_dashed"></div>
        </div>
        <div class="input_err">
            <label>Twitter</label>
            <div class="in_sp editar">
                <p>{{$user->twitter}}</p>
            </div>
            <div class="line_dashed"></div>
        </div>
        <div class="input_err">
            <label>Instagram</label>
            <div class="in_sp editar">
                <p>{{$user->instagram}}</p>
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
