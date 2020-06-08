<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuponTipoCompradorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupon_tipo_comprador', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cupon_id');
            $table->foreign('cupon_id')->references('id')->on('cupons');
            $table->unsignedBigInteger('tipoComprador_id');
            $table->foreign('tipoComprador_id')->references('id')->on('tipo_compradors');
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
        Schema::dropIfExists('cupon_tipo_comprador');
    }
}
