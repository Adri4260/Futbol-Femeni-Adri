<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equip extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'ciutat',
        'lliga',
        // altres camps que vulguis afegir
    ];

    // Relació 1:N → jugadores
    public function jugadores()
    {
        return $this->hasMany(Jugadora::class);
    }

    // Relació 1:N → partits com a local
    public function partitsLocals()
    {
        return $this->hasMany(Partit::class, 'local_id');
    }

    // Relació 1:N → partits com a visitant
    public function partitsVisitants()
    {
        return $this->hasMany(Partit::class, 'visitant_id');
    }
}
