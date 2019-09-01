<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosticoAccesorioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostico_accesorio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad');
            $table->unsignedInteger('accesorio_id');
            $table->unsignedInteger('reparacion_herramienta_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnostico_accesorio');
    }
}
