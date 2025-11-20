<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartitsTable extends Migration
{
    public function up()
    {
        Schema::create('partits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('local_id');
            $table->unsignedBigInteger('visitant_id');
            $table->unsignedBigInteger('estadi_id')->nullable();
            $table->date('data');
            $table->unsignedInteger('jornada')->nullable();
            $table->string('resultat')->nullable(); // ex: "2-1"
            $table->timestamps();

            $table->foreign('local_id')->references('id')->on('equips')->onDelete('cascade');
            $table->foreign('visitant_id')->references('id')->on('equips')->onDelete('cascade');
            $table->foreign('estadi_id')->references('id')->on('estadis')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('partits');
    }
}
