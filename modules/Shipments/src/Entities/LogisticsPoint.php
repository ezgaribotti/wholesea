<?php

namespace Modules\Shipments\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\src\Entities\Scopes\ActiveScope;
use Modules\Shipments\database\Factories\LogisticsPointFactory;

class LogisticsPoint extends Entity
{
    use HasFactory;

    protected $fillable = [
        'name'.
        'active',
        'country_id',
        'transport_type_id',
        'latitude',
        'longitude',
        'service_fee',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope());
    }

    protected static function newFactory(): object
    {
        return LogisticsPointFactory::new();
    }
}
