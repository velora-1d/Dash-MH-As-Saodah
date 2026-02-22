<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryInterface
{
    public function all(array $columns = ['*'], array $relations = []);
    public function getById($id, array $columns = ['*'], array $relations = []);
    public function create(array $payload);
    public function update($id, array $payload);
    public function deleteById($id);
}