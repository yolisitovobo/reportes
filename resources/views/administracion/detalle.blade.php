@extends('layout.general')
@section('content')
@include('layout/menu')
    <div class="justify-content-center align-items-center mx-auto text-center" style="margin: 1em;">
        <label class="col-sm-4 col-form-label card_computo_1">Usuario: {{$user_db_nom}}</label>
    </div>
    <div class=" table-responsive  justify-content-center align-items-center " style="margin: 1em;">
        <table class="table table-bordered border-primary table-align-middle">
                <tbody>
                        <tr>
                            <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1">Número Reporte</label></td>
                            <td><label class="lbl_txt"> <b> @php(printf('%03d',$reporte['id_reporte']))</b></label></td>
                        </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1">Persona que Reporta</label></td>
                        <td><label class="lbl_txt"> {{$us_rep[0]['staff_nombre']}} </label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Área o Departamento</label></td>
                        <td><label class="align-content-center lbl_txt"> {{$us_rep[0]['staff_sda']}}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Usuario del Equipo</label></td>
                        <td><label class="align-content-center lbl_txt"> {{$us_equ[0]['staff_nombre']}}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Equipo o Problema</label></td>
                        <td><label class="align-content-center lbl_txt">{{$equ}}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Descripción del Problema</label></td>
                        <td><label class="align-content-center lbl_txt">{{$reporte['des_proble']}}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Fecha del Reporte (dd/mm/aaaa HH:mm)</label></td>
                        <td><label class="align-content-center lbl_txt">{{$fecha}}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Técnico Asignado</label></td>
                        <td><label class="align-content-center lbl_txt">{{$reporte['tec_asig']}}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Descripción del Trabajo Realizado</label></td>
                        <td><label class="align-content-center lbl_txt">{{$reporte['des_tra']}}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Estado del Reporte</label></td>
                        <td><label class="align-content-center lbl_txt">{{$reporte['edo_reporte']}}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Marca del Equipo</label></td>
                        <td><label class="align-content-center lbl_txt"> {{$reporte['marca']}}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Modelo</label></td>
                        <td><label class="align-content-center lbl_txt">{{$reporte['modelo']}} </label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Número de Inventario UNAM</label></td>
                        <td><label class="align-content-center lbl_txt">{{$reporte['no_inve']}}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Número de Serie</label></td>
                        <td><label class="align-content-center lbl_txt">{{$reporte['no_serie']}}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Descripción para solicitud Externa</label></td>
                        <td><label class="align-content-center lbl_txt">{{$reporte['des_sol']}}</label></td>
                    </tr>
                    <tr class="align-content-center text-center">
                        <td colspan="2">

                        <a href="{{route('admin-consulta',['id'=>$reporte['id_reporte'],'ref'=>'imprimir'])}}">Imprimir</a>

                        <a href="../../actualiza/{{$reporte['id_reporte']}}">Actualizar</a></td>
                    </tr>
                </tbody>
            </table>

    </div>
@endsection
