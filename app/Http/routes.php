<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\App;

Route::resource('/', 'LoginControlador');
Route::resource('Login', 'LoginControlador');
Route::group(['middleware'=>'auth'], function(){
    Route::resource('Marca', 'MarcarCotrolador');
    Route::resource('Modelo', 'ModeloControlador');

    Route::resource('Color', 'ColorControlador');
    Route::resource('Vehiculo', 'VehiculoControlador');
    Route::resource('Usuario', 'UsuarioControlador');
    Route::resource('Alquiler', 'AlquilerControlador');
    Route::post('AlquilerVehiculo.create', 'ControladorListarVehiculo@create');
    Route::resource('AlquilerVehiculo', 'ControladorListarVehiculo');
    Route::resource('AlquilerExitoso', 'AlquilerExitoso');
    Route::resource('MarcasEliminadas', 'ControladorMarcasEliminadas');
    Route::resource('ModelosEliminados', 'ControladorModelosEliminados');
    Route::resource('ColorEliminado', 'ControladorColorEliminado');
    Route::resource('VehiculosEliminados', 'ControladorVehiculosEliminados');
    Route::resource('Empleado', 'EmpleadoControlador');
    Route::resource('UsuariosEliminados', 'ControladorUsuariosEliminados');
    Route::resource('EmpleadosEliminados', 'ControladorEmpleadosEliminados');
    Route::resource('ReportesAlquileres','ReportesAquileresControlador');
    Route::resource('FiltrarVehiculos','filtrarVehiculosControlador');
});






