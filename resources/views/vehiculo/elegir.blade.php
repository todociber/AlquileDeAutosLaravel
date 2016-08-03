@extends('layouts.PAdmin')
@section('content')


    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"></div></div>
    <div class="control-group" align="center" >


        @include('vehiculo.alertas.errores')
        {!!Form::open(['route'=>'AlquilerVehiculo.index', 'method'=>'GET'])!!}
        {!!Form::text('idUsuario',Session::get('id'), ['class'=>'form-control', 'placeholder'=>'id Usuario','style'=>'display:none'])!!}
        {!!Form::label('Buscar Modelo')!!}


        {!! Form::select('idModelo', $modelos, null, ['class' => 'form-control']) !!}


        {!!Form::submit('Buscar Vehiculo', ['class'=>'btn btn-primary'])!!}
        {!!Form::close()!!}
        {!!link_to_route('Usuario.index', $title = 'Cancelar',$parameters ='', $attributes = ['class'=>'btn btn-warning', 'align'=>'center' ])!!}

    </div>
@stop