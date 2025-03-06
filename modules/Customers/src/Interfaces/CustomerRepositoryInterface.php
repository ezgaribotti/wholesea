<?php

namespace Modules\Customers\src\Interfaces;

use App\Interfaces\RepositoryInterface;

interface CustomerRepositoryInterface extends RepositoryInterface
{
    public function findByEmail(string $email): ?object;
}
