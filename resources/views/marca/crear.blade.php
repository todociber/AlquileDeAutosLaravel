@extends('layouts.PAdmin')

@section('content')

<div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Registrar Marca</div></div>
                                 <div class="control-group" align="center" >


@include('marca.alertas.errores')
{!!Form::open(['route'=>'Marca.store', 'method'=>'POST'])!!}
	@include('marca.formularios.formularioMarca')
	{!!Form::submit('Registrar Marca', ['class'=>'btn btn-primary'])!!}
{!!Form::close()!!}
{!!link_to_route('Marca.store', $title = 'Cancelar',$parameters ='', $attributes = ['class'=>'btn btn-warning', 'align'=>'center' ])!!}

</div>
@stop