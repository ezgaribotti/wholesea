<?php

namespace Modules\Customers\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Customers\database\Factories\CountryFactory;

class Country extends Entity
{
    use HasFactory;

    protected static function newFactory(): object
    {
        return CountryFactory::new();
    }
}
