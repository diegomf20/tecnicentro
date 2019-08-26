<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnósticoPiezaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnóstico_pieza', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cantidad');
            $table->unsignedInteger('pieza_id');
            $table->unsignedInteger('diagnostico_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnóstico_pieza');
    }
}
