<?php

namespace Modules\Customers\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Customers\database\Factories\CustomerFactory;

class Customer extends Entity
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'status',
        'email',
        'full_phone',
    ];

    public function addresses(): object
    {
        return $this->hasMany(CustomerAddress::class);
    }

    protected static function newFactory(): object
    {
        return CustomerFactory::new();
    }
}
