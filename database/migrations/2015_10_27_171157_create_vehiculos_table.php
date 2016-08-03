<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->double('Kilometraje')->default(0);
            $table->string('PrecioPorHora');
            $table->integer('placa');
            $table->integer('anio');
            $table->boolean('Estado')->default(true);
            $table->integer('idColor')->unsigned();
            $table->integer('idModelo')->unsigned();

            $table->integer('idCondicion')->unsigned();
            $table->foreign('idColor')
                ->references('id')->on('colors')
                ->onUpdate('cascade');
            $table->foreign('idModelo')
                ->references('id')->on('modelos')
                ->onUpdate('cascade');

            $table->foreign('idCondicion')
                ->references('id')->on('condicions')
                ->onUpdate('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vehiculos');
    }
}
