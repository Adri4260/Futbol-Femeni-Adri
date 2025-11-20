<?php

namespace App\Repositories\Eloquent;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $columns = ['*'])
    {
        return $this->model->all($columns);
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $record = $this->find($id);
        if (!$record) return null;
        $record->update($data);
        return $record;
    }

    public function delete(int $id)
    {
        $record = $this->find($id);
        if (!$record) return false;
        return $record->delete();
    }
}
