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
{!!link_to_route('Vehiculo.create', $title = 'Agregar Vehiculo',$parameters ='', $attributes = ['class'=>'btn btn-success', 'align'=>'center' ])!!}
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
			@if($vehiculo->condicion->Nombre=='Ocupado')
				{!!link_to_route('Alquiler.index', $title = ' Vehiculo en uso  ', $parameters = '', $attributes = ['class'=>'btn btn-warning'])!!}
			@else
				{!!link_to_route('Vehiculo.edit', $title = ' Editar Vehiculo ', $parameters = $vehiculo->id, $attributes = ['class'=>'btn btn-primary'])!!}
				<br><br>
				{!!Form::open(['route'=>['Vehiculo.destroy', $vehiculo->id], 'method'=>'DELETE'])!!}

				{!!Form::submit('Eliminar Vehiculo', ['class'=>'btn btn-danger'])!!}
				{!!Form::close()!!}
		</td>

			@endif

	</tr>
@endforeach</tbody>

</table>

@stop