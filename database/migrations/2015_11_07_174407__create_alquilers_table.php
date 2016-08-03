<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlquilersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alquilers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('FechaDeRegistro');
            $table->date('FechaDeEntregaPrevisto');
            $table->date('FechaDeEntrega')->nullable();
            $table->decimal('pago');
            $table->integer('idVehiiculo')->unsigned();
            $table->integer('idEstadoAlquiler')->unsigned();
            $table->integer('idUsuario')->unsigned();



            $table->foreign('idVehiiculo')
                ->references('id')->on('vehiculos')
                ->onDelete('cascade');
            $table->foreign('idEstadoAlquiler')
                ->references('id')->on('estado_alquilers')
                ->onDelete('cascade');
            $table->foreign('idUsuario')
                ->references('id')->on('clientes')
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alquilers');
    }
}
