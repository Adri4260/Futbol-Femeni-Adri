<?php

namespace App\Policies;

use App\Models\Jugadora;
use App\Models\User;

class JugadoraPolicy
{
    // Tothom pot veure el llistat
    public function viewAny(User $user): bool
    {
        return true;
    }

    // Només Admin o Manager del mateix equip poden editar/esborrar
    public function update(User $user, Jugadora $jugadora): bool
    {
        if ($user->role === 'admin') return true;

        return $user->role === 'manager' && $user->team_id === $jugadora->equip_id;
    }

    public function delete(User $user, Jugadora $jugadora): bool
    {
        if ($user->role === 'admin') return true;

        return $user->role === 'manager' && $user->team_id === $jugadora->equip_id;
    }

    // Crear: Admin o Manager (si té equip assignat)
    public function create(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'manager';
    }
}
