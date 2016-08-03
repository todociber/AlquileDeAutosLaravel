<?php

namespace alquilerdeAutos\Http\Controllers;

use alquilerdeAutos\color;
use alquilerdeAutos\condicion;
use alquilerdeAutos\Marca;
use alquilerdeAutos\modelo;
use alquilerdeAutos\vehiculo;
use Illuminate\Http\Request;
use alquilerdeAutos\Http\Requests;
use alquilerdeAutos\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ControladorVehiculosEliminados extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tipo= Auth::user()->idTipoUsuario;
        if ($tipo ==1) {
            $vehiculos = Vehiculo::onlyTrashed()
                ->join('colors', 'colors.id', '=', 'vehiculos.idColor')
                ->join('modelos', 'modelos.id', '=', 'vehiculos.idModelo')
                ->join('marcas', 'marcas.id', '=', 'modelos.idMarca')
                ->select('colors.Nombre as NombreColor', 'modelos.Nombre as NombreModelo', 'marcas.nombreMarca', 'vehiculos.*')
                ->get();;
            return view('Eliminados.VehiculosEliminados', compact('vehiculos'));
        }else{
            return Redirect::to('/Alquiler');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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


        $tipo= Auth::user()->idTipoUsuario;
        if ($tipo ==1) {
            $idVehiculo = $request['id'];


            $vehiculo = DB::table('vehiculos')
                ->where('id', $idVehiculo)
                ->get();
            $idColor = $vehiculo[0]->idColor;


            $idmodelo = $vehiculo[0]->idModelo;

            $model = DB::table('modelos')->where('id', $idmodelo)->get();
            $idMarca = $model[0]->idMarca;


            Marca::withTrashed()->where('id', $idMarca)->restore();
            Modelo::withTrashed()->where('id', $idmodelo)->restore();
            Color::withTrashed()->where('id', $idColor)->restore();
            Vehiculo::withTrashed()->where('id', $idVehiculo)->restore();


            Session::flash('tipo', 'success');
            Session::flash('message', 'Vehiculo restaurado exitosamente');
            return Redirect::to('/VehiculosEliminados');
        }else{
            return Redirect::to('/Alquiler');
        }
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
        //
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
        //
    }
}
