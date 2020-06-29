<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateDireccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('direccionExacta');
            $table->string('puntoReferencia');
            $table->string('primerTelefono');
            $table->string('segundoTelefono');
            $table->string('observacion')->nullable();
            $table->unsignedBigInteger('comprador_id')->nullable();
            $table->foreign('comprador_id')->references('id')->on('compradors');

            $table->unsignedBigInteger('zona_id')->nullable();
            $table->foreign('zona_id')->references('id')->on('zonas');
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
        Schema::dropIfExists('direccions');
    }
}

