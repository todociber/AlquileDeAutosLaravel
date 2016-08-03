<?php

namespace alquilerdeAutos\Http\Controllers;

use Illuminate\Http\Request;
use alquilerdeAutos\Http\Requests;
use alquilerdeAutos\Http\Requests\ModeloValidacionRequest;
use alquilerdeAutos\Http\Controllers\Controller;
use alquilerdeAutos\Modelo;
use alquilerdeAutos\Marca;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;
use Redirect;

class ModeloControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelos= Modelo::all();
       $marca= Marca::orderBy('nombreMarca','asc')->lists('nombreMarca', 'id');
        return view('modelo.mostrar',compact('modelos','marca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marca= Marca::orderBy('nombreMarca','asc')->lists('nombreMarca', 'id');
        return view('modelo.crear', compact('marca'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModeloValidacionRequest $request)
    {
        Modelo::create([
            'Nombre' =>$request['Nombre'],
            'idMarca'=>$request['idMarca'],
        ]);
        return redirect('/Modelo')->with('message','El modelo se registro exitosamente');
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
        $modelo = Modelo::find($id);
        $marca= Marca::orderBy('nombreMarca','asc')->lists('nombreMarca', 'id');
        return view('modelo.edit',['modelo'=>$modelo, 'marca'=>$marca]);
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
            'Nombre'=>'required|unique:modelos,Nombre,'.$id,
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()){

            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput($request->all());
        }



        $modelo = Modelo::find($id);
        $modelo->fill($request->all());
        $modelo->save();
        Session::flash('message', 'Modelo Editado exitosamente');
        return Redirect::to('/Modelo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $Ncolor= DB::table('vehiculos')
            ->select(DB::raw('count(*) as N'))
            ->where('idModelo', $id)
            ->where('deleted_at', null)
            ->get();


        if($Ncolor[0]->N== 0){
        $modelo = Modelo::find($id);
        $modelo->delete();
            Session::flash('tipo','success');
        Session::flash('message', 'Modelo Eliminado exitosamente');
        return Redirect::to('/Modelo');
    }else {
            Session::flash('tipo','danger');
            Session::flash('message', 'Modelo no puede ser Eliminado');
            return Redirect::to('/Modelo');
        }

    }
}
