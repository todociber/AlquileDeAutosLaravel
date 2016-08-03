<?php

namespace alquilerdeAutos\Http\Controllers;

use alquilerdeAutos\cliente;
use Illuminate\Http\Request;
use alquilerdeAutos\Http\Requests;
use alquilerdeAutos\Http\Controllers\Controller;
use alquilerdeAutos\Http\Requests\UsuarioValidacionRequest;
use alquilerdeAutos\User;
use alquilerdeAutos\pais;
use alquilerdeAutos\tipo_usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;
use Redirect;

class UsuarioControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pais= pais::all();
        $tipo = tipo_usuario::all();
        $usuarios= cliente::all();
        return view('usuario.mostrar',compact('usuarios','pais', 'tipo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $pais= pais::orderBy('Nombre','asc')->lists('Nombre', 'id');

        return view('usuario.crear', compact('pais'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioValidacionRequest $request)
    {
        cliente::create([
            'PrimerNombre'=>$request['PrimerNombre'],
            'SegundoNombre'=>$request['SegundoNombre'],
            'PrimerApellido'=>$request['PrimerApellido'],
            'SegundoApellido'=>$request['SegundoApellido'],
            'genero'=>$request['genero'],
            'nDocumento'=>$request['nDocumento'],
            'EstadoD'=>$request['EstadoD'],
            'DireccionEspecifica'=>$request['DireccionEspecifica'],
            'CodigoPostal'=>$request['CodigoPostal'],
            'FechaDeNacimiento'=>$request['FechaDeNacimiento'],
            'idPaisUser'=>$request['idPaisUser'],
            'Telefono'=>$request['Telefono'],
            'idTipoUsuario'=>'3',
        ]);
        return redirect('/Usuario')->with('message','El cliente se registro exitosamente')->with('tipo','success');
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
        $cliente = cliente::find($id);
        $pais= pais::orderBy('Nombre','asc')->lists('Nombre', 'id');
        return view('usuario.edit',['usuarios'=>$cliente, 'pais'=>$pais]);
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
            'PrimerNombre'=>'required',
            'SegundoNombre'=>'required',
            'PrimerApellido'=>'required',
            'SegundoApellido'=>'required',
            'genero'=>'required',
            'nDocumento'=>'min:9|max:15required|unique:clientes,nDocumento,'.$id,
            'EstadoD'=>'required',
            'DireccionEspecifica'=>'required',
            'CodigoPostal'=>'required',
            'FechaDeNacimiento'=>'required',
            'idPaisUser'=>'required',
            'Telefono'=>'min:8|max:8|required|unique:clientes,Telefono,'.$id,
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()){

            return redirect()->back()
                ->withErrors($error->errors())
                ->withInput($request->all());
        }
        $usuario = cliente::find($id);
        $usuario->fill(
            [
                'PrimerNombre'=>$request['PrimerNombre'],
                'SegundoNombre'=>$request['SegundoNombre'],
                'PrimerApellido'=>$request['PrimerApellido'],
                'SegundoApellido'=>$request['SegundoApellido'],
                'genero'=>$request['genero'],
                'nDocumento'=>$request['nDocumento'],
                'EstadoD'=>$request['EstadoD'],
                'DireccionEspecifica'=>$request['DireccionEspecifica'],
                'CodigoPostal'=>$request['CodigoPostal'],
                'FechaDeNacimiento'=>$request['FechaDeNacimiento'],
                'idPaisUser'=>$request['idPaisUser'],
                'Telefono'=>$request['Telefono'],
                'idTipoUsuario'=>'3',
            ]

        );
        $usuario->save();

        Session::flash('message', 'Usuario actualizado exitosamente');
        return Redirect::to('/Usuario');
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
            ->where('idUsuario', $id)
            ->where('idEstadoAlquiler', 1)
            ->where('deleted_at', null)
            ->get();

        if($Ncolor[0]->N== 0) {
            $cliente = cliente::find($id);
            $cliente->delete();
            Session::flash('tipo','success');
            Session::flash('message', 'Cliente Eliminado exitosamente');
            return Redirect::to('/Usuario');

        }else {

            Session::flash('tipo','danger');
            Session::flash('message', 'Cliente no puede ser Eliminado');
            return Redirect::to('/Usuario');

        }
    }
}
