<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('slug')->unique();
            $table->string('sku')->nullable();
            $table->string('tipoCliente');
            $table->integer('notificarStock')->nullable();
            $table->unsignedbigInteger('subCategoria_id')->nullable();
            $table->unsignedbigInteger('marca_id')->nullable();
            $table->unsignedbigInteger('tienda_id')->nullable();
            $table->bigInteger('cantidad')->unsigned()->default(0);
            $table->decimal('precioActual',12,2)->default(0);
            $table->decimal('precioAnterior',12,2)->default(0);
            $table->integer('porcentajeDescuento')->designed()->default(0);
            $table->text('descripcionCorta')->nullable();
            $table->text('descripcionLarga')->nullable();
            $table->text('especificaciones')->nullable();
            $table->text('datosInteres')->nullable();
            $table->unsignedBigInteger('visitas')->default(0);
            $table->unsignedBigInteger('ventas')->default(0);
            $table->string('status')->default('A');
            $table->char('sliderPrincipal',2);
            $table->double('peso',8,2);
            


            $table->foreign('subCategoria_id')->references('id')->on('sub_categorias');
            $table->foreign('marca_id')->references('id')->on('marcas');
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
        Schema::dropIfExists('productos');
    }
}
