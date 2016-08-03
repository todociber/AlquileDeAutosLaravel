<?php

namespace alquilerdeAutos\Http\Controllers;

use Illuminate\Http\Request;
use alquilerdeAutos\Http\Requests;
use alquilerdeAutos\Http\Requests\CondicionValidacionRequest;
use alquilerdeAutos\Http\Controllers\Controller;
use alquilerdeAutos\Condicion;
use Session;
use Redirect;

class CondicionControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $condicions= Condicion::paginate(5);
        return view('condicion.mostrar',compact('condicions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('condicion.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CondicionValidacionRequest $request)
    {
        Condicion::create([
            'Nombre' =>$request['Nombre'],
        ]);
        return redirect('/Condicion')->with('message','La Condicion se registro exitosamente');
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
        $condicion = Condicion::find($id);
        return view('condicion.edit',['condicion'=>$condicion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CondicionValidacionRequest $request, $id)
    {
        $condicion = Condicion::find($id);
        $condicion->fill($request->all());
        $condicion->save();
        Session::flash('message', 'Condicion editada exitosamente');
        return Redirect::to('/Condicion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $condicion = Condicion::find($id);
        $condicion->delete();
        Session::flash('message', 'Conidcion Eliminada exitosamente');
        return Redirect::to('/Condicion');
    }
}
