<?php

namespace alquilerdeAutos\Http\Controllers;

use alquilerdeAutos\Marca;
use alquilerdeAutos\modelo;
use Illuminate\Http\Request;
use alquilerdeAutos\Http\Requests;
use alquilerdeAutos\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ControladorModelosEliminados extends Controller
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

            $modelos = Modelo::onlyTrashed()
                ->join('marcas', 'marcas.id', '=', 'modelos.idMarca')
                ->select('modelos.*', 'marcas.nombreMarca')
                ->get();
            return view('Eliminados.ModelosEliminados', compact('modelos'));
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

        $idARestaurar= $request['id'];

        $model = DB::table('modelos')->where('id', $idARestaurar)->get();
        $idMarca = $model[0]->idMarca;
        Marca::withTrashed()->where('id', $idMarca)->restore();
        Modelo::withTrashed()->where('id', $idARestaurar)->restore();

        Session::flash('tipo', 'success');
        Session::flash('message', 'Modelo restaurado exitosamente');
        return Redirect::to('/ModelosEliminados');
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
