<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipsTable extends Migration
{
    public function up()
    {
        Schema::create('equips', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->index();
            $table->string('ciutat')->nullable();
            $table->string('lliga')->nullable();
            $table->string('escut')->nullable(); // fitxer imatge opcional
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('equips');
    }
}
