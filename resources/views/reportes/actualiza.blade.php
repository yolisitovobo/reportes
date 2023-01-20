@extends('layout.general')
@section('content')
@include('layout.menu')
    <div class="justify-content-center align-items-center mx-auto text-center" style="margin: 1em;">
        <label class="col-sm-4 col-form-label card_computo_1">Usuario: {{ $user_db_nom }}</label>
    </div>
    <div class=" table-responsive  justify-content-center align-items-center " style="margin: 1em;">
        <form  method="POST">
            @csrf
            <input type="hidden" name='id' value="{{$reporte['id_reporte']}}">
            <table class="table table-bordered border-primary table-align-middle">
                <tbody>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1">Número Reporte</label></td>
                        <td><label class="lbl_txt"> <b> @php(printf('%03d',$reporte['id_reporte']))</b></label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255); width:30%"><label class="card_computo_1">Persona que
                                Reporta</label></td>
                        <td><label class="lbl_txt"> {{ $us_rep[0]['staff_nombre'] }}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Área o
                                Departamento</label></td>
                        <td><label class="align-content-center lbl_txt"> {{ $us_rep[0]['staff_sda'] }}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Usuario del
                                Equipo</label></td>
                        <td><label class="align-content-center lbl_txt"> {{ $us_equ[0]['staff_nombre'] }}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Equipo o
                                Problema</label></td>
                        <td><label class="align-content-center lbl_txt">{{ $equ }}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Descripción
                                del Problema</label></td>
                        <td><label class="align-content-center lbl_txt">{{ $reporte['des_proble'] }}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Fecha del
                                Reporte (dd/mm/aaaa HH:mm)</label></td>
                        <td><label class="align-content-center lbl_txt">{{ $fecha }}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Técnico
                                Asignado</label></td>
                        <td><label class="align-content-center lbl_txt">{{ $reporte['tec_asig'] }}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Descripción
                                del Trabajo Realizado</label></td>
                        <td>
                            <textarea class="form-control" row='5' maxlength='250' name='des_tra'>{{ $reporte['des_tra'] }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Estado del
                                Reporte</label></td>
                        <td><label class="align-content-center lbl_txt">{{ $reporte['edo_reporte'] }}</label></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Solicitar
                                cierre del Reporte</label></td>
                        <td><input type="radio" name="serv_con" value="4" @if($reporte['serv_con']== 4)checked @endif></td>
                    </tr>
                    <tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)" colspan="2">
                            <center><label class="card_computo_1">-- Si requiere soporte externo, ingrese los datos
                                    siguientes --</label></center>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Solicitar
                                revisión externa</label></td>
                        <td><input type="radio" name="serv_con" value="2" @if(old('serv_con')=='2')checked @endif @if($reporte['serv_con']== 2)checked @endif></td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Marca del
                                Equipo</label></td>
                        <td><input type="text" name="marca" @if(!empty(trim($reporte['marca']))) value={{$reporte['marca']}} @endif >
                            @error("marca")<span class="text-danger alert">{{$message}}</span>@enderror</td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label
                                class="card_computo_1 text-left">Modelo</label></td>
                        <td><input type="text" name="modelo" @if(!empty(trim($reporte['modelo']))) value={{$reporte['modelo']}} @endif>@error("modelo")<span class="text-danger alert">{{$message}}</span>@enderror</td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Número de  Inventario UNAM</label></td>
                        <td><input type="text" name="no_inve" @if(!empty(trim($reporte['no_inve']))) value={{$reporte['no_inve']}} @endif>@error("no_inve")<span class="text-danger alert">{{$message}}</span>@enderror</td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Número de
                                Serie</label></td>
                        <td><input type="text" name="no_serie" @if(!empty(trim($reporte['no_serie']))) value={{$reporte['no_serie']}} @endif>@error("no_serie")<span class="text-danger alert">{{$message}}</span>@enderror</td>
                    </tr>
                    <tr>
                        <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">Descripción
                                para solicitud Externa</label></td>
                        <td>
                            <textarea class="form-control" row='5' maxlength='250' name='des_sol'>{{ $reporte['des_sol'] }}</textarea>@error("des_sol")<span class="text-danger alert">{{$message}}</span>@enderror
                        </td>
                    </tr>
                </tbody>
            </table>
            <center>
                <button type="submit" class="btn btn-primary"  role="button" >Actualiza</button>
            <center>
        </form>
    </div>
@endsection
