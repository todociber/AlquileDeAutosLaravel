<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 06/11/2015
 * Time: 0:09
 */


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Estado_AlquilerTableSeeder extends Seeder
{
    public function run(){
        DB::table('estado_alquilers')->insert(array(
            'Nombre'=>'En Curso',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('estado_alquilers')->insert(array(
            'Nombre'=>'Completado',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('estado_alquilers')->insert(array(
            'Nombre'=>'Cancelado',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
    }
}