<?php

namespace App\Repositories;

use App\Entities\Customer;
use App\Interfaces\CustomerRepositoryInterface;

class CustomerRepository extends Repository implements CustomerRepositoryInterface
{
    public function __construct(Customer $customer)
    {
        parent::__construct($customer);
    }
}
