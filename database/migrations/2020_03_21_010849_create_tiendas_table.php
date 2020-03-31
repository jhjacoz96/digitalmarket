<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiendas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('nombre');
            $table->String('correo');
            $table->String('rif');
            $table->String('telefono');
            $table->String('codigo');
            $table->String('direccion');
            $table->String('estatus')->default('A');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('planAfilizacion_id')->nullable();

            $table->foreign('planAfilizacion_id')->references('id')->on('plan_afilizacions');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('tiendas');
    }
}
