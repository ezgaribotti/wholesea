<?php

namespace App\Interfaces;

interface OperatorRepositoryInterface extends RepositoryInterface
{
    public function findByInternalCode(string $internalCode): ?object;

    public function findByEmail(string $email): ?object;
}
