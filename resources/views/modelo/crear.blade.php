@extends('layouts.PAdmin')

@section('content')

<div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Registrar Modelo</div></div>
                                 <div class="control-group" align="center" >


@include('modelo.alertas.errores')
{!!Form::open(['route'=>'Modelo.store', 'method'=>'POST'])!!}
	@include('modelo.formularios.formularioModelo')
	{!!Form::submit('Registrar Modelo', ['class'=>'btn btn-primary'])!!}
{!!Form::close()!!}
{!!link_to_route('Modelo.store', $title = 'Cancelar',$parameters ='', $attributes = ['class'=>'btn btn-warning', 'align'=>'center' ])!!}

</div>
@stop