<?php

namespace Modules\Shipments\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shipments\database\Factories\ShippingCalculationFactory;

class ShippingCalculation extends Entity
{
    use HasFactory;

    protected $fillable = [
        'tracking_code',
        'cost',
    ];

    protected static function newFactory(): object
    {
        return ShippingCalculationFactory::new();
    }
}
