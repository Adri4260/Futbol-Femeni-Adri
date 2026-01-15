<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Equip extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'ciutat', 'lliga', 'escut'];

    public function partitsLocal()
    {
        return $this->hasMany(Partit::class, 'local_id');
    }

    public function partitsVisitant()
    {
        return $this->hasMany(Partit::class, 'visitant_id');
    }


    public function manager(): HasOne
    {
        return $this->hasOne(User::class, 'team_id');
    }
}
