<?php

namespace Modules\Auth\src\Repositories;

use App\Repositories\Repository;
use Modules\Auth\src\Entities\Operator;
use Modules\Auth\src\Interfaces\OperatorRepositoryInterface;

class OperatorRepository extends Repository implements OperatorRepositoryInterface
{
    public function __construct(Operator $operator)
    {
        parent::__construct($operator);
    }

    public function findByInternalCode(string $internalCode): ?object
    {
        return $this->entity->whereInternalCode($internalCode)->first();
    }

    public function findByEmail(string $email): ?object
    {
        return $this->entity->whereEmail($email)->first();
    }

    public function updateByEmail(array $attributes, string $email): void
    {
        $this->entity->whereEmail($email)->update($attributes);
    }
}
