<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReparacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reparacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',8)->nullable();               
            $table->unsignedInteger('cliente_id');               
            $table->unsignedInteger('herramienta_id');
            $table->string('modelo',20)->nullable();               
            $table->string('serie',40)->nullable();
            $table->string('estado',1)->default('0');               
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
        Schema::dropIfExists('reparacion');
    }
}
