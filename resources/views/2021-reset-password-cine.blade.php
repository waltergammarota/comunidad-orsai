@extends('2021-orsai-template')

@section('title', 'Asociarse | Comunidad Orsai')
@section('description', 'Registrate y formá parte de la Comunidad Orsai.')

@section('content')
    <section class="resaltado_gris pd_20 pd_20_bt">
        <div class="contenedor grilla_asociarse">
            <div class="form_central_3">
                <div class="intro_ ">
                    <p>Asociarse</p>
                </div>
            </div>
        </div>
        <article id="registro_js" class="contenedor grilla_asociarse_blanco">
            <h2 class="title-login">Bienvenida/o a Comunidad Orsai</h2>
            <p class="text-login">Estamos en período de unificación de usuarios de todas las plataformas y necesitamos que actualices tu contraseña.</p>
            <p class="text-login">Te enviamos un email a tu casilla de correo.</p>
        </article>
    </section>
@endsection
@section('footer')
    <script>
        $('select').on('change', function() {
            console.log("test");
            if ($(this).val()) {
                $(this).css('font-style', 'normal');
                return $(this).css('color', 'black');
            }
        });

        function onSubmit(token) {
            document.getElementById('registro-form').submit();
            $(".msg_load").show(200);
            $(".ajaxgif").removeClass('hide');
        }
    </script>
@endsection
