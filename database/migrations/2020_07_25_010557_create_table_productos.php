<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
           $table->id();
           $table->integer('id_categoria');
           $table->string('codigo')->unique();
           $table->string('descripcion');
           $table->string('imagen')->nullable();
           $table->integer('stock')->unsigned()->default(0);
           $table->string('precio_compra');
           $table->string('precio_venta');
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