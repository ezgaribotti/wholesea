<?php

namespace Modules\Shipments\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\src\Entities\Order;
use Modules\Shipments\database\Factories\ShipmentFactory;

class Shipment extends Entity
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'tracking_status_id',
        'cargo_manifest_id',
        'insurance_policy_id',
        'weight',
        'shipping_cost',
    ];

    public function order(): object
    {
        return $this->belongsTo(Order::class);
    }

    public function cargoManifest(): object
    {
        return $this->belongsTo(CargoManifest::class);
    }

    public function insurancePolicy(): object
    {
        return $this->belongsTo(InsurancePolicy::class);
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
