<?php

namespace App\Repositories;

use App\Entities\Entity;
use App\Interfaces\RepositoryInterface;

abstract class Repository implements RepositoryInterface
{
    public function __construct(protected Entity $entity)
    {
    }

    public function all(): object
    {
        return $this->entity->all();
    }

    public function paginate(): object
    {
        return $this->entity->simplePaginate(15);
    }

    public function find($id): ?object
    {
        return $this->entity->find($id);
    }

    public function findOrFail($id): object
    {
        return $this->entity->findOrFail($id);
    }

    public function create(array $attributes): object
    {
        return $this->entity->create($attributes);
    }

    public function update(array $attributes, $id): void
    {
        $this->entity->findOrFail($id)->update($attributes);
    }

    public function delete($id): void
    {
        $this->entity->findOrFail($id)->delete();
    }
}
