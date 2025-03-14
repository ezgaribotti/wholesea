<?php

namespace Modules\Shipments\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shipments\database\Factories\ShipmentItemFactory;

class ShipmentItem extends Entity
{
    use HasFactory;

    protected $fillable = [
        'shipment_id',
        'name',
        'weight',
        'quantity',
        'description',
    ];

    protected static function newFactory(): object
    {
        return ShipmentItemFactory::new();
    }
}
