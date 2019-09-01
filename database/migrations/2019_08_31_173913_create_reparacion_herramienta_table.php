<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReparacionHerramientaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reparacion_herramienta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serie',20)->nullable();
            $table->string('diagnostico',200)->nullable();
            $table->double('costo','8,2')->nullable();
            $table->integer('dias')->nullable();
            $table->unsignedInteger('reparacion_id');            
            $table->unsignedInteger('herramienta_id');
            $table->enum('estado',["0","1"])->default('0');//0:activo , 1:diagnosticado                         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reparacion_herramienta');
    }
}
