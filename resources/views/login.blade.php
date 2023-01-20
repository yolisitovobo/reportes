@extends('layout.general')
@section('content')
<form action="{{ route('login') }}" method="post">
    @csrf
<div class="row m-0">
    <div class="col-md-10 offset-md-4">
    </br></br>
        <div class="mb-3 row ">
            <label for="user" class="col-sm-2 col-form-label" id='card_computo'>{{__('labels.login')}}</label>
            <div class="col-sm-7  text-center align-items-center">
                <input type="text" class="form-control @error('user') is-invalid @enderror w-25" id="login" value="" name="user">
                @error('user')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label" id='card_computo'>{{__('labels.password')}}</label>
            <div class="col-sm-7">
            <input type="password" class="form-control @error('password') is-invalid @enderror w-25" name="password" id="password">
            @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        </br></br>
        <div class="col-md-10 offset-md-2">
            <button class="btn btn-primary" type="submit">Entrar</button>
        </br></br></br></br>
        </div>
    </div>
    </div>
</div>
</form>
@endsection
