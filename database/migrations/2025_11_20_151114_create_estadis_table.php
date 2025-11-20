<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadisTable extends Migration
{
    public function up()
    {
        Schema::create('estadis', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->index();
            $table->string('ciutat');
            $table->unsignedInteger('capacitat')->default(0);
            $table->unsignedBigInteger('equip_principal_id')->nullable();
            $table->timestamps();

            $table->foreign('equip_principal_id')->references('id')->on('equips')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('estadis');
    }
}
