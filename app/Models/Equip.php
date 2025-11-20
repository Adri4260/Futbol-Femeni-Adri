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
        'escut',
    ];

    // Relació 1:N → jugadores
    public function jugadores()
    {
        return $this->hasMany(Jugadora::class);
    }

    // Relació 1:N → partits com a local
    public function partitsLocal()
    {
        return $this->hasMany(Partit::class, 'local_id');
    }

    // Relació 1:N → partits com a visitant
    public function partitsVisitant()
    {
        return $this->hasMany(Partit::class, 'visitant_id');
    }
}
