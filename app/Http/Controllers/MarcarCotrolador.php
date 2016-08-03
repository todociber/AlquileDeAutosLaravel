<?php

namespace alquilerdeAutos\Http\Controllers;

use Illuminate\Http\Request;
use alquilerdeAutos\Http\Requests;
use alquilerdeAutos\Http\Requests\MarcaValidacionRequest;
use alquilerdeAutos\Http\Controllers\Controller;
use alquilerdeAutos\Marca;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
class MarcarCotrolador extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $marcas= Marca::all();
        return view('marca.mostrar',compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marca.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MarcaValidacionRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarcaValidacionRequest $request)
    {
        Marca::create([
            'nombreMarca' =>$request['nombreMarca'],
            ]);
        return redirect('/Marca')->with('message','La Marca se registro exitosamente')->with('tipo', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param $idMarca
     * @internal param int $idMarca
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param $idMarca
     * @internal param int $Marca
     */
    public function edit($id)
    {
        $marca = Marca::find($id);
        return view('marca.edit',['marca'=>$marca]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MarcaValidacionRequest|Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param $idMarca
     * @internal param int $idMarca
     */
    public function update(Request $request, $id)
    {
        $rules = array(
        'nombreMarca'=>'required|unique:marcas,nombreMarca,'.$id,
    );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()){

            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput($request->all());
        }




        $marca = Marca::find($id);
        $marca->fill($request->all());
        $marca->save();
        Session::flash('message', 'Marca Editada exitosamente');
        Session::flash('tipo', 'success');
        return Redirect::to('/Marca');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param $idMarca
     * @internal param int $idMarca
     */
    public function destroy($id)
    {
        $Ncolor= DB::table('modelos')
            ->select(DB::raw('count(*) as N'))
            ->where('idMarca', $id)
            ->where('deleted_at', null)
            ->get();
        if($Ncolor[0]->N== 0) {
            $marca = Marca::find($id);
            $marca->delete();
            Session::flash('message', 'Marca Eliminada exitosamente');
            return Redirect::to('/Marca');

        }else{

            Session::flash('tipo','danger');
            Session::flash('message', 'No se puede eliminar la Marca');
            return Redirect::to('/Marca');
        }
    }
}
