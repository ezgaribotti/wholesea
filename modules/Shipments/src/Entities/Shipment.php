<?php

namespace Modules\Shipments\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shipments\database\Factories\ShipmentFactory;

class Shipment extends Entity
{
    use HasFactory;

    protected $fillable = [
        'customer_address_id',
        'tracking_number',
    ];

    protected static function newFactory(): object
    {
        return ShipmentFactory::new();
    }
}
