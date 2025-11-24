<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equip extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'ciutat', 'lliga', 'escut'];

    // Relació amb partits on l’equip és local
    public function partitsLocal()
    {
        return $this->hasMany(Partit::class, 'local_id');
    }

    // Relació amb partits on l’equip és visitant
    public function partitsVisitant()
    {
        return $this->hasMany(Partit::class, 'visitant_id');
    }
}
