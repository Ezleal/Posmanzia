<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo')->unique();
            $table->integer('id_cliente')->unsigned();
            $table->integer('id_vendedor')->unsigned();
            $table->string('productos');
            $table->integer('impuesto');
            $table->integer('neto');
            $table->integer('total');
            $table->string('metodo_pago');
            $table->datetime('fecha');
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
        Schema::dropIfExists('ventas');
    }
}
