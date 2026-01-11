<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    // Al principio: use Illuminate\Database\Eloquent\Relations\HasOne;

    public function manager(): HasOne
    {
        // Un equipo tiene UN usuario (manager) asociado
        return $this->hasOne(User::class, 'team_id');
    }
}
