<div class="from-group">
		{!!Form::label('Fecha Prevista de Devolucion')!!}

	@if(Session::has('fecha'))
		{!!Form::date('FechaDevolucion',Session::get('fecha'), ['class'=>'form-control', 'placeholder'=>'Ingrese la Fecha Prevista de Devolucion','min'=>\Carbon\Carbon::now()->format('Y-m-d'), 'max'=>\Carbon\Carbon::now()->addMonth(3)->format('Y-m-d'),'required'=>'required'])!!}
	@else

		{!!Form::date('FechaDevolucion',\Carbon\Carbon::now()->addDay()->format('Y-m-d'), ['class'=>'form-control', 'placeholder'=>'Ingrese la Fecha Prevista de Devolucion','min'=>\Carbon\Carbon::now()->format('Y-m-d'), 'max'=>\Carbon\Carbon::now()->addMonth(3)->format('Y-m-d'),'required'=>'required'])!!}
	@endif

		{!!Form::date('FechaActual',\Carbon\Carbon::now()->format('Y-m-d'), ['class'=>'form-control', 'placeholder'=>'Ingrese la Fecha Prevista de Devolucion','min'=>\Carbon\Carbon::now()->format('Y-m-d'), 'max'=>\Carbon\Carbon::now()->addMonth(3)->format('Y-m-d'),'required'=>'required','style'=>'display:none'])!!}
	@foreach($vehiculos as $vehiculo)
		{!!Form::label('Precio Por Dia del Vehiculo Seleccionado: ')!!}
		{!!Form::text('precio',$vehiculo->PrecioPorHora, ['readonly='=>'readonly='])!!}
		{!!Form::text('idVehiculo',$vehiculo->id, ['readonly='=>'readonly=','style'=>'display:none'])!!}
	@foreach($usuario as $usuarios)
		{!!Form::text('idUsuario',$usuarios->id, ['readonly='=>'readonly=','style'=>'display:none'])!!}
			<?php
			break;
			?>
	@endforeach

		<?php
		break;
		?>
	@endforeach

	</div>
