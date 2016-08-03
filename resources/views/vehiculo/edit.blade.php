@extends('layouts.PAdmin')

@section('content')
<div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Editar Vehiculo</div></div>
                                 <div class="control-group" align="center" >


@include('vehiculo.alertas.errores')
{!!Form::model($vehiculo, ['route'=>['Vehiculo.update', $vehiculo->id], 'method'=>'PUT'])!!}
	@include('vehiculo.formularios.formularioVehiculo')
	{!!Form::submit('Actualizar Vehiculo', ['class'=>'btn btn-primary'])!!}
{!!Form::close()!!}

{!!link_to_route('Vehiculo.store', $title = 'Cancelar',$parameters ='', $attributes = ['class'=>'btn btn-warning', 'align'=>'center' ])!!}


</div>

@stop