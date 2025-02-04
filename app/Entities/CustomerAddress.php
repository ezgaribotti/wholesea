<?php

namespace App\Entities;

use Database\Factories\CustomerAddressFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerAddress extends Entity
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'country_id',
        'full_street',
        'postal_code',
        'city',
        'state',
        'description',
    ];

    public function country(): object
    {
        return $this->belongsTo(Country::class);
    }

    protected static function newFactory(): object
    {
        return CustomerAddressFactory::new();
    }
}
