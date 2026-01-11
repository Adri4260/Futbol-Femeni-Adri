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
        Schema::table('users', function (Blueprint $table) {
            // Añadimos la clave foránea. Nullable porque los admins/árbitros no tienen equipo.
            $table->foreignId('team_id')
                ->nullable()
                ->after('role')
                ->constrained('equips') // Se conecta a la tabla 'equips'
                ->nullOnDelete();       // Si se borra el equipo, el usuario se queda sin equipo (no se borra el usuario)
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['team_id']);
            $table->dropColumn('team_id');
        });
    }
};
