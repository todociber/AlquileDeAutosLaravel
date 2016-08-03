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

		<br><br>
			{!!Form::open(['route'=>['ColorEliminado.store', $color->id], 'method'=>'POST'])!!}
			{!!Form::text('id',$color->id, ['class'=>'form-control','style'=>'display:none'])!!}
	{!!Form::submit('Restaurar Color', ['class'=>'btn btn-info'])!!}
{!!Form::close()!!}
		</td></tr>

@endforeach
	</tbody>
</table></div>

@stop