<?php

namespace App\Services;

use App\Repositories\EquipRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class EquipService
{
    protected $repo;

    public function __construct(EquipRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function all()
    {
        return $this->repo->all();
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function create(array $data)
    {
        if (isset($data['escut']) && $data['escut'] instanceof UploadedFile) {
            $path = $data['escut']->store('escuts', 'public');
            $data['escut'] = $path;
        }

        return $this->repo->create($data);
    }

    public function update(int $id, array $data)
    {
        $equip = $this->repo->find($id);

        if (isset($data['escut']) && $data['escut'] instanceof UploadedFile) {
            if ($equip && $equip->escut) {
                Storage::disk('public')->delete($equip->escut);
            }

            $path = $data['escut']->store('escuts', 'public');
            $data['escut'] = $path;
        }

        return $this->repo->update($id, $data);
    }

    public function delete(int $id)
    {
        $equip = $this->repo->find($id);

        if ($equip && $equip->escut) {
            Storage::disk('public')->delete($equip->escut);
        }

        return $this->repo->delete($id);
    }
}
