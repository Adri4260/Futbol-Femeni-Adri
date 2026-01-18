<?php

namespace App\Policies;

use App\Models\Partit;
use App\Models\User;

class PartitPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    // Qui pot modificar el resultat?
    public function update(User $user, Partit $partit): bool
    {
        // Admin sempre pot
        if ($user->role === 'admin') return true;

        // Àrbitre només si és el seu partit assignat
        return $user->role === 'arbitre' && $partit->arbitre_id === $user->id;
    }

    // Crear i Esborrar només Admin
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Partit $partit): bool
    {
        return $user->role === 'admin';
    }
}
