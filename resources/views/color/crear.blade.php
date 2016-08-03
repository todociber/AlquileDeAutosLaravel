@extends('layouts.PAdmin')

@section('content')

<div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Registrar Marca</div></div>
                                 <div class="control-group" align="center" >


@include('color.alertas.errores')
{!!Form::open(['route'=>'Color.store', 'method'=>'POST'])!!}
	@include('color.formularios.formularioColor')
	{!!Form::submit('Registrar Color', ['class'=>'btn btn-primary'])!!}
{!!Form::close()!!}
{!!link_to_route('Color.store', $title = 'Cancelar',$parameters ='', $attributes = ['class'=>'btn btn-warning', 'align'=>'center' ])!!}

</div>
@stop