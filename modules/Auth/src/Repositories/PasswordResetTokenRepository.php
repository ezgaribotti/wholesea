<?php

namespace Modules\Auth\src\Repositories;

use App\Repositories\Repository;
use Modules\Auth\src\Entities\PasswordResetToken;
use Modules\Auth\src\Interfaces\PasswordResetTokenRepositoryInterface;

class PasswordResetTokenRepository extends Repository implements PasswordResetTokenRepositoryInterface
{
    public function __construct(PasswordResetToken $passwordReset)
    {
        parent::__construct($passwordReset);
    }

    public function findByEmail(string $email): ?object
    {
        return $this->entity->whereEmail($email)->first();
    }

    public function deleteByEmail(string $email): void
    {
        $this->entity->whereEmail($email)->delete();
    }
}
