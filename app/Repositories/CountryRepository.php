<?php

namespace App\Repositories;

use App\Entities\Country;
use App\Interfaces\CountryRepositoryInterface;

class CountryRepository extends Repository implements CountryRepositoryInterface
{
    public function __construct(Country $country)
    {
        parent::__construct($country);
    }
}
