@extends('2021-orsai-template')

@section('title', 'Home | Comunidad Orsai')
@section('description', 'Página de Inicio')

@section('content') 
    @php
        include "https://beta.comunidadorsai.org/slider.php";
    @endphp 
    <section class="resaltado_gris pd_tp_bt pd_20 widt_100">
        <div class="contenedor grilla_3 card_style_4_grid"> 
            @if (!Auth::check()) 
                <article class="card_style_4 card_style_4_tit">
                    <h2 class=""><strong>¿Querés ser parte?</strong><br>Participar de Orsai es gratis, divertido y a veces incluso legal.</h2>
                    <p>Si te apurás serás un <a href="{{url('novedades/socios-fundadores')}}" class="link_subrayado"><span>«socio fundador»</span></a></p>
                </article>
            @else
                @if(Auth::user()->phone_verified_at) 
                    <article class="card_style_4 card_style_4_tit">
                        <h2 class=""><strong>¡Mirálo de adentro!</strong><br>Sentate tranqui en la vereda a ver cómo crecen los socios posta.</h2>
                        <p>Tus derechos como <a href="{{url('novedades/socios-fundadores')}}" class="link_subrayado"><span>«socio fundador»</span></a></p>
                    </article>
                @else
                    <article class="card_style_4 card_style_4_tit">
                        <h2 class=""><strong>¡Adiós fase beta!</strong><br>Es momento de que certifiques tu identidad, así que
                            mejor peináte.</h2>
                        <p>Los primeros 15.000 serán <a href="{{url('novedades/socios-fundadores')}}" class="link_subrayado"><span>«fundadores»</span></a></p>
                    </article>
                @endif
            @endif   
            <article class="card_style_4 ">
                <div>
                    <span class="icono icon-card"></span>
                    <h2>{{$sociosBeta}}</h2>
                    <p>socios beta</p>
                </div>
            </article>
            <article class="card_style_4">
                <div>
                    <span class="icono icon-ficha"></span>
                    <h2>{{$sociosPosta}}</h2>
                    <p>socios posta</p>
                </div>
            </article> 
        </div>  
        @if (!Auth::check()) 
            <div class="contenedor cont_bt">
                <a href="{{url('registrarse')}}" class="boton_redondeado resaltado_amarillo">
                    <span>Asociáte ahora</span>
                </a>
            </div>
        @else
            @if(Auth::user()->phone_verified_at) 
                <div class="contenedor cont_bt">
                    <a href="{{url('perfil')}}" class="boton_redondeado resaltado_amarillo">
                        <span>Tu información personal</span>
                    </a>
                </div> 
            @else
                <div class="contenedor cont_bt">
                    <a href="{{url('validacion-usuario')}}" class="boton_redondeado resaltado_amarillo">
                        <span>Confirmá tu membresía</span>
                    </a>
                </div>
            @endif
        @endif   
    </section>
    @php
        include "https://beta.comunidadorsai.org/fundacion.php";
    @endphp 
@endsection
