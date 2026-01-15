<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'ciutat',
        'capacitat',
        'equip_principal_id',
    ];

    public function equipPrincipal()
    {
        return $this->belongsTo(Equip::class, 'equip_principal_id');
    }

    public function partits()
    {
        return $this->hasMany(Partit::class);
    }
}
