@extends('2021-orsai-template')

@section('title', 'Perfil público de '.$user->userName.' | Comunidad Orsai')
@section('description', $user->userName)

@section('content') 

<section class="resaltado_gris pd_20_tp_bt">
    <div class="contenedor ft_size form_rel">
        <div class="grilla_perfil">
        <div class="miga_pan">
            <ul>
                <li><a href="" rel="noopener noreferrer">Perfil público</a></li>
            </ul>
        </div>
        </div>
    </div>
    <article class="cuerpo_card_perfil_publico">
        <div class="cuerpo_interna">
            <div class="perfil_publico">
                <div class="cont_img_perfil">
                    <div class="img_perfil">
                        <img src="{{$avatar}}" alt="">
                    </div>
                    @if($user->phone_verified_at)
                    	<span class="icono icon-check_2"></span>
                    @endif
                </div>
                <div class="titulo border_bt_form">
                    <h1 class="text_medium">{{$user->name}} {{$user->lastName}}</h1>
                    @if($user->socio_fundador)
                    	<span class="subtitulo">Socio Fundadora</span>
                    @endif
                </div>
                <div class="datos">
                    <div>
                        <span class="color_gris">Nombre de usuario</span>
                        <span>{{$user->userName}}</span>
                    </div>
                    <div>
                        <span class="color_gris">País</span>
                        <span>{{$user->country}}</span>
                    </div>
                    <div>
                        <span class="color_gris">Profesión</span>
                        <span>{{$user->profesion}}</span>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <div class="contenedor cuerpo_card_perfil_publico">
        <div class="perfil_publico_btn">
    <div class="form_ctrl input_ ">
        <div class="grilla_form align_center">
            <div class="col_5">
                <div class="align_center">
                    <a class="boton_redondeado resaltado_amarillo pd_50_lf_rg width_100" href="{{url('panel')}}">Volver al panel de usuario</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
@endsection 
@section('footer') 
@endsection
