@extends('layouts.PAdmin')
@section('content')



<div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Cotizar Vehiculo</div></div>
                                 <div class="control-group" align="center" >


@include('modelo.alertas.errores')

                                     
{!!Form::open(['route'=>'AlquilerVehiculo.store', 'method'=>'POST', 'name'=> 'alquilar'])!!}
                                     @if(Session::has('message'))
                                         <div class="alert alert-success alert-dismissible" role="alert">
                                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                             {{Session::get('message')}}
                                         </div>
                                     @endif
	@include('alquiler.formularios.formularioUsuario')

	{!!Form::submit('Calcular Costo', ['class'=>'btn btn-info'])!!}

                                     {!!Form::submit('Alquilar', ['class'=>'btn btn-success', 'name'=>'Alquilar' , 'value'=>'Alquilar'])!!}



                                     {!!Form::close()!!}
{!!link_to_route('AlquilerVehiculo.store', $title = 'Cancelar',$parameters ='idUsuario='.$usuario[0]->id.'&idModelo='.$vehiculos[0]->idModelo, $attributes = ['class'=>'btn btn-warning', 'align'=>'center' ])!!}

</div>
@stop