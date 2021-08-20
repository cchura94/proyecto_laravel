<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursals', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("telefono", 15)->nullable();
            $table->boolean("estado")->default(true);
            $table->string("direccion")->default(true);
            $table->bigInteger("user_id")->unsigned()->nullable();
            
            $table->foreign("user_id")->references("id")->on("users");
            
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
        Schema::dropIfExists('sucursals');
    }
}
