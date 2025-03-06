<?php

namespace Modules\Customers\src\Interfaces;

use App\Interfaces\RepositoryInterface;

interface CustomerAddressRepositoryInterface extends RepositoryInterface
{
    public function getByCustomerId(int $customerId): object;
}
