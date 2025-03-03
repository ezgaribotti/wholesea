<?php

namespace Modules\Operators\src\Repositories;

use App\Repositories\Repository;
use Modules\Operators\src\Entities\Operator;
use Modules\Operators\src\Interfaces\OperatorRepositoryInterface;

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
