<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('PrimerNombre',100);
            $table->string('SegundoNombre',100);
            $table->string('PrimerApellido',100);
            $table->string('SegundoApellido',100);
            $table->string('genero',15);
            $table->string('nDocumento',100)->unique();
            $table->string('Telefono',100)->unique();


            $table->string('EstadoD',110);
            $table->string('DireccionEspecifica',200);
            $table->string('CodigoPostal',100);

            $table->boolean('estado')->default(true);
            $table->date('FechaDeNacimiento');

            $table->integer('idPaisUser')->unsigned();
            $table->integer('idTipoUsuario')->unsigned();


            $table->foreign('idPaisUser')
                ->references('id')->on('pais');

            $table->foreign('idTipoUsuario')
                ->references('id')->on('tipo_usuarios');



            $table->rememberToken();
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
        Schema::drop('clientes');
    }
}
