<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoSucursalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_sucursal', function (Blueprint $table) {
            $table->id();

            $table->integer("stock");
            $table->bigInteger("producto_id")->unsigned();
            $table->bigInteger("sucursal_id")->unsigned();

            $table->foreign("producto_id")->references("id")->on("productos");
            $table->foreign("sucursal_id")->references("id")->on("sucursals");

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
        Schema::dropIfExists('producto_sucursal');
    }
}
