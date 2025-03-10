<?php

namespace Modules\Orders\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\src\Entities\CustomerAddress;
use Modules\Common\src\Entities\Product;
use Modules\Orders\database\Factories\OrderFactory;

class Order extends Entity
{
    use HasFactory;

    protected $fillable = [
        'tracking_number',
        'status',
        'customer_address_id',
        'total_amount',
    ];

    public function customerAddress(): object
    {
        return $this->belongsTo(CustomerAddress::class);
    }

    public function products(): object
    {
        return $this->belongsToMany(Product::class)->withPivot(['fixed_price', 'quantity']);
    }

    protected static function newFactory(): object
    {
        return OrderFactory::new();
    }
}
