<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partit extends Model
{
    use HasFactory;

    protected $fillable = [
        'local_id',
        'visitant_id',
        'estadi_id',
        'data',
        'jornada',
        'gols_local',
        'gols_visitant',
    ];

    // Relació N:1 → equip local
    public function local()
    {
        return $this->belongsTo(Equip::class, 'local_id');
    }

    // Relació N:1 → equip visitant
    public function visitant()
    {
        return $this->belongsTo(Equip::class, 'visitant_id');
    }

    // Relació N:1 → estadi
    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }
}
