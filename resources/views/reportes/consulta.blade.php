@extends('layout.general')
@section('content')
@include('layout/menu')
    <div class="justify-content-center align-items-center mx-auto text-center" style="margin: 1em;">
            <label class="col-sm-4 col-form-label card_computo_1">Usuario: {{$usuario['staff_nombre']}}</label>
    </div>
    <div class=" table-responsive  justify-content-center align-items-center mx-auto" style="margin: 1em;">
        @if(!empty($rep_final))
            <table class="table  table-striped table-bordered border-primary table-align-middle text-center">
                <thead>
                    <tr class="table-primary">
                        <th class="card_computo_2">No. Reporte</th>
                        <th class="card_computo_2">Área o Departamento</th>
                        <th class="card_computo_2">Usuario del equipo</th>
                        <th class="card_computo_2">Equipo o problema</th>
                        <th class="card_computo_2">Fecha del Reporte</th>
                        <th class="card_computo_2">Técnico Asignado</th>
                        <th class="card_computo_2">Estado del Reporte</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rep_final as  $rep_datos )
                        <tr>
                            <td><a href="./reporte/detalle/{{$rep_datos['id_reporte']}}/rep_vista" class="lbl_tabla">@php(printf('%03d',$rep_datos['id_reporte']))</a></td>
                            <td> <label class="lbl_tabla">{{$rep_datos['area_dpto']}}</label></td>
                            <td> <label class="lbl_tabla">{{$rep_datos['us_equipo']}}</label></td>
                            <td> <label class="lbl_tabla">{{$rep_datos['equ_prob']}}</label></td>
                            <td> <label class="lbl_tabla">{{$rep_datos['fecha_repo']}}</label></td>
                            <td> <label class="lbl_tabla">{{$rep_datos['tecnico']}}</label></td>
                            <td> <label class="lbl_tabla">{{$rep_datos['edo_repo']}}</label></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <br><br><br>
            <center>
                <label class="align-content-center card_computo_1">No hay reportes pendientes por atender</label>
            </center>
            <br><br><br>
            @endif
    </div>
@endsection
