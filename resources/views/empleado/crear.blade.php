@extends('layouts.PAdmin')

@section('content')

<div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Registrar Empleado</div></div>
                                 <div class="control-group" align="center" >

@include('empleado.alertas.errores')
{!!Form::open([ 'name'=>'drop_list','route'=>'Empleado.store', 'method'=>'POST'])!!}
	@include('empleado.formularios.formularioUsuario')
	{!!Form::submit('Registrar Empleado', ['class'=>'btn btn-primary'])!!}
{!!Form::close()!!}
{!!link_to_route('Empleado.store', $title = 'Cancelar',$parameters ='', $attributes = ['class'=>'btn btn-warning', 'align'=>'center' ])!!}

</div>
@stop