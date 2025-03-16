<?php

namespace Modules\Shipments\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shipments\database\Factories\TrackingStatusFactory;

class TrackingStatus extends Entity
{
    use HasFactory;

    protected $fillable = [
        'name',
        'priority',
    ];

    protected static function newFactory(): object
    {
        return TrackingStatusFactory::new();
    }
}
