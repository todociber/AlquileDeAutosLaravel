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

   @include('Reportes.formularios.formularioFechas')
<table class="table table-striped table-bordered dataTable"   id="dynamic-table" >
	<thead>

		<th>Usuario</th>
		<th>Número de Documento </th>
		<th>Precio</th>
		<th>Vehiculo</th>
		<th>Fecha de Pedido</th>
		<th>Fecha de Entrega Prevista</th>
		<th>Estado Alquiler</th>
		<th>Opciones</th>
	</thead><tbody>
	<?php $total = 0; ?>
	@foreach($alquilerDatos as $alquiler)
		<tr class="gradeX">

	<td>{{$alquiler->PrimerNombre}} {{$alquiler->PrimerApellido}}</td>
	<td>{{$alquiler->nDocumento}}</td>
	<td>{{"$".$alquiler->pago}}   <?php $total = $total+$alquiler->pago ; ?></td>
	<td> {{$alquiler->nombreMarca}}  {{$alquiler->Nombre}}</td>
	<td>{{$alquiler->FechaDeRegistro}}</td>
	<td>{{$alquiler->FechaDeEntregaPrevisto}}</td>
	<td>{{$alquiler->NombreEstado}}</td>

		<td>

			@if ($alquiler->NombreEstado=='En Curso')
			{!!link_to_route('Alquiler.edit', $title = ' Editar Alquiler ', $parameters = $alquiler->id, $attributes = ['class'=>'btn btn-primary'])!!}
		<br><br>
			{!!Form::open(['route'=>['AlquilerExitoso.destroy', $alquiler->id], 'method'=>'DELETE'])!!}

			{!!Form::submit('Terminar  Alquiler ', ['class'=>'btn btn-success'])!!}
			{!!Form::close()!!}


			{!!Form::open(['route'=>['Alquiler.destroy', $alquiler->id], 'method'=>'DELETE'])!!}
	
	{!!Form::submit('Cancelar Alquiler ', ['class'=>'btn btn-danger'])!!}
{!!Form::close()!!}
				@else
				{!!Form::label('Proceso de alquiler Finalizado ')!!}
				{!!link_to_route('AlquilerExitoso.edit', $title = ' Reactivar Alquiler ', $parameters = $alquiler->id, $attributes = ['class'=>'btn btn-warning'])!!}
			@endif

		</td>
</tr>
@endforeach</tbody>
	<div class="alert alert-info alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		El total de ganancias durante este periodo fue de: ${{$total}} Dolares
	</div>
</table></div>

@stop