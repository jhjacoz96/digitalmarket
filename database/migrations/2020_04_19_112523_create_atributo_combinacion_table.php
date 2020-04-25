<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtributoCombinacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atributo_combinacion', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('combinacion_id');
            $table->foreign('combinacion_id')->references('id')->on('combinacions')->onDelete('cascade')->onUpdate('restrict');

            $table->unsignedBigInteger('atributo_id');
            $table->foreign('atributo_id')->references('id')->on('atributos')->onDelete('cascade')->onUpdate('restrict');


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
        Schema::dropIfExists('atributo_combinacion');
    }
}
