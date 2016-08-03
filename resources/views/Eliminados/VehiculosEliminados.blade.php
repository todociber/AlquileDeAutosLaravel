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



<table class="table table-striped table-bordered dataTable"   id="dynamic-table">

	<thead>
		<th>id</th>
		<th>Kilometraje</th>
		<th>Precio Por Dia</th>
		<th>Color</th>

		<th>Modelo</th>
		<th>Placa</th>
		<th>a&ntildeo</th>

		<th>Opciones</th>

	</thead><tbody>
	@foreach($vehiculos as $vehiculo)
	<tr>
	<td>{{$vehiculo->id}}</td>
		<td>{{$vehiculo->Kilometraje}}</td>
	<td>{{$vehiculo->PrecioPorHora}}</td>
	<td>{{$vehiculo->NombreColor}}</td>


	<td>{{$vehiculo->nombreMarca}} {{$vehiculo->NombreModelo}}</td>
		<td>{{$vehiculo->placa}}</td>
		<td>{{$vehiculo->anio}}</td>



		<td>

				{!!Form::open(['route'=>['VehiculosEliminados.store'], 'method'=>'Post'])!!}
			{!!Form::text('id',$vehiculo->id, ['style'=>'display:none'])!!}
				{!!Form::submit('Restaurar Vehiculo', ['class'=>'btn btn-info'])!!}
				{!!Form::close()!!}
		</td>


	</tr>
@endforeach</tbody>

</table>

@stop