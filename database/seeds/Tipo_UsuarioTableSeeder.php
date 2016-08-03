<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 06/11/2015
 * Time: 0:09
 */


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Tipo_UsuarioTableSeeder extends Seeder
{
    public function run(){
        DB::table('tipo_usuarios')->insert(array(
            'Nombre'=>'Administrador',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('tipo_usuarios')->insert(array(
            'Nombre'=>'Empleado',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('tipo_usuarios')->insert(array(
            'Nombre'=>'Cliente',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
    }
}