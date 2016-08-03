<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('PrimerNombre',100);
            $table->string('SegundoNombre',100);
            $table->string('PrimerApellido',100);
            $table->string('SegundoApellido',100);
            $table->string('genero',15);
            $table->string('nDocumento',100)->unique();
            //$table->string('estado')->default('Inactivo')


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


            $table->string('email')->unique();
            $table->string('password', 60);
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
        Schema::drop('users');
    }
}

