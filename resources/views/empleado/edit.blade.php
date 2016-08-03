@extends('layouts.PAdmin')

@section('content')
<div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Editar Empleado</div></div>
                                 <div class="control-group" align="center" >
@include('empleado.alertas.errores')
{!!Form::model($usuarios, ['route'=>['Empleado.update', $usuarios->id], 'method'=>'PUT'])!!}
	@include('empleado.formularios.formularioUsuarioEditar')
	{!!Form::submit('Actualizar Empleado', ['class'=>'btn btn-primary'])!!}
{!!Form::close()!!}

{!!link_to_route('Empleado.store', $title = 'Cancelar',$parameters ='', $attributes = ['class'=>'btn btn-warning', 'align'=>'center' ])!!}


</div>

@stop