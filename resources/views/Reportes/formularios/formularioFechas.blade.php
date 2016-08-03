<div style="text-align: center;">
    {!!Form::open([ 'name'=>'drop_list','route'=>'ReportesAlquileres.store', 'method'=>'POST'])!!}
    {!!Form::label('Ingrese las Fechas de las cuales desea ver los alquileres')!!}
    <br>
    {!!Form::label('Fecha Inicial')!!}
    {!!Form::date('FechaInicial',\Carbon\Carbon::now()->subMonth(1)->format('Y-m-d'), ['class'=>'form-control', 'placeholder'=>'Ingrese la Fecha Prevista de Devolucion', 'max'=>\Carbon\Carbon::now()->format('Y-m-d'),'required'=>'required'])!!}
    <br>
    {!!Form::label('Fecha Final')!!}
    {!!Form::date('FechaFinal',\Carbon\Carbon::now()->format('Y-m-d'), ['class'=>'form-control', 'placeholder'=>'Ingrese la Fecha Prevista de Devolucion', 'max'=>\Carbon\Carbon::now()->format('Y-m-d'),'required'=>'required'])!!}
    <br>
    {!!Form::submit('Buscar Alquileres', ['class'=>'btn btn-primary'])!!}
    {!!Form::close()!!}</div>