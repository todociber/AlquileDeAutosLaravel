@extends('layouts.PAdmin')
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  {{Session::get('message')}}
</div>
@endif
@section('content')
   <div class="control-group" align="center" >
   <br>
{!!link_to_route('Condicion.create', $title = 'Agregar Condicion',$parameters ='', $attributes = ['class'=>'btn btn-success', 'align'=>'center' ])!!}
</div>
<table class="table table-striped table-bordered dataTable"   id="dynamic-table">
	<thead>
		<th>id</th>
		<th>Nombre</th>
		<th>Opciones</th>
	</thead><tbody>
	@foreach($condicions as $condicion)
	<tr>
	<td>{{$condicion->id}}</td>
		<td>{{$condicion->Nombre}}</td>
		<td>
			{!!link_to_route('Condicion.edit', $title = ' Editar Condicion ', $parameters = $condicion->id, $attributes = ['class'=>'btn btn-primary'])!!}
		<br><br>
			{!!Form::open(['route'=>['Condicion.destroy', $condicion->id], 'method'=>'DELETE'])!!}
	
	{!!Form::submit('Eliminar Condicion', ['class'=>'btn btn-danger'])!!}
{!!Form::close()!!}
		</td>
	</tr>
@endforeach</tbody>

</table></div>{!!$condicions->render()!!}

@stop