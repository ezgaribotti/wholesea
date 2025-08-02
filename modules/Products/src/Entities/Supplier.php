<?php

namespace Modules\Products\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Customers\src\Entities\Country;
use Modules\Products\database\Factories\SupplierFactory;

class Supplier extends Entity
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'country_id',
    ];

    public function country(): object
    {
        return $this->belongsTo(Country::class);
    }

    protected static function newFactory(): object
    {
        return SupplierFactory::new();
    }
}
