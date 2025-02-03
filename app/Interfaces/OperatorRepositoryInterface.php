<?php

namespace App\Interfaces;

interface OperatorRepositoryInterface extends RepositoryInterface
{
    public function internalCodeExists(string $internalCode): bool;

    public function emailExists(string $email): bool;
}
