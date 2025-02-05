<?php

namespace App\Interfaces;

interface CustomerAddressRepositoryInterface extends RepositoryInterface
{
    public function getByCustomerId(int $customerId): object;
}
