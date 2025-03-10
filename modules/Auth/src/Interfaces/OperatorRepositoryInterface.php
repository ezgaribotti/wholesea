<?php

namespace Modules\Auth\src\Interfaces;

use App\Interfaces\RepositoryInterface;

interface OperatorRepositoryInterface extends RepositoryInterface
{
    public function findByInternalCode(string $internalCode): ?object;

    public function findByEmail(string $email): ?object;

    public function updateByEmail(array $attributes, string $email): void;
}
