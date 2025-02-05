<?php

namespace App\Repositories;

use App\Entities\CustomerAddress;
use App\Interfaces\CustomerAddressRepositoryInterface;

class CustomerAddressRepository extends Repository implements CustomerAddressRepositoryInterface
{
    public function __construct(CustomerAddress $address)
    {
        parent::__construct($address);
    }

    public function getByCustomerId(int $customerId): object
    {
        return $this->entity->whereCustomerId($customerId)->get();
    }
}
