<?php

namespace Modules\Orders\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Orders\database\Factories\PaymentFactory;

class Payment extends Entity
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'external_reference',
        'status',
        'issued_at',
    ];

    protected static function newFactory(): object
    {
        return PaymentFactory::new();
    }
}
