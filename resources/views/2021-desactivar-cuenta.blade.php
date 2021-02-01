@extends('2021-orsai-template')

@section('title', 'Desactivar cuenta | Comunidad Orsai')
@section('description', 'Desactivar cuenta')

@section('content')
<section class="resaltado_gris pd_20_tp_bt">
    <div class="contenedor ft_size form_rel">
        <div class="grilla_perfil">
        <div class="miga_pan">
            <ul>
                <li><a href="{{url('panel')}}" rel="noopener noreferrer">Panel de usuario <span class="icon-right-open"></span></a></li> 
                <li><a href="#" class="activo" rel="noopener noreferrer">Desactivar cuenta</a></li>
            </ul>
        </div>
        </div>
    </div>
    <article class="cuerpo_card_perfil_publico">
        <div class="cuerpo_interna">
            <div class="perfil_publico">
            <div class="titulo">
                <h1 class="span_h1">¿Querés desactivar tu cuenta?</h1> 
            </div>
            <div class="texto">
                <span>Las fichas asociadas a tu usuario van a desaparecer.<br/>No vas a poder acceder más a la cuenta.</span>  
            </div>
            <div class="titulo border_bt_form pd_20_tp_bt">
            	<a href="{{url('panel')}}" class="boton_redondeado resaltado_amarillo text_bold width_100 g-recaptcha">Me quiero quedar, sáquenme de aquí.</a> 
            </div>
            <div class="datos">
            <a href="{{url('confirmar-desactivar-cuenta')}}" class="boton_redondeado btn_transparente  width_100">Quiero desactivar mi cuenta.</a>
                <div> 
            </div>
            </div>
        </div>
    </article> 
</section> 
@endsection

@section('footer')

@endsection
