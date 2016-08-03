<?php

namespace alquilerdeAutos\Http\Controllers;

use alquilerdeAutos\cliente;
use alquilerdeAutos\Http\Requests\EmpleadoValidacion;
use alquilerdeAutos\pais;
use alquilerdeAutos\tipo_usuario;
use alquilerdeAutos\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use alquilerdeAutos\Http\Requests;
use alquilerdeAutos\Http\Controllers\Controller;

class EmpleadoControlador extends Controller
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
            $pais = pais::all();
            $tipo = tipo_usuario::all();
            $usuarios = User::all();
            return view('empleado.mostrar', compact('usuarios', 'pais', 'tipo'));
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

        $tipo= Auth::user()->idTipoUsuario;
        if ($tipo ==1) {
            $pais = pais::orderBy('Nombre', 'asc')->lists('Nombre', 'id');
            $tipo = tipo_usuario::orderBy('Nombre', 'asc')->where('id', '=', '1')->orWhere('id', '=', '2')->lists('Nombre', 'id');
            return view('empleado.crear', compact('pais', 'tipo'));
        }else{
            return Redirect::to('/Alquiler');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadoValidacion $request)
    {


        $tipo= Auth::user()->idTipoUsuario;
        if ($tipo ==1) {
            User::create([
                'PrimerNombre' => $request['PrimerNombre'],
                'SegundoNombre' => $request['SegundoNombre'],
                'PrimerApellido' => $request['PrimerApellido'],
                'SegundoApellido' => $request['SegundoApellido'],
                'genero' => $request['genero'],
                'nDocumento' => $request['nDocumento'],
                'EstadoD' => $request['EstadoD'],
                'DireccionEspecifica' => $request['DireccionEspecifica'],
                'CodigoPostal' => $request['CodigoPostal'],
                'FechaDeNacimiento' => $request['FechaDeNacimiento'],
                'idPaisUser' => $request['idPaisUser'],
                'Telefono' => $request['Telefono'],
                'idTipoUsuario' => $request['idTipoUsuario'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
            ]);
            return redirect('/Empleado')->with('message', 'El Empleado se registro exitosamente')->with('tipo', 'success');
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
        $tipo= Auth::user()->idTipoUsuario;
        if ($tipo ==1) {
            $cliente = User::find($id);
            $pais = pais::orderBy('Nombre', 'asc')->lists('Nombre', 'id');
            $tipo = tipo_usuario::orderBy('Nombre', 'asc')->where('id', '=', '1')->orWhere('id', '=', '2')->lists('Nombre', 'id');
            return view('empleado.edit', ['usuarios' => $cliente, 'pais' => $pais, 'tipo' => $tipo]);
        }else{
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
        $tipo= Auth::user()->idTipoUsuario;
        if ($tipo ==1) {
            $rules = array(
                'PrimerNombre' => 'required',
                'SegundoNombre' => 'required',
                'PrimerApellido' => 'required',
                'SegundoApellido' => 'required',
                'genero' => 'required',
                'nDocumento' => 'required|unique:users,nDocumento,' . $id,
                'EstadoD' => 'required',
                'DireccionEspecifica' => 'required',
                'CodigoPostal' => 'required',
                'FechaDeNacimiento' => 'required',
                'idPaisUser' => 'required',

                'email' => 'required|unique:users,email,' . $id,
                'password' => 'min:8|max:60'
            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {

                return redirect()->back()
                    ->withErrors($error->errors())
                    ->withInput($request->all());
            }
            $usuario = User::find($id);


            if ($request['password'] == '') {
                $usuario->fill(
                    [
                        'PrimerNombre' => $request['PrimerNombre'],
                        'SegundoNombre' => $request['SegundoNombre'],
                        'PrimerApellido' => $request['PrimerApellido'],
                        'SegundoApellido' => $request['SegundoApellido'],
                        'genero' => $request['genero'],
                        'nDocumento' => $request['nDocumento'],
                        'EstadoD' => $request['EstadoD'],
                        'DireccionEspecifica' => $request['DireccionEspecifica'],
                        'CodigoPostal' => $request['CodigoPostal'],
                        'FechaDeNacimiento' => $request['FechaDeNacimiento'],
                        'idPaisUser' => $request['idPaisUser'],
                        'Telefono' => $request['Telefono'],
                        'idTipoUsuario' => $request['idTipoUsuario'],
                        'email' => $request['email'],
                        'password' => $usuario->password,
                    ]

                );
            } else {
                $usuario->fill(
                    [
                        'PrimerNombre' => $request['PrimerNombre'],
                        'SegundoNombre' => $request['SegundoNombre'],
                        'PrimerApellido' => $request['PrimerApellido'],
                        'SegundoApellido' => $request['SegundoApellido'],
                        'genero' => $request['genero'],
                        'nDocumento' => $request['nDocumento'],
                        'EstadoD' => $request['EstadoD'],
                        'DireccionEspecifica' => $request['DireccionEspecifica'],
                        'CodigoPostal' => $request['CodigoPostal'],
                        'FechaDeNacimiento' => $request['FechaDeNacimiento'],
                        'idPaisUser' => $request['idPaisUser'],
                        'Telefono' => $request['Telefono'],
                        'idTipoUsuario' => $request['idTipoUsuario'],
                        'email' => $request['email'],
                        'password' => bcrypt($request['password'])
                    ]

                );
            }

            $usuario->save();

            Session::flash('message', 'Empleado actualizado exitosamente');
            Session::flash('tipo', 'success');
            return Redirect::to('/Empleado');
        }else{
            return Redirect::to('/Alquiler');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
            {
                $tipo= Auth::user()->idTipoUsuario;
                if ($tipo ==1) {
                if($id==1){
                    Session::flash('tipo','info');
                    Session::flash('message', 'Empleado administrador principal no puede ser eliminado');
                    return Redirect::to('/Empleado');
                }else{
                    $cliente = User::find($id);
                    $cliente->delete();
                    Session::flash('tipo','success');
                    Session::flash('message', 'Empleado Eliminado exitosamente');
                    return Redirect::to('/Empleado');
                }
                }else{
                    return Redirect::to('/Alquiler');
                }



    }
}
