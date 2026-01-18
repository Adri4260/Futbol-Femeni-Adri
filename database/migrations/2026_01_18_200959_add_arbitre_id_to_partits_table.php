<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('partits', function (Blueprint $table) {
            // Relació amb la taula users (que són els àrbitres)
            $table->foreignId('arbitre_id')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('partits', function (Blueprint $table) {
            $table->dropForeign(['arbitre_id']);
            $table->dropColumn('arbitre_id');
        });
    }
};
