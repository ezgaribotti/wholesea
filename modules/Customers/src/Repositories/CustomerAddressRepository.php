<?php

namespace Modules\Customers\src\Repositories;

use App\Repositories\Repository;
use Modules\Customers\src\Entities\CustomerAddress;
use Modules\Customers\src\Interfaces\CustomerAddressRepositoryInterface;

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
