<?php

namespace alquilerdeAutos\Http\Controllers;

use Illuminate\Http\Request;
use alquilerdeAutos\Http\Requests;
use alquilerdeAutos\Http\Controllers\Controller;
use alquilerdeAutos\Http\Requests\VehiculoValidacionRequest;
use alquilerdeAutos\Vehiculo;
use alquilerdeAutos\Color;
use alquilerdeAutos\Condicion;
use alquilerdeAutos\Modelo;
use alquilerdeAutos\Marca;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;
use Redirect;

class VehiculoControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $idModelo= $request['idModelo'];

         $colors= Color::all();
        $condicion= Condicion::all();
        $modelos= Modelo::all();
        $marca= Marca::all();
        $vehiculos= Vehiculo::ofType($idModelo)->get();
        return view('vehiculo.mostrar',compact('vehiculos','colors','condicion','modelos','marca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = Color::orderBy('Nombre', 'asc')->lists('Nombre', 'id');
        $condicion= Condicion::orderBy('Nombre','asc')
            ->where('id', 1)
            ->orWhere('id',3)
            ->lists('Nombre', 'id');



        $modelos = DB::table('modelos')
            ->join('marcas', 'marcas.id', '=', 'modelos.idMarca')
            ->select('modelos.id', DB::raw('concat(marcas.nombreMarca, " ", modelos.Nombre ) as Nombre'))
            ->lists('Nombre', 'id');
        $marca= Marca::orderBy('nombreMarca','asc')->lists('nombreMarca', 'id');
        $vehiculos= Vehiculo::all();
        return view('vehiculo.crear',compact('vehiculos','colors','condicion','modelos','marca'));



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehiculoValidacionRequest $request)
    {
       Vehiculo::create([
            'Kilometraje' =>$request['Kilometraje'],
           'PrecioPorHora' =>$request['PrecioPorHora'],
           'placa'=>$request['placa'],
           'anio'=>$request['anio'],
           'idColor' =>$request['idColor'],
           'idModelo' =>$request['idModelo'],
           'idCondicion' =>$request['idCondicion'],
       ]);
        return redirect('/Vehiculo')->with('message','El Vehiculo se registro exitosamente')->with('tipo', 'success');

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
        $vehiculo = Vehiculo::find($id);
        $colors = Color::orderBy('Nombre', 'asc')->lists('Nombre', 'id');
        $condicion= Condicion::orderBy('Nombre','asc')
            ->where('id', 1)
            ->orWhere('id',3)
            ->lists('Nombre', 'id');
        $modelos = DB::table('modelos')
            ->join('marcas', 'marcas.id', '=', 'modelos.idMarca')
            ->select('modelos.id', DB::raw('concat(marcas.nombreMarca, " ", modelos.Nombre ) as Nombre'))
            ->lists('Nombre', 'id');
        $marca= Marca::orderBy('nombreMarca','asc')->lists('nombreMarca', 'id');
        return view('vehiculo.edit',['vehiculo'=>$vehiculo, 'colors'=>$colors, 'condicion'=>$condicion,'modelos'=>$modelos,'marca'=>$marca]);
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
        $rules = array(
            'Kilometraje'=>'required',
            'PrecioPorHora'=>'required',
            'placa'=>'required|min:8|max:8|unique:vehiculos,placa,'.$id,
            'anio'=>'required',
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()){

            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput($request->all());
        }
        $vehiculo = Vehiculo::find($id);
        $vehiculo->fill($request->all());
        $vehiculo->save();

        Session::flash('message', 'Vehiculo Editado exitosamente');
        Session::flash('tipo', 'success');
        return Redirect::to('/Vehiculo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $Ncolor= DB::table('alquilers')
            ->select(DB::raw('count(*) as N'))
            ->where('idVehiiculo', $id)
            ->where('idEstadoAlquiler', 1)
            ->where('deleted_at', null)
            ->get();



        if($Ncolor[0]->N== 0) {
            $vehiculo = Vehiculo::find($id);

            $vehiculo->delete();
            Session::flash('tipo','success');
            Session::flash('message', 'Vehoculo Eliminado exitosamente');
            return Redirect::to('/Vehiculo');
        }else{
            Session::flash('tipo','danger');
            Session::flash('message', 'Vehiculo no puede ser Eliminado');
            return Redirect::to('/Vehiculo');
        }

    }
}
