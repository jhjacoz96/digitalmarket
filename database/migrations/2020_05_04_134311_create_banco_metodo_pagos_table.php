x<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBancoMetodoPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banco_metodo_pagos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombreBanco');
            $table->string('titular')->nullable();
            $table->string('detalleCuenta');

            $table->string('tipoDocumento')->nullable();
            $table->string('documentoIdentidad')->nullable();
            $table->string('tipoCuenta')->nullable();
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
        Schema::dropIfExists('banco_metodo_pagos');
    }
}
