<?php

namespace App\Repositories\Eloquent;

use App\Models\Equip;
use App\Repositories\EquipRepositoryInterface;

class EquipRepository implements EquipRepositoryInterface
{
    public function all()
    {
        return Equip::all();
    }

    public function find(int $id)
    {
        return Equip::findOrFail($id);
    }

    public function create(array $data)
    {
        return Equip::create($data);
    }

    public function update(int $id, array $data)
    {
        $equip = Equip::findOrFail($id);
        $equip->update($data);
        return $equip;
    }

    public function delete(int $id)
    {
        $equip = Equip::findOrFail($id);
        return $equip->delete();
    }
}
