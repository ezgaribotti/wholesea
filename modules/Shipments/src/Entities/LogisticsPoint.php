<?php

namespace Modules\Shipments\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\src\Entities\Scopes\ActiveScope;
use Modules\Shipments\database\Factories\LogisticsPointFactory;

class LogisticsPoint extends Entity
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'active',
        'country_id',
        'transport_type_id',
        'latitude',
        'longitude',
        'service_fee',
    ];

    public function transportType(): object
    {
        return $this->belongsTo(TransportType::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope());
    }

    protected static function newFactory(): object
    {
        return LogisticsPointFactory::new();
    }
}
