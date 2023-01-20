@extends('layout.general')
@section('content')
@php
   $fecha->format('d/m/Y');
@endphp
@dd($usuarios);
{{-- @include('layout/menu') --}}

<form action="{{ route('nuevo-reporte') }}" method="post">
    @csrf

        <div class=" row align-content-center justify-content-center" style="margin: 1em;" >
            <label class="col-sm-4 col-form-label card_computo_1">Usuario: {{$us_reg}}</label>
        </div>
    <div class="row border border-2 border-primary align-content-center justify-content-center rounded-3" style="margin: 1em; bgcolor: #B7C4E1" >
        <div class="row mb-3 " style="margin: 1em;" >
        <label class="col-sm-4 col-form-label card_computo_1">Persona que Reporta</label>
        <div class="col-sm-8">
            <select name="id_staff" class="form-select  @error('id_staff') is-invalid @enderror">
                @if (count($usuarios) > 1)
                <option value=''>{{__('Selecciona una opción...')}}</option>
                @endif
                @foreach ($usuarios as $id => $value )
                    <option value='{{$id}}' @if (old('id_staff')==$id) selected @endif>{{$value['staff_nombre']}}</option>
                @endforeach
            </select>
            @error('id_staff')
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
        </div>
        </div>
        <div class="row mb-3 " style="margin: 1em">
            <label class="col-sm-4 col-form-label card_computo_1" id="etiqueta">Área o Departamento</label>
            <div class="col-sm-8">
                <select name="id_area" class="form-select  @error('id_area') is-invalid @enderror">
                    @if (count($departamentos) > 1)
                    <option value=''>{{__('Selecciona una opción...')}}</option>
                    @endif
                    @foreach ($departamentos as $id => $value )
                        <option value='{{$value['staff_subgpo']}}' @if (old('id_area')==$value['staff_subgpo']) selected @endif>{{$value['staff_sda']}}</option>
                    @endforeach
                </select>
                @error('id_area')
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3 " style="margin: 1em">
            <label class="col-sm-4 col-form-label card_computo_1" id="etiqueta">Usuario del Equipo</label>
            <div class="col-sm-8">
                <select name="id_usuario" class="form-select  @error('id_usuario') is-invalid @enderror">
                    <option value=''>{{__('Selecciona una opción...')}}</option>
                @foreach ($usuario_equipo as $id => $value )
                        {{$id}} => {{$value['staff_nombre']}}
                        <option value='{{$id}}'  @if (old('id_usuario')==$id) selected @endif>{{$value['staff_nombre']}} </option>
                    @endforeach
                </select>
                @error('id_usuario')
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row mb-3 " style="margin: 1em">
            <label class="col-sm-4 col-form-label card_computo_1" id="etiqueta">Equipo o Problema</label>
            <div class="col-sm-8">
                <select name="tipo_equipo" class="form-select  @error('tipo_equipo') is-invalid @enderror">
                    <option value=''>{{__('Selecciona una opción...')}}</option>
                    @foreach ($equipos as $id => $value )
                        <option value='{{$id}}'  @if (old('tipo_equipo')==$id) selected @endif>{{$value}}</option>
                    @endforeach
                </select>
                @error('tipo_equipo')
                <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row mb-3 " style="margin: 1em">
            <label class="col-sm-4 col-form-label card_computo_1" id="etiqueta">Descripción del Problema</label>
            <div class="col-sm-8">
                <textarea class="form-control @error('des_proble') is-invalid @enderror" row='5' maxlength="250" name='des_proble'>{{old('des_proble')}}</textarea>
                @error('des_proble')
                <div id="validationServerUsernameFeedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row mb-3 " style="margin: 1em">
            <label class="col-sm-4 col-form-label card_computo_1">Fecha del Reporte</label>
            <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" id="card_computo_1" value="{{$fecha->format('d/m/Y');}}">
            </div>
        </div>
        <div class="col-auto text-center align-items-center">
            <button type="submit" class="btn btn-primary mb-3" name="registrar">Registrar</button>
        </div>
    </div>
</form>
@endsection
