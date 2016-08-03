<?php

namespace alquilerdeAutos\Http\Controllers;

use alquilerdeAutos\cliente;
use alquilerdeAutos\color;
use alquilerdeAutos\Marca;
use alquilerdeAutos\VehiculoEstado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use alquilerdeAutos\Http\Requests;
use alquilerdeAutos\Http\Controllers\Controller;
use alquilerdeAutos\alquiler;
use alquilerdeAutos\User;
use alquilerdeAutos\Vehiculo;
use alquilerdeAutos\estado_alquiler;
use alquilerdeAutos\alquilerFinalizar;
use alquilerdeAutos\Modelo;
use Illuminate\Support\Facades\DB;
use Session;
use Redirect;


class AlquilerExitoso extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "Hola desde el controlador";
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "creacion";
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alquileresEdit = alquiler::ofType($id)->get();
        foreach($alquileresEdit as $a ){
            $idUsuario = $a->idUsuario;
            $idVehiculo= $a->idVehiiculo;
            $FechaActual= $a->FechaDeRegistro;
            $FechaPrevista = $a->FechaDeEntregaPrevisto;
        }

        $alquileresActivos = DB::table('alquilers')
            ->where('idUsuario', $idUsuario)
            ->where('idEstadoAlquiler', '1')
            ->select(DB::raw('count(*) as NA'))
            ->get();
        if($alquileresActivos[0]->NA==0){

            $vehiculosEnUso =  DB::table('alquilers')
                ->where('idVehiiculo', $idVehiculo)
                ->where('idEstadoAlquiler', '1')
                ->select(DB::raw('count(*) as NA'))
                ->get();

            if($vehiculosEnUso[0]->NA==0){
                $vehiculo = DB::table('vehiculos')
                    ->where('id', $idVehiculo)
                    ->get();
                $idColor= $vehiculo[0]->idColor;


                $idmodelo = $vehiculo[0]->idModelo;

                $model = DB::table('modelos')->where('id', $idmodelo)->get();
                $idMarca = $model[0]->idMarca;

                cliente::withTrashed()->where('id', $idUsuario)->restore();
                Marca::withTrashed()->where('id', $idMarca)->restore();
                Modelo::withTrashed()->where('id', $idmodelo)->restore();
                Color::withTrashed()->where('id', $idColor)->restore();
                Vehiculo::withTrashed()->where('id', $idVehiculo)->restore();


                $VehiculoEstado = VehiculoEstado::find($idVehiculo);
                $VehiculoEstado->fill([
                    'idCondicion'=>'2'
                ]);
                $VehiculoEstado->save();

                $FechaDevolucion= Carbon::now()->addDay()->format('Y-m-d');

                $vehiculos= Vehiculo::ofType2($idVehiculo)->get();
                foreach($vehiculos as $vehiculo){
                    $precio = $vehiculo->PrecioPorHora;
                }

                $F1= Carbon::createFromFormat('Y-m-d',$FechaPrevista);
                $F2=Carbon::createFromFormat('Y-m-d',$FechaActual);
                $Diferencia= $F1->diffInDays($F2);
                $Total=$precio;
                if($Diferencia==0){

                }else{
                    $Total=$precio*$Diferencia;
                }

                $actualizarAlquiler = alquilerFinalizar::find($id);
                $actualizarAlquiler->fill([
                    'FechaDeEntrega'=> $FechaDevolucion,
                    'pago'=>$Total,
                    'idEstadoAlquiler'=> 1,
                ]);
                $actualizarAlquiler->save();
                Session::flash('tipo', 'success');
                Session::flash('message', 'Alquiler Activado exitosamente');
                return Redirect::to('/Alquiler');


            }else{
                Session::flash('tipo', 'danger');
                Session::flash('message', 'El Auto se encuentra alquilado');
                return Redirect::to('/Alquiler');
            }

        }else {
            Session::flash('tipo', 'danger');
            Session::flash('message', 'El usuario ya tiene un alquiler en curso');
            return Redirect::to('/Alquiler');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alquileresEdit = alquiler::ofType($id)->get();
        foreach($alquileresEdit as $a ){
            $idVehiculo= $a->idVehiiculo;
            $FechaActual= $a->FechaDeRegistro;
        }



        $VehiculoEstado = VehiculoEstado::find($idVehiculo);
        $VehiculoEstado->fill(
            [
                'idCondicion'=>'3'
            ]
        );
        $VehiculoEstado->save();

        $FechaDevolucion= Carbon::now()->addDay()->format('Y-m-d');

        $vehiculos= Vehiculo::ofType2($idVehiculo)->get();
        foreach($vehiculos as $vehiculo){
            $precio = $vehiculo->PrecioPorHora;
        }

        $F1= Carbon::createFromFormat('Y-m-d',$FechaDevolucion);
        $F2=Carbon::createFromFormat('Y-m-d',$FechaActual);
        $Diferencia= $F1->diffInDays($F2);
        $Total=$precio;
        if($Diferencia==0){

        }else{
            $Total=$precio*$Diferencia;
        }

        $actualizarAlquiler = alquilerFinalizar::find($id);
        $actualizarAlquiler->fill([
            'FechaDeEntrega'=> $FechaDevolucion,
            'pago'=>$Total,
            'idEstadoAlquiler'=> 2,
        ]);
        $actualizarAlquiler->save();
        Session::flash('tipo', 'warning');
        Session::flash('message', 'Alquiler Cancelado exitosamente');
        return Redirect::to('/Alquiler');
    }
}
