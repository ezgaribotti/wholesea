<?php

namespace Modules\Customers\src\Entities;

use App\Entities\Entity;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Customers\database\Factories\CountryFactory;

class Country extends Entity
{
    use HasFactory;

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope());
    }

    protected static function newFactory(): object
    {
        return CountryFactory::new();
    }
}
