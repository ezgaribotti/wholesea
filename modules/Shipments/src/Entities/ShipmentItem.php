<?php

namespace Modules\Shipments\src\Entities;

use App\Entities\NoTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shipments\database\Factories\ShipmentItemFactory;

class ShipmentItem extends NoTimestamp
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
