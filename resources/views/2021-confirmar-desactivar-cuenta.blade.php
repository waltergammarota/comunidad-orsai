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
        <div class="cuerpo_interna ">
            <div class="perfil_publico ">
            <div class="titulo">
                <h1 class="span_h1">Confirmanos que quieres desactivar tu cuenta</h1> 
            </div>
            <div class="texto">
                <span>Las fichas asociadas a tu usuario van a desaparecer.<br/>Tus datos van a ser anonimizados, tu información personal será borrada del sistema.</span>  
            </div>
            <div class="titulo border_bt_form pd_20_tp_bt">
            	<a href="{{url('panel')}}" class="boton_redondeado resaltado_amarillo text_bold width_100 g-recaptcha">Me quiero quedar, sáquenme de aquí.</a> 
            </div>
            <div class="datos"> 
                <form action="{{url('confirmar-desactivar-cuenta')}}" method="POST">
		            @csrf

		            <div class="form_ctrl input_">
		                <div class="input_err">
		                    <label class="text_medium" for="confirmar">Escribe "confirmar" para desactivar tu cuenta</label>  
		            		<input type="text" value="" name="confirmar" placeholder="confirmar" class="" style="max-width:200px;">
		                </div>
		            </div> 
                    <button type="submit" class="boton_redondeado btn_transparente  width_100">
                        Definitivamente quiero desactivar mi cuenta
                    </button>
                </form>
            </div>
        </div>
    </article> 
</section>  
@endsection

@section('footer')

@endsection

