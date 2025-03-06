<?php

namespace Modules\Customers\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Customers\database\Factories\CustomerAddressFactory;

class CustomerAddress extends Entity
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'street_address',
        'city',
        'state',
        'postal_code',
        'country_id',
        'description'
    ];

    protected static function newFactory(): object
    {
        return CustomerAddressFactory::new();
    }
}
