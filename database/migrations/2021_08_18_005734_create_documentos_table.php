<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();

            $table->string('titulo', 150);
            $table->dateTime('fecha');
            $table->text('descripcion')->nullable();
            $table->string('tipo', 150)->nullable();
            $table->string('archivo');
            $table->boolean('leido')->default(false);
            $table->bigInteger('user_id')->unsigned();
            
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps(); // created_at , updated_at, 
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
        Schema::dropIfExists('documentos');
    }
}
