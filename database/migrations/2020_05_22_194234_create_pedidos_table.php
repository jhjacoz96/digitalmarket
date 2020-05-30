<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('montoTotal',12,2)->default(0);
            $table->string('codigoCupon')->nullable();
            $table->integer('cantidadCupon')->nullable();
            $table->string('status');
            $table->string('codigo')->nullable();
            $table->unsignedBigInteger('metodoEnvio_id')->nullable();

            $table->foreign('metodoEnvio_id')->references('id')->on('medio_envios');

            $table->unsignedBigInteger('direccion_id')->nullable();

            $table->foreign('direccion_id')->references('id')->on('direccion_pedidos');
            
            $table->unsignedBigInteger('comprador_id')->nullable();

            $table->foreign('comprador_id')->references('id')->on('compradors');

            $table->unsignedBigInteger('factura_id')->nullable();

            $table->foreign('factura_id')->references('id')->on('direccion_facturas');

            

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
        Schema::dropIfExists('pedidos');
    }
}
