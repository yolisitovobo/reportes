<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>REPORTE @php(printf('%03d',$reporte['id_reporte']))</title>
        <style>
        h5,h4{
        text-align: center;
        text-transform: uppercase;
        color:#1A237E;
        font-family:Helvetica,sans-serif,Arial;
        font-weight: bold;
        }

        hr{
            border: 2px solid goldenrod;
            border-radius: 2px;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            color:#1A237E;
            font-family:Helvetica,sans-serif,Arial;
        }

    </style>
    </head>
    <body>
        <center>
            <table width="100%"  style="border:hidden">
                <tr   valign="top" style="border:hidden">
                    <td align="Center" width="15%" style="border:hidden">
                        <img src="{{ asset('images/unam_1.png') }}" width="100" height="115" />
                    </td>
                    <td  style="border:hidden">
                        <h4>UNIVERSIDAD NACIONAL AUT&Oacute;NOMA DE M&Eacute;XICO</h4>
                        <h4>DIRECCI&Oacute;N GENERAL DE INCORPORACI&Oacute;N Y REVALIDACI&Oacute;N DE ESTUDIOS</h4>
                        <h4>SUBDIRECCIÓN DE CÓMPUTO</h4>
                        <br><br>
                        <h4>REPORTES DE SERVICIO</h4>
                    </td>
                    <td align="Center" width="15%" style="border: hidden">
                        <img src="{{ asset('images/dgire.png') }}" width="90" height="105" />
                    </td>
                </tr>
            </table>
            <br><br>
        <div class="contenido" border=1>
            <table align="center" width='100%'>
                <tr>
                    <td style="background-color:rgb(207, 226, 255)" width="40%"><label class="card_computo_1 text-left"> &nbsp;<b>No. de Reporte&nbsp;</b></td>
                    <td>&nbsp; @php(printf('%03d',$reporte['id_reporte']))&nbsp;</td>
                </tr>
                <tr>
                    <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">&nbsp;<b>Persona que reporta&nbsp;</b></td>
                    <td>&nbsp; {{$us_rep[0]['staff_nombre']}}&nbsp;</td>
                </tr>
                <tr>
                    <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left"> &nbsp;<b>Área o Departameto&nbsp;</b></td>
                    <td>&nbsp; {{$us_rep[0]['staff_nombre']}}&nbsp;</td>
                </tr>
                <tr>
                    <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">&nbsp;<b>Área o Departamento</label></td>
                    <td><label class="align-content-center lbl_txt"> {{$us_rep[0]['staff_sda']}}</label></td>
                </tr>
                <tr>
                    <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">&nbsp;<b>Usuario del Equipo</label></td>
                    <td><label class="align-content-center lbl_txt"> {{$us_equ[0]['staff_nombre']}}</label></td>
                </tr>
                <tr>
                    <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">&nbsp;<b>Equipo o Problema</label></td>
                    <td><label class="align-content-center lbl_txt">{{$equ}}</label></td>
                </tr>
                <tr>
                    <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">&nbsp;<b>Descripción del Problema</label></td>
                    <td><label class="align-content-center lbl_txt">{{utf8_encode($reporte['des_proble'])}}</label></td>
                </tr>
                <tr>
                    <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">&nbsp;<b>Fecha del Reporte <br>&nbsp;(dd/mm/aaaa HH:mm)</label></td>
                    <td><label class="align-content-center lbl_txt">{{$fecha}}</label></td>
                </tr>
                <tr>
                    <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">&nbsp;<b>Técnico Asignado</label></td>
                    <td><label class="align-content-center lbl_txt">{{$reporte['tec_asig']}}</label></td>
                </tr>
                <tr>
                    <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">&nbsp;<b>Descripción del Trabajo Realizado</label></td>
                    <td><label class="align-content-center lbl_txt">{{$reporte['des_tra']}}</label></td>
                </tr>
                <tr>
                    <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">&nbsp;<b>Estado del Reporte</label></td>
                    <td><label class="align-content-center lbl_txt">{{$reporte['edo_reporte']}}</label></td>
                </tr>
                <tr>
                    <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">&nbsp;<b>Marca del Equipo</label></td>
                    <td><label class="align-content-center lbl_txt">{{$reporte['marca']}} </label></td>
                </tr>
                <tr>
                    <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">&nbsp;<b>Modelo</label></td>
                    <td><label class="align-content-center lbl_txt"> {{$reporte['modelo']}}</label></td>
                </tr>
                <tr>
                    <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">&nbsp;<b>Número de Inventario UNAM</label></td>
                    <td><label class="align-content-center lbl_txt">{{$reporte['no_inve']}}</label></td>
                </tr>
                <tr>
                    <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">&nbsp;<b>Número de Serie</label></td>
                    <td><label class="align-content-center lbl_txt">{{$reporte['no_serie']}}</label></td>
                </tr>
                <tr>
                    <td style="background-color:rgb(207, 226, 255)"><label class="card_computo_1 text-left">&nbsp;<b>Descripción para solicitud Externa</label></td>
                    <td><label class="align-content-center lbl_txt">{{$reporte['des_sol']}}</label></td>
                </tr>
            </table>

        </div>
    </body>
</html>
