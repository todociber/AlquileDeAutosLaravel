<div class="from-group">
		{!!Form::label('Kilometraje del auto')!!}
		{!!Form::number('Kilometraje',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el Kilometraje del auto ','min'=>'0','step'=>'any'])!!}
		{!!Form::label('Precio por Dia')!!}
		{!!Form::number('PrecioPorHora',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el precio por Dia ','min'=>'1', 'step'=>'any'])!!}
	{!!Form::label('Numero de Placa')!!}
	{!!Form::number('placa',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el numero de placa ','min'=>'0'])!!}
	{!!Form::label('Año de Fabricacion')!!}
	{!!Form::number('anio',null, ['class'=>'form-control', 'placeholder'=>'Ingrese la fecha de fabricacion ','min'=>'1980' ,'max'=>Carbon\Carbon::now()->addYears(1)->format('Y')])!!}

	{!!Form::label('Color')!!}
		{!! Form::select('idColor', $colors, null, ['class' => 'form-control']) !!}

		{!!Form::label('Modelo')!!}
		{!! Form::select('idModelo', $modelos, null, ['class' => 'form-control']) !!}
		{!!Form::label('Condicion')!!}
		{!! Form::select('idCondicion', $condicion, null, ['class' => 'form-control']) !!}
</div>