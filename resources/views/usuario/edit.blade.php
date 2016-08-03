@extends('layouts.PAdmin')

@section('content')
<div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Editar Cliente</div></div>
                                 <div class="control-group" align="center" >
@include('usuario.alertas.errores')
{!!Form::model($usuarios, ['route'=>['Usuario.update', $usuarios->id], 'method'=>'PUT'])!!}
	@include('usuario.formularios.formularioUsuarioEditar')
	{!!Form::submit('Actualizar Usuario', ['class'=>'btn btn-primary'])!!}
{!!Form::close()!!}

{!!link_to_route('Usuario.store', $title = 'Cancelar',$parameters ='', $attributes = ['class'=>'btn btn-warning', 'align'=>'center' ])!!}


</div>

@stop