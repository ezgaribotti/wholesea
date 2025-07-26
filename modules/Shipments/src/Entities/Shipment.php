<?php

namespace Modules\Shipments\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\src\Entities\CustomerAddress;
use Modules\Common\src\Entities\Payment;
use Modules\Shipments\database\Factories\ShipmentFactory;

class Shipment extends Entity
{
    use HasFactory;

    protected $fillable = [
        'tracking_code',
        'tracking_status_id',
        'customer_address_id',
        'cost',
        'payment_id',
    ];

    public function customerAddress(): object
    {
        return $this->belongsTo(CustomerAddress::class);
    }

    public function items(): object
    {
        return $this->hasMany(ShipmentItem::class);
    }

    public function payment(): object
    {
        return $this->belongsTo(Payment::class);
    }

    public function trackingStatus(): object
    {
        return $this->belongsTo(TrackingStatus::class);
    }

    protected static function newFactory(): object
    {
        return ShipmentFactory::new();
    }
}
