@extends('2021-orsai-template')

@section('title', 'Donar | Comunidad Orsai')
@section('description', 'Donar')

@section('content')
    <section class="resaltado_amarillo pd_tp_bt">
        <article class="contenedor">
            <div class="cuerpo_card_perfil_publico ps_pago_02 ps_pago_03">
                <div class="cuerpo_interna ">
                    <div class="">
                        <div class="titulo">
                            <h1 class="text_regular _barlow_text">¡HICISTE UNA DONACIÓN
                                A COMUNIDAD ORSAI!</h1>
                            <span class="">Ya tenés las fichas en tu cuenta. Sólo personas altruistas como vos pueden lograr grandes cosas.</span>
                        </div>
                        <table class="border_tp_bt_table">
                            <tbody class="">
                            <tr>
                                <td colspan="2">Detalle de tu donación:</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table class="items_detalle _recibo">
                                        <tr>
                                            <td>ID de transacción</td>
                                            <td>{{$details['payment_id']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Fecha y hora</td>
                                            <td>{{$details['fecha']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Paquete</td>
                                            <td>{{$producto->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Cantidad de fichas</td>
                                            <td>{{$producto->fichas}}</td>
                                        </tr>
                                        <tr>
                                            <td>Importe total</td>
                                            <td>USD {{$producto->getPriceInUsd()}}</td>
                                        </tr>
                                        <tr>
                                            <td>Donante</td>
                                            <td>{{$donante}}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="form_ctrl input_  pd_50_tp">
                            <div class="align_center">
                                <a href="{{url('mis-fichas')}}" class="boton_redondeado resaltado_amarillo pd_50_lf_rg">Ir
                                    a mis fichas</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endsection


@section('footer')
@endsection
