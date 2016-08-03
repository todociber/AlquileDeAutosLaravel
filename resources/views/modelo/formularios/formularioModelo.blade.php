<div class="from-group">

	{!!Form::label('Marca')!!}
	{!! Form::select('idMarca', $marca, null, ['class' => 'form-control']) !!}
		{!!Form::label('Nombre del Modelo')!!}
		{!!Form::text('Nombre',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el nombre del Modelo'])!!}

	</div>
