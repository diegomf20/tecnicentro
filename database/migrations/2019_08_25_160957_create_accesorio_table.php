<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccesorioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesorio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',5);
            $table->string('nombre',50);
            $table->string('modelo',50);
            $table->integer('stock');
            $table->enum('estado',["0","1"])->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesorio');
    }
}
