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
                    <span>Privacidad</span>
                </div>
                <div id="user_alias">
                    <h1>Privacidad</span>
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <section class="contenedor intro_gral">

                    
            <div id="check_div" class="input_err obligatorio" style="padding-right: 0px !important;">
                <label class="checkbox-container letra_chica text_bold"> 
                    <input type="checkbox" id="cbox1" name="plataforma" class="cb cb1" value="1" checked disabled>  
                      <a href="{{url('terminos-y-condiciones')}}" target="_blank" class="subrayado resaltado_amarillo">Términos y condiciones</a>
                      <span class="crear_check"></span>
                </label> 
            </div> 
            <br/>
            <div id="check_div" class="input_err obligatorio " style="padding-right: 0px !important;">
                <label class="checkbox-container letra_chica text_bold"> 
                    <input type="checkbox" id="cbox1" name="plataforma" class="cb cb1" value="1" checked disabled>  
                      <a href="{{url('politica-de-privacidad')}}" target="_blank" class="subrayado resaltado_amarillo">Política de privacidad</a>
                      <span class="crear_check"></span>
                </label> 
            </div> 
            <br/>
            <div id="check_div" class="input_err obligatorio" style="padding-right: 0px !important;">
                <label class="checkbox-container letra_chica text_bold"> 
                    <input type="checkbox" id="cbox1" name="plataforma" class="cb cb1" value="1" checked disabled>  
                      <a href="{{url('politica-de-cookies')}}" target="_blank" class="subrayado resaltado_amarillo">Política de cookies</a>
                      <span class="crear_check"></span>
                </label> 
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
