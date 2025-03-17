<?php

namespace Modules\Customers\src\Entities;

use App\Entities\NoTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\src\Entities\Scopes\ActiveScope;
use Modules\Customers\database\Factories\CountryFactory;

class Country extends NoTimestamp
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
