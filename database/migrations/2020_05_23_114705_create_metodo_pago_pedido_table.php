<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetodoPagoPedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metodo_pago_pedido', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('cantidad',12,2)->default(0);
            $table->string('status');
            $table->string('referencia')->nullable();
            $table->unsignedBigInteger('metodoPago_id');
            $table->foreign('metodoPago_id')->references('id')->on('metodo_pagos');
            $table->unsignedBigInteger('pedido_id');
            $table->foreign('pedido_id')->references('id')->on('pedidos');

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
        Schema::dropIfExists('metodo_pago_pedido');
    }
}
