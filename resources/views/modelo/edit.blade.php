@extends('layouts.PAdmin')

@section('content')
<div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Registrar Modelo</div></div>
                                 <div class="control-group" align="center" >
@include('modelo.alertas.errores')
{!!Form::model($modelo, ['route'=>['Modelo.update', $modelo->id], 'method'=>'PUT'])!!}
	@include('modelo.formularios.formularioModelo')
	{!!Form::submit('Actualizar Modelo', ['class'=>'btn btn-primary'])!!}
{!!Form::close()!!}

{!!link_to_route('Modelo.store', $title = 'Cancelar',$parameters ='', $attributes = ['class'=>'btn btn-warning', 'align'=>'center' ])!!}


</div>

@stop