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
{!!link_to_route('Modelo.create', $title = 'Agregar Modelo',$parameters ='', $attributes = ['class'=>'btn btn-success', 'align'=>'center' ])!!}
</div>
<table class="table table-striped table-bordered dataTable"  id="dynamic-table" >
	<thead>
		<th>id</th>
		<th>Nombre</th>
		<th>Marca</th>
		<th>Opciones</th>
	</thead><tbody>
	@foreach($modelos as $modelo)
	<tr>
	<td>{{$modelo->id}}</td>
		<td>{{$modelo->Nombre}}</td>
		<td>{{$modelo->marca->nombreMarca}}</td>
		<td>
			{!!link_to_route('Modelo.edit', $title = ' Editar Modelo ', $parameters = $modelo->id, $attributes = ['class'=>'btn btn-primary'])!!}
		<br><br>
			{!!Form::open(['route'=>['Modelo.destroy', $modelo->id], 'method'=>'DELETE'])!!}
	
	{!!Form::submit('Eliminar modelo', ['class'=>'btn btn-danger'])!!}
{!!Form::close()!!}
		</td>
	</tr>
@endforeach
	</tbody>
</table></div>

@stop