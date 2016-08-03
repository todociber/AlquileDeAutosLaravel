@extends('layouts.PAdmin')

@section('content')
<div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Registrar Modelo</div></div>
                                 <div class="control-group" align="center" >
@include('color.alertas.errores')
{!!Form::model($color, ['route'=>['Color.update', $color->id], 'method'=>'PUT'])!!}
	@include('color.formularios.formulariocolor')
	{!!Form::submit('Actualizar Color', ['class'=>'btn btn-primary'])!!}
{!!Form::close()!!}

{!!link_to_route('Color.store', $title = 'Cancelar',$parameters ='', $attributes = ['class'=>'btn btn-warning', 'align'=>'center' ])!!}


</div>

@stop