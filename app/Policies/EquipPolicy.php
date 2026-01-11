<?php

namespace App\Policies;

use App\Models\Equip;
use App\Models\User;

class EquipPolicy
{
    /**
     * Determina si el usuario puede ver el listado (opcional, todos pueden por defecto).
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determina si el usuario puede ver un equipo concreto.
     */
    public function view(User $user, Equip $equip): bool
    {
        return true;
    }

    /**
     * Determina si el usuario puede crear equipos.
     * Solo Admin o Managers que NO tengan equipo asignado (opcional).
     * Por ahora, dejemos que Managers y Admins creen.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'manager';
    }

    /**
     * Determina si el usuario puede actualizar el equipo.
     * LÓGICA CLAVE: Admin SIEMPRE, Manager SOLO si es su equipo.
     */
    public function update(User $user, Equip $equip): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        // El manager solo puede editar si su team_id coincide con el id del equipo
        return $user->role === 'manager' && $user->team_id === $equip->id;
    }

    /**
     * Determina si el usuario puede eliminar el equipo.
     */
    public function delete(User $user, Equip $equip): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return $user->role === 'manager' && $user->team_id === $equip->id;
    }
}
