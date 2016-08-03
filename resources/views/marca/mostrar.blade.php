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
{!!link_to_route('Marca.create', $title = 'Agregar Marca',$parameters ='', $attributes = ['class'=>'btn btn-success', 'align'=>'center' ])!!}
</div>



<table class="table table-striped table-bordered dataTable" id="dynamic-table" >

	<thead>
		<th>idMarca</th>
		<th>Nombre</th>
		<th>Opciones</th>
	</thead><tbody>
	@foreach($marcas as $marca)
	<tr>
	<td>{{$marca->id}}</td>
		<td>{{$marca->nombreMarca}}</td>

		<td>
			{!!link_to_route('Marca.edit', $title = ' Editar Marca ', $parameters = $marca->id, $attributes = ['class'=>'btn btn-primary'])!!}
		<br><br>
			{!!Form::open(['route'=>['Marca.destroy', $marca->id], 'method'=>'DELETE'])!!}
	
	{!!Form::submit('Eliminar Marca', ['class'=>'btn btn-danger'])!!}
{!!Form::close()!!}
		</td>
	</tr>
@endforeach
	</tbody>
</table></div>

@stop