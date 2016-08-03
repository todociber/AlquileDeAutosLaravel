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

			{!!Form::open(['route'=>['MarcasEliminadas.store'], 'method'=>'POST'])!!}
			{!!Form::text('id',$marca->id, ['class'=>'form-control','style'=>'display:none'])!!}

	{!!Form::submit('Restaurar Marca', ['class'=>'btn btn-info'])!!}
{!!Form::close()!!}
		</td>
	</tr>
@endforeach
	</tbody>
</table>




@stop