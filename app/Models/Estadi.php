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
        'imatge',
    ];

    // Relació 1:N → partits jugats en aquest estadi
    public function partits()
    {
        return $this->hasMany(Partit::class);
    }
}
