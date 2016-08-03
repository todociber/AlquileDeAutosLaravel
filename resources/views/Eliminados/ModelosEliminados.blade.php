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
		<td>{{$modelo->nombreMarca}}</td>
		<td>

		<br><br>
			{!!Form::open(['route'=>['ModelosEliminados.store'], 'method'=>'POST'])!!}

			{!!Form::text('id',$modelo->id, ['style'=>'display:none'])!!}

	
	{!!Form::submit('Restaurar Modelos', ['class'=>'btn btn-info'])!!}
{!!Form::close()!!}
		</td>
	</tr>
@endforeach
	</tbody>
</table></div>

@stop