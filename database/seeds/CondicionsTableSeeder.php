<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 06/11/2015
 * Time: 0:09
 */


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CondicionsTableSeeder extends Seeder
{
    public function run(){
        DB::table('condicions')->insert(array(
            'Nombre'=>'Disponible',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('condicions')->insert(array(
            'Nombre'=>'Ocupado',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
        DB::table('condicions')->insert(array(
            'Nombre'=>'En Mantenimiento',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));
    }
}