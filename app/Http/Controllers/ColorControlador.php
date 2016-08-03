<?php

namespace alquilerdeAutos\Http\Controllers;

use Illuminate\Http\Request;
use alquilerdeAutos\Http\Requests;
use alquilerdeAutos\Http\Requests\ColorValidacionRequest;
use alquilerdeAutos\Http\Controllers\Controller;
use alquilerdeAutos\Color;
use Illuminate\Support\Facades\DB;
use Session;
use Redirect;
class ColorControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors= Color::all();
        return view('color.mostrar',compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('color.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ColorValidacionRequest $request)
    {
        Color::create([
            'Nombre' =>$request['Nombre'],
        ]);
        return redirect('/Color')->with('message','El Color se registro exitosamente')->with('tipo', 'success');
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
        $color = Color::find($id);
        return view('color.edit',['color'=>$color]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ColorValidacionRequest $request, $id)
    {
        $color = Color::find($id);
        $color->fill($request->all());
        $color->save();
        Session::flash('tipo', 'success');
        Session::flash('message', 'Color Editado exitosamente');
        return Redirect::to('/Color');
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
            ->where('idColor', $id)
            ->where('deleted_at', null)
            ->get();


        if($Ncolor[0]->N== 0){
        $color = Color::find($id);
        $color->delete();
            Session::flash('tipo', 'success');
        Session::flash('message', 'Color Eliminado exitosamente');
        return Redirect::to('/Color');
        }else {
            Session::flash('tipo', 'danger');
            Session::flash('message', 'Color no puede ser Eliminado');
            return Redirect::to('/Color');
        }
    }
}
