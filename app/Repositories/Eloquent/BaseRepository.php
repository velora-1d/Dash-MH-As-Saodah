<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $columns = ['*'], array $relations = [])
    {
        $query = $this->model->with($relations);
        $query = $this->applyContextScopes($query);
        return $query->get($columns);
    }

    public function getById($id, array $columns = ['*'], array $relations = [])
    {
        $query = $this->model->with($relations);
        $query = $this->applyContextScopes($query);
        return $query->findOrFail($id, $columns);
    }

    /**
     * Apply contextual scoping based on X-Entity-ID and X-Unit-ID headers.
     * Prevents data leakage across different entities or units.
     */
    protected function applyContextScopes($query)
    {
        $entityId = request()->header('X-Entity-ID');
        $unitId = request()->header('X-Unit-ID');

        // Check if model has entity_id column
        if ($entityId && \Illuminate\Support\Facades\Schema::hasColumn($this->model->getTable(), 'entity_id')) {
            $query->where($this->model->getTable() . '.entity_id', $entityId);
        }

        // Check if model has unit_id column
        if ($unitId && \Illuminate\Support\Facades\Schema::hasColumn($this->model->getTable(), 'unit_id')) {
            $query->where($this->model->getTable() . '.unit_id', $unitId);
        }

        return $query;
    }

    public function create(array $payload)
    {
        return $this->model->create($payload);
    }

    public function update($id, array $payload)
    {
        $model = $this->getById($id);
        $model->update($payload);
        return $model->fresh();
    }

    public function deleteById($id)
    {
        return $this->getById($id)->delete();
    }
}