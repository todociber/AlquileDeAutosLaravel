@extends('layouts.PAdmin')

@section('content')
<div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Editar alquiler</div></div>
                                 <div class="control-group" align="center" >

{!!Form::open(['route'=>['Alquiler.update' ,$parameters = Session::get('idAlquiler')], 'method'=>'PUT'])!!}
	@include('alquiler.formularios.formularioUsuarioEdicionAlquiler')
	{!!Form::submit('Actualizar Alquiler ', ['class'=>'btn btn-primary'])!!}
{!!Form::close()!!}

{!!link_to_route('Alquiler.store', $title = 'Cancelar',$parameters ='', $attributes = ['class'=>'btn btn-warning', 'align'=>'center' ])!!}


</div>

@stop