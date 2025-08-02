<?php

namespace Modules\Shipments\src\Entities;

use App\Entities\NoTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shipments\database\Factories\TransportTypeFactory;

class TransportType extends NoTimestamp
{
    use HasFactory;

    protected $fillable = [
        'name',
        'deviation_factor',
    ];

    protected static function newFactory(): object
    {
        return TransportTypeFactory::new();
    }
}
