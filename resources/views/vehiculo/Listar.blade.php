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
		<th>Kilometraje</th>
		<th>Precio Por Dia</th>
		<th>Color</th>
		<th>Modelo</th>
		<th>Placa</th>

		<th>a&ntildeo</th>
		<th>Condicion</th>
		<th>Opciones</th>

	</thead><tbody>
	@foreach($vehiculos as $vehiculo)
		@if ($vehiculo->condicion->Nombre=='Disponible')
	<tr>
	<td>{{$vehiculo->id}}</td>
		<td>{{$vehiculo->Kilometraje}}</td>
	<td>{{$vehiculo->PrecioPorHora}}</td>
	<td>{{$vehiculo->color->Nombre}}</td>
	<td>{{$vehiculo->modelo->Nombre}}</td>
		<td>{{$vehiculo->placa}}</td>

		<td>{{$vehiculo->anio}}</td>
	<td>{{$vehiculo->condicion->Nombre}}</td>


		<td>




			{!!Form::open(['route'=>'AlquilerVehiculo.create', 'method'=>'GET'])!!}

			{!!Form::text('idUsuario',Session::get('idUsuario'), ['style'=>'display:none'])!!}
			{!!Form::text('idVehiculo',$vehiculo->id, ['style'=>'display:none'])!!}

			{!!Form::submit('Cotizar Vehiculo', ['class'=>'btn btn-info'])!!}
			{!!Form::close()!!}


		<br><br>

		</td>
	</tr>
		@endif
@endforeach
	</tbody>
</table>

@stop