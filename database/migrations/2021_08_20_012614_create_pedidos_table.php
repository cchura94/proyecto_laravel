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
            $table->id();
            $table->dateTime("fecha_pedido");
            $table->integer("estado")->default(1); //1: en proceso, 0: cancelado, 2: completado
            $table->decimal("monto_total", 10, 2)->default(0);
            $table->bigInteger("cliente_id")->unsigned();
            // 1 : N
            $table->foreign("cliente_id")->references("id")->on("clientes");
            $table->timestamps();
            $table->softDeletes(); // deleted_at
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
