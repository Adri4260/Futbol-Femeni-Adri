<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJugadoresTable extends Migration
{
    public function up()
    {
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('cognoms');
            $table->unsignedBigInteger('equip_id');
            $table->date('data_naixement')->nullable();
            $table->unsignedInteger('dorsal')->nullable();
            $table->string('foto')->nullable();
            $table->string('posicio')->nullable();
            $table->timestamps();

            $table->foreign('equip_id')->references('id')->on('equips')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jugadores');
    }
}
