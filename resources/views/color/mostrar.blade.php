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
{!!link_to_route('Color.create', $title = 'Agregar Color',$parameters ='', $attributes = ['class'=>'btn btn-success', 'align'=>'center' ])!!}
</div>
<table class="table table-striped table-bordered dataTable"   id="dynamic-table">
	<thead>
		<th>id</th>
		<th>Nombre</th>
		<th>Opciones</th>
	</thead><tbody>
	@foreach($colors as $color)

	<tr class="gradeX">
	<td>{{$color->id}}</td>
		<td>{{$color->Nombre}}</td>
		<td>
			{!!link_to_route('Color.edit', $title = ' Editar Color ', $parameters = $color->id, $attributes = ['class'=>'btn btn-primary'])!!}
		<br><br>
			{!!Form::open(['route'=>['Color.destroy', $color->id], 'method'=>'DELETE'])!!}
	
	{!!Form::submit('Eliminar Color', ['class'=>'btn btn-danger'])!!}
{!!Form::close()!!}
		</td></tr>

@endforeach
	</tbody>
</table></div>
@stop