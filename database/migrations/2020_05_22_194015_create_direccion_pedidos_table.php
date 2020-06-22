<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDireccionPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccion_pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('direccionExacta');
            $table->string('puntoReferencia');
            $table->string('primerTelefono');
            $table->string('segundoTelefono');
            $table->string('observacion')->nullable();
            $table->string('zona');
            $table->string('parroquia');
            $table->string('municipio');
            $table->string('estado');

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
        Schema::dropIfExists('direccion_pedidos');
    }
}
