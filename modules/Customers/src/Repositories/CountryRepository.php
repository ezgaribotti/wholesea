<?php

namespace Modules\Customers\src\Repositories;

use App\Repositories\Repository;
use Modules\Customers\src\Entities\Country;
use Modules\Customers\src\Interfaces\CountryRepositoryInterface;

class CountryRepository extends Repository implements CountryRepositoryInterface
{
    public function __construct(Country $country)
    {
        parent::__construct($country);
    }
}
