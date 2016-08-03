@extends('layouts.PAdmin')

@section('content')

<div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Registrar Vehiculo</div></div>
                                 <div class="control-group" align="center" >


@include('vehiculo.alertas.errores')
{!!Form::open(['route'=>'Vehiculo.store', 'method'=>'POST'])!!}
	@include('vehiculo.formularios.formularioVehiculo')
	{!!Form::submit('Registrar Vehiculo', ['class'=>'btn btn-primary'])!!}
{!!Form::close()!!}
{!!link_to_route('Vehiculo.index', $title = 'Cancelar',$parameters ='', $attributes = ['class'=>'btn btn-warning', 'align'=>'center' ])!!}

</div>
@stop