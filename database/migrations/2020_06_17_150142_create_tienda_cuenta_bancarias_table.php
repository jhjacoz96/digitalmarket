<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiendaCuentaBancariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tienda_cuenta_bancarias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('moneda')->nunllable();
            $table->string('medioPago')->nunllable();
            $table->string('cuenta')->nullable();
            $table->string('titular')->nullable();
            $table->string('tipoCuenta')->nullable();
            $table->string('tipodocumento')->nullable();
            $table->string('documentoIndentidad')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->unsignedBigInteger('tienda_id');
            $table->foreign('tienda_id')->references('id')->on('tiendas');
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
        Schema::dropIfExists('tienda_cuenta_bancarias');
    }
}
