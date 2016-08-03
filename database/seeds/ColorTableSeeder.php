<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 06/11/2015
 * Time: 0:09
 */


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ColorTableSeeder extends Seeder
{
    public function run(){
        DB::table('colors')->insert(array(
            'Nombre'=>'Azul',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        DB::table('colors')->insert(array(
            'Nombre'=>'Negro',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        DB::table('colors')->insert(array(
            'Nombre'=>'Rojo',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        DB::table('colors')->insert(array(
            'Nombre'=>'Celeste',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
    }
}