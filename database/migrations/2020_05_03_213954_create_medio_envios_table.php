<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedioEnviosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medio_envios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('tiempoEntrega');
            $table->string('dentroIribarren')->nullable();
            $table->decimal('precioEnvio',12,2)->default(0);
            $table->string('envioGratis')->default('I');
            $table->decimal('0kgA30kg',12,2)->nullable();
            $table->decimal('31kgA50kg',12,2)->nullable();
            $table->decimal('50kgA100kg',12,2)->nullable();
            $table->decimal('101kgA200kg',12,2)->nullable();
            $table->decimal('mayorA201kg',12,2)->nullable();
            $table->decimal('envioGratisApartir',12,2)->default(0);
            $table->string('status')->default('A');
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
        Schema::dropIfExists('medio_envios');
    }
}
