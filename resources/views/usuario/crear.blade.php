@extends('layouts.PAdmin')

@section('content')

<div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Registrar Cliente</div></div>
                                 <div class="control-group" align="center" >

@include('usuario.alertas.errores')
{!!Form::open([ 'name'=>'drop_list','route'=>'Usuario.store', 'method'=>'POST'])!!}
	@include('usuario.formularios.formularioUsuario')






	{!!Form::submit('Registrar Cliente', ['class'=>'btn btn-primary'])!!}
{!!Form::close()!!}
{!!link_to_route('Usuario.store', $title = 'Cancelar',$parameters ='', $attributes = ['class'=>'btn btn-warning', 'align'=>'center' ])!!}

</div>
@stop