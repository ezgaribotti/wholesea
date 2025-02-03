<?php

namespace App\Repositories;

use App\Entities\Operator;
use App\Interfaces\OperatorRepositoryInterface;

class OperatorRepository extends Repository implements OperatorRepositoryInterface
{
    public function __construct(Operator $operator)
    {
        parent::__construct($operator);
    }

    public function internalCodeExists(string $internalCode): bool
    {
        return $this->entity->whereInternalCode($internalCode)->exists();
    }

    public function emailExists(string $email): bool
    {
        return $this->entity->whereEmail($email)->exists();
    }
}
