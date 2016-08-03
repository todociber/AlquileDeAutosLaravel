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

			<br><br>
			{!!Form::open(['route'=>['UsuariosEliminados.store'], 'method'=>'post'])!!}
			{!!Form::text('id',$usuario->id, ['style'=>'display:none'])!!}
	{!!Form::submit('Restaurar usuario ', ['class'=>'btn btn-info'])!!}
{!!Form::close()!!}
		</td>
	</tr>
@endforeach
	</tbody>
</table></div>

@stop