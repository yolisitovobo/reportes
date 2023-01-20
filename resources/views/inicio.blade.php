@extends('layout.general')
@section('content')
@php
    $pag='inicio'
@endphp
@include('layout.menu')
<br><br><br>
<div class="row justify-content-center align-items-center mx-auto" style="margin: 1em;">
        <div class="row mb-3 border-0 d-flex justify-content-center" style="margin: 1em; bgcolor: #B7C4E1" >
            <label class="col-sm-8 col-form-label lbl_txt d-flex justify-content-center" style="font-size:x-large">Bienvenido(a) {{$usuario['staff_nombre']}}</label>
        </div>
    </div>
    <br><br>
@endsection
