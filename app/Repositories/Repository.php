<?php

namespace App\Repositories;

use App\Entities\Entity;
use App\Interfaces\RepositoryInterface;

abstract class Repository implements RepositoryInterface
{
    public function __construct(
        protected Entity $entity
    )
    {
    }

    public function all(): object
    {
        return $this->entity->all();
    }

    public function paginate(object $request): object
    {
        return $this->entity
            ->when($request->search, function ($query) use ($request) {
                foreach ($request->search as $filter) {
                    $filter = to_object($filter);
                    if ($filter->value) {
                        $filter->strict
                            ? $query->where($filter->by, $filter->value)
                            : $query->whereLike($filter->by, pct_between($filter->value));
                    } elseif ($filter->between) {
                        $query->whereBetween($filter->by, $filter->between);
                    } else {
                        $query->whereNull($filter->by);
                    }
            }})
            ->when($request->order_by, function ($query) use ($request) {
                return $request->direction_desc
                    ? $query->orderByDesc($request->order_by)
                    : $query->orderBy($request->order_by);
            })
            ->simplePaginate(15);
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
