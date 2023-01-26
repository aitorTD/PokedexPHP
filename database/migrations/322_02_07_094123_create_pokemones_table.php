<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokemonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique()->required();
            $table->string('atk', 40)->nullable();
            $table->string('def', 40)->nullable();
            $table->string('hp', 40)->nullable();
            $table->bigInteger('idObjeto')->unsigned()->nullable();
            $table->string('filepath');
            $table->string('mimetype');
            
            $table->foreign('idObjeto')->references('id')->on('objetos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pokemones');
    }
}
