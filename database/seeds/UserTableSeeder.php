<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 06/11/2015
 * Time: 0:09
 */


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserTableSeeder extends Seeder
{
    public function run(){
        DB::table('users')->insert(array(
            'PrimerNombre'=>'Alexander',
            'SegundoNombre'=>'Leonardo',
            'PrimerApellido'=>'Dominguez',
            'SegundoApellido'=> 'Pascacio',
            'genero'=>'M',
            'nDocumento'=>'156789432',
            'EstadoD'=>'La Paz',
            'DireccionEspecifica'=>'Olocuilta',
            'CodigoPostal'=>'02132',
            'estado'=>'1',
            'FechaDeNacimiento'=>'1994-07-14',
            'idPaisUser'=>'1',
            'idTipoUsuario'=>'1',
            'email'=>'todociber100@gmail.com',
            'password'=>bcrypt('12345'),
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ));
    }
}