<?php

namespace Modules\Payments\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Payments\database\Factories\PaymentFactory;

class Payment extends Entity
{
    use HasFactory;

    protected $fillable = [
        'external_reference',
        'status',
    ];

    protected static function newFactory(): object
    {
        return PaymentFactory::new();
    }
}
