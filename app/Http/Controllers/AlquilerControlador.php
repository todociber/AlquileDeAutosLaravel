<?php

namespace alquilerdeAutos\Http\Controllers;

use alquilerdeAutos\alquilerActualizar;
use alquilerdeAutos\Marca;
use alquilerdeAutos\VehiculoEstado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use alquilerdeAutos\Http\Requests;
use alquilerdeAutos\Http\Controllers\Controller;
use alquilerdeAutos\alquiler;
use alquilerdeAutos\User;
use alquilerdeAutos\Vehiculo;
use alquilerdeAutos\estado_alquiler;
use alquilerdeAutos\alquilerFinalizar;
use alquilerdeAutos\Modelo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Redirect;

class AlquilerControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



            $alquilerDatos = DB::table('alquilers')
                ->join('vehiculos','alquilers.idVehiiculo', '=', 'vehiculos.id' )
                ->join('clientes', 'alquilers.idUsuario', '=', 'clientes.id')
                ->join('modelos', 'vehiculos.idModelo', '=', 'modelos.id')
                ->join('marcas', 'marcas.id', '=', 'modelos.idMarca')
                ->join('estado_alquilers', 'estado_alquilers.id', '=', 'alquilers.idEstadoAlquiler')
                ->select( 'vehiculos.*', 'clientes.*', 'modelos.*', 'marcas.*', 'estado_alquilers.Nombre as NombreEstado', 'alquilers.*')
                ->get();



            return view('alquiler.mostrar',compact('alquilerDatos'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $NAlquiler = DB::table('alquilers')
            ->select(DB::raw('count(*) as N'))
            ->where('idUsuario', $request['id'])
            ->where('idEstadoAlquiler', '1')
            ->where('deleted_at', null)
            ->get();


        if($NAlquiler[0]->N==0){
            Session::flash('id', $request['id']);
            $marcas = Marca::orderBy('nombreMarca','asc')->lists('nombreMarca', 'id');
            $modelos = DB::table('modelos')
                ->join('marcas', 'marcas.id', '=', 'modelos.idMarca')
                ->select('modelos.id', DB::raw('concat(marcas.nombreMarca, " ", modelos.Nombre ) as Nombre'))
                ->lists('Nombre', 'id');
            return view('vehiculo.elegir', compact('modelos','marcas'));
        }else{
            return redirect('/Usuario')->with('message','El Usuario seleccionado tiene un alquiler en curso')->with('tipo','danger');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Vehiculo::create([
            'Kilometraje' =>$request['Kilometraje'],
            'PrecioPorHora' =>$request['PrecioPorHora'],
            'idColor' =>$request['idColor'],
            'idMarca' =>$request['idMarca'],
            'idModelo' =>$request['idModelo'],
            'idCondicion' =>$request['idCondicion'],
        ]);

        return redirect('/Vehiculo')->with('message','El modelo se registro exitosamente')->with('tipo', 'success');
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

        $alquileresEdit = alquiler::ofType($id)->get();
        foreach($alquileresEdit as $a ){
        $fechaDevolucion = $a->FechaDeEntregaPrevisto;
            $idAlquiler = $a->id;
        Session::flash('fecha', $fechaDevolucion);
            Session::flash('idAlquiler', $idAlquiler);
    }


        return view('alquiler.edit');
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

        $alquileresEdit = alquiler::ofType($id)->get();
        foreach($alquileresEdit as $a ){
            $idVehiculo= $a->idVehiiculo;
           $FechaActual= $a->FechaDeRegistro;
        }





        $FechaDevolucion= $request['FechaDevolucion'];

        $vehiculos= Vehiculo::ofType2($idVehiculo)->get();
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



        $actualizarAlquiler = alquilerActualizar::find($id);
        $actualizarAlquiler->fill([
                'FechaDeEntregaPrevisto'=> $request['FechaDevolucion'],
            'pago'=>$Total,
        ]);
        $actualizarAlquiler->save();
        Session::flash('tipo', 'success');
        Session::flash('message', 'Alquiler Editado exitosamente');
        return Redirect::to('/Alquiler');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {

        $hoy = Carbon::now()->format('Y-m-d');
        $hoy = Carbon::createFromFormat('Y-m-d', $hoy);
        $alquileresEdit = alquiler::ofType($id)->get();
        foreach($alquileresEdit as $a ){
            $idVehiculo= $a->idVehiiculo;
            $FechaActual= $a->FechaDeRegistro;
        }

        $F2=Carbon::createFromFormat('Y-m-d',$FechaActual);
        $Diferencia2= $F2->diffInDays($hoy);
        if ($Diferencia2==0) {

            $VehiculoEstado = VehiculoEstado::find($idVehiculo);
            $VehiculoEstado->fill(
                [
                    'idCondicion' => '1'
                ]
            );
            $VehiculoEstado->save();


            $FechaDevolucion = Carbon::now()->addDay()->format('Y-m-d');

            $vehiculos = Vehiculo::ofType2($idVehiculo)->get();
            foreach ($vehiculos as $vehiculo) {
                $precio = $vehiculo->PrecioPorHora;
            }

            $F1 = Carbon::createFromFormat('Y-m-d', $FechaDevolucion);

            $Diferencia = $F1->diffInDays($F2);
            $Total = $precio;
            if ($Diferencia == 0) {

            } else {
                $Total = $precio * $Diferencia;
            }

            $actualizarAlquiler = alquilerFinalizar::find($id);
            $actualizarAlquiler->fill([
                'FechaDeEntrega' => $FechaDevolucion,
                'pago' => 0,
                'idEstadoAlquiler' => 3,
            ]);


            $actualizarAlquiler->save();
            Session::flash('tipo', 'success');
            Session::flash('message', 'Alquiler Cancelado exitosamente');

            return Redirect::to('/Alquiler');

        }else{
            Session::flash('tipo', 'warning');
            Session::flash('message', 'El Alquiler no puede ser cancelado');

            return Redirect::to('/Alquiler');
        }
    }


}
