<?php

namespace alquilerdeAutos\Http\Controllers;

use alquilerdeAutos\cliente;
use alquilerdeAutos\estado_alquiler;
use alquilerdeAutos\VehiculoEstado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use alquilerdeAutos\Http\Requests;
use alquilerdeAutos\Http\Controllers\Controller;
use alquilerdeAutos\Vehiculo;
use alquilerdeAutos\Color;
use alquilerdeAutos\Condicion;
use alquilerdeAutos\Modelo;
use alquilerdeAutos\Marca;
use alquilerdeAutos\User;
use alquilerdeAutos\alquiler;

use Illuminate\Support\Facades\DB;
use Session;
use Redirect;

class ControladorListarVehiculo extends Controller
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
        $alquilados= Alquiler::all();
        $vehiculos= Vehiculo::ofType($idModelo)->get();



        $vehiculosDisposnibles = DB::table('vehiculos')
            ->join('alquilers', 'alquilers.idVehiiculo', '=', 'vehiculos.id')
            ->where('vehiculos.id', '=', 'alquilers.id')
            ->Where('alquilers.idEstadoAlquiler', '=', '3')
            ->orWhere('alquilers.idEstadoAlquiler', '=', '2')
            ->get();
        Session::flash('idUsuario',$request['idUsuario']);

        return view('vehiculo.Listar',compact('vehiculos','colors','condicion','modelos', 'alquilados', 'vehiculosDisposnibles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $idVehiculo= $request['idVehiculo'];
        $id= $request['idUsuario'];

        $usuario= cliente::ofType($id)->get();
        $vehiculos= Vehiculo::ofType2($idVehiculo)->get();

      ;
        return view('alquiler.crear', compact('usuario','vehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idUsuario= $request['idUsuario'];
        $idVehiculo = $request['idVehiculo'];
        $FechaActual= $request['FechaActual'];
        $FechaDevolucion= $request['FechaDevolucion'];

        $vehiculos= Vehiculo::ofType2($idVehiculo)->get();

        $estados= estado_alquiler::orderBy('Nombre','asc')->lists('Nombre', 'id');
        foreach($vehiculos as $vehiculo){
            $precio = $vehiculo->PrecioPorHora;
        }

        $F1= Carbon::createFromFormat('Y-m-d',$FechaDevolucion);
        $F2=Carbon::createFromFormat('Y-m-d',$FechaActual);
        $Diferencia= $F1->diffInDays($F2);
        $Total=$precio;
        if($Diferencia==0){

        }else{
            $Total=$precio*$Diferencia;
        }


        @$boton = $_POST['Alquilar'];


        if ($boton== "Alquilar"){

            alquiler::create(
                ['FechaDeRegistro'=>$request['FechaActual'],
                'FechaDeEntregaPrevisto'=>$request['FechaDevolucion'],
                'pago'=> $Total,
                'idVehiiculo'=> $request['idVehiculo'],
                'idEstadoAlquiler'=> '1',
                    'idUsuario'=>$request['idUsuario'],
                ]
            );
            $VehiculoEstado = VehiculoEstado::find($request['idVehiculo']);
            $VehiculoEstado->fill(
                [
                    'idCondicion'=>'2'
                ]
            );
            $VehiculoEstado->save();


            return redirect('Alquiler')->with('message',' El Alquiler se efectuo exitosamente ');



        }else{
            return redirect('AlquilerVehiculo/create?idUsuario='.$idUsuario.'&idVehiculo='.$idVehiculo)->with('message','El Precio Total a Pagar es $'.$Total." Dolares.")-> with('estados', $estados)->with('fecha', $FechaDevolucion);
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
