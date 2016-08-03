@extends('layouts.PAdmin')

@section('content')

<div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Registrar Marca</div></div>
                                 <div class="control-group" align="center" >


@include('condicion.alertas.errores')
{!!Form::open(['route'=>'Condicion.store', 'method'=>'POST'])!!}
	@include('condicion.formularios.formularioCondicion')
	{!!Form::submit('Registrar Condicion', ['class'=>'btn btn-primary'])!!}
{!!Form::close()!!}
{!!link_to_route('Condicion.store', $title = 'Cancelar',$parameters ='', $attributes = ['class'=>'btn btn-warning', 'align'=>'center' ])!!}

</div>
@stop