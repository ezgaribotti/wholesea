<?php

namespace Modules\Shipments\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shipments\database\Factories\CargoManifestFactory;

class CargoManifest extends Entity
{
    use HasFactory;

    protected $fillable = [
        'transport_code',
        'transport_type_id',
        'status',
        'coordinates',
        'total_weight',
        'extra_handling_fee',
        'final_cost',
        'departure_at',
        'arrival_at',
    ];

    protected static function newFactory(): object
    {
        return CargoManifestFactory::new();
    }
}
