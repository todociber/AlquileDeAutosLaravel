@extends('layouts.PAdmin')
@if(Session::has('message'))
<div class="alert alert-{{Session::get('tipo')}} alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  {{Session::get('message')}}
</div>
@endif
@section('content')
   <div class="control-group" align="center" >
   <br>
{!!link_to_route('Usuario.create', $title = 'Agregar Usuario',$parameters ='', $attributes = ['class'=>'btn btn-success', 'align'=>'center' ])!!}
</div>
<table class="table table-striped table-bordered dataTable"  id="dynamic-table">
	<thead>
		<th>id</th>
		<th>Nombre</th>
		<th>Numero de Doocumento</th>
		<th>Fecha de Nacimiento</th>
		<th>Direccion</th>
		<th>Telefono</th>


		<th>Opciones</th>
	</thead><tbody>
	@foreach($usuarios as $usuario)
	<tr>
	<td>{{$usuario->id}}</td>
		<td>{{$usuario->PrimerNombre.' '.$usuario->SegundoNombre.' '.$usuario->PrimerApellido.' '.$usuario->SegundoApellido}}</td>
	<td>{{$usuario->nDocumento}} </td>
	<td>{{$usuario->FechaDeNacimiento}} </td>
	<td>{{$usuario->EstadoD}}  {{$usuario->DireccionEspecifica}}</td>
		<td>{{$usuario->Telefono}}</td>


		<td>

			{!!Form::open(['route'=>'Alquiler.create', 'method'=>'GET'])!!}
			{!!Form::text('id',$usuario->id, ['class'=>'form-control','style'=>'display:none'])!!}

			{!!Form::submit('Alquilar', $attributes=['class'=>'btn btn-success'])!!}
			{!!Form::close()!!}

			{!!link_to_route('Usuario.edit', $title = ' Editar Usuario ', $parameters = $usuario->id, $attributes = ['class'=>'btn btn-primary'])!!}
		<br><br>
			{!!Form::open(['route'=>['Usuario.destroy', $usuario->id], 'method'=>'DELETE'])!!}
	
	{!!Form::submit('Eliminar usuario ', ['class'=>'btn btn-danger'])!!}
{!!Form::close()!!}
		</td>
	</tr>
@endforeach
	</tbody>
</table></div>

@stop