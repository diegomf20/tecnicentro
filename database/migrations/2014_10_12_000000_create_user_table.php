<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',30)->nullable();
            $table->string('apellido',50)->nullable();
            $table->string('usuario',100)->unique();
            $table->string('password',100);
            $table->string('numero',12)->nullable();
            $table->enum('estado',["0","1"]);//0:activo , 1:inactivo, 2:Cuenta Principal             
            $table->enum('rol',["Administrador","Secretaria","Tecnico"]);
        });
    }

    /**
     * Reverse the migrations.
     *  
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
