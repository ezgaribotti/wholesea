<?php

namespace Modules\Customers\src\Repositories;

use App\Repositories\Repository;
use Modules\Customers\src\Entities\Customer;
use Modules\Customers\src\Interfaces\CustomerRepositoryInterface;

class CustomerRepository extends Repository implements CustomerRepositoryInterface
{
    public function __construct(Customer $customer)
    {
        parent::__construct($customer);
    }

    public function findByEmail(string $email): ?object
    {
        return $this->entity->whereEmail($email)->first();
    }
}
