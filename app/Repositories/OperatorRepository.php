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

    public function findByInternalCode(string $internalCode): ?object
    {
        return $this->entity->whereInternalCode($internalCode)->first();
    }

    public function findByEmail(string $email): ?object
    {
        return $this->entity->whereEmail($email)->first();
    }
}
