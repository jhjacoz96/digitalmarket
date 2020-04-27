<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompradorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compradors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('correo');
            $table->string('estatus')->default('A');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('tipoComprador_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('compradors');
    }
}
