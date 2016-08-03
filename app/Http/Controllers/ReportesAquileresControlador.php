<?php

namespace alquilerdeAutos\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use alquilerdeAutos\Http\Requests;
use alquilerdeAutos\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ReportesAquileresControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Reportes.fechas');
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

        $fechaInicial =$request['FechaInicial'];
        $fechaFinal = $request['FechaFinal'];

        if($fechaInicial < $fechaFinal){

            $fechaInicial =$request['FechaInicial'];
            $fechaFinal = $request['FechaFinal'];
            $alquilerDatos = DB::table('alquilers')
                ->join('vehiculos','alquilers.idVehiiculo', '=', 'vehiculos.id' )
                ->join('clientes', 'alquilers.idUsuario', '=', 'clientes.id')
                ->join('modelos', 'vehiculos.idModelo', '=', 'modelos.id')
                ->join('marcas', 'marcas.id', '=', 'modelos.idMarca')
                ->join('estado_alquilers', 'estado_alquilers.id', '=', 'alquilers.idEstadoAlquiler')
                ->where('alquilers.FechaDeRegistro','>=',$fechaInicial)
                ->where('alquilers.FechaDeRegistro','<=', $fechaFinal)
                ->select( 'vehiculos.*', 'clientes.*', 'modelos.*', 'marcas.*', 'estado_alquilers.Nombre as NombreEstado', 'alquilers.*')
                ->get();



            return view('Reportes.mostrarAlquileres',compact('alquilerDatos'));
        } else{
            Session::flash('tipo', 'danger');
            Session::flash('message', 'Fechas No validas');

            return Redirect::to('/ReportesAlquileres');

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
