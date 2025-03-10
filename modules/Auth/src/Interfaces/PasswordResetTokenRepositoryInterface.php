<?php

namespace Modules\Auth\src\Interfaces;

use App\Interfaces\RepositoryInterface;

interface PasswordResetTokenRepositoryInterface extends RepositoryInterface
{
    public function findByEmail(string $email): ?object;

    public function deleteByEmail(string $email): void;
}
