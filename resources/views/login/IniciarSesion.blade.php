@extends('layouts.Plogin')


@if(Session::has('message'))

    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get('message')}}
    </div>
@endif
@if(Session::has('message-error'))

    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get('message-error')}}
    </div>
@endif

@section('content')

    <div style="text-align: center;">
        <legend class="legend">Iniciar Sesion</legend>
        {!!Form::open(['route'=>'Login.store', 'method'=>'POST'])!!}
        <br><br><br>
        @include('login.formularios.formulariologin')
        <br>
        {!!Form::submit('Iniciar sesion', ['class'=>'btn btn-primary'])!!}
        {!!Form::close()!!}
        <br><br><br><br><br><br>
    </div>

@stop