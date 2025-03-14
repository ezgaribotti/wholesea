<?php

namespace Modules\Shipments\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shipments\database\Factories\TrackingFactory;

class Tracking extends Entity
{
    use HasFactory;

    protected $fillable = [
        'shipment_id',
        'tracking_status_id',
    ];

    protected static function newFactory(): object
    {
        return TrackingFactory::new();
    }
}
