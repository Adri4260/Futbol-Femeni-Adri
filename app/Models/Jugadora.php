<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugadora extends Model
{
    use HasFactory;

    protected $table = 'jugadores';

    protected $fillable = [
        'nom',
        'cognoms',
        'dorsal',
        'data_naixement',
        'foto',
        'posicio',
        'equip_id',
    ];

    public function equip()
    {
        return $this->belongsTo(Equip::class);
    }

    public function getEdatAttribute()
    {
        return \Carbon\Carbon::parse($this->data_naixement)->age;
    }
}
