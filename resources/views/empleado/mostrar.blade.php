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
{!!link_to_route('Empleado.create', $title = 'Agregar Empleado',$parameters ='', $attributes = ['class'=>'btn btn-success', 'align'=>'center' ])!!}
</div>
<table class="table table-striped table-bordered dataTable"  id="dynamic-table">
	<thead>
		<th>id</th>
		<th>Nombre</th>
		<th>Numero de Doocumento</th>
		<th>email</th>
		<th>Fecha de Nacimiento</th>
		<th>Direccion</th>
		<th>Tipo Empleado</th>



		<th>Opciones</th>
	</thead><tbody>
	@foreach($usuarios as $usuario)
	<tr>
	<td>{{$usuario->id}}</td>
		<td>{{$usuario->PrimerNombre.' '.$usuario->SegundoNombre.' '.$usuario->PrimerApellido.' '.$usuario->SegundoApellido}}</td>
			<td>{{$usuario->nDocumento}} </td>
		<td>{{$usuario->email}}</td>
	<td>{{$usuario->FechaDeNacimiento}} </td>
	<td>{{$usuario->EstadoD}}  {{$usuario->DireccionEspecifica}}</td>
		<td>{{$usuario->tipoUsuario->Nombre}}</td>



		<td>



			{!!link_to_route('Empleado.edit', $title = ' Editar Empleado ', $parameters = $usuario->id, $attributes = ['class'=>'btn btn-primary'])!!}
		<br><br>
			{!!Form::open(['route'=>['Empleado.destroy', $usuario->id], 'method'=>'DELETE'])!!}
	
	{!!Form::submit('Eliminar Empleado ', ['class'=>'btn btn-danger'])!!}
{!!Form::close()!!}
		</td>
	</tr>
@endforeach
	</tbody>
</table></div>

@stop