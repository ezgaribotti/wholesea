<?php

namespace Modules\Shipments\src\Listeners;

use Modules\Shipments\src\Interfaces\ShipmentItemRepositoryInterface;
use Modules\Shipments\src\Interfaces\ShipmentRepositoryInterface;
use Modules\Shipments\src\Interfaces\TrackingStatusRepositoryInterface;

class PrepareOrder
{
    public function __construct(
        protected ShipmentRepositoryInterface $shipmentRepository,
        protected ShipmentItemRepositoryInterface $shipmentItemRepository,
        protected TrackingStatusRepositoryInterface $trackingStatusRepository,
    )
    {
    }

    public function handle(object $event): void
    {
        $order = $event->order;
        $trackingStatus = $this->trackingStatusRepository->findByName('under_review');

        $shipment = $this->shipmentRepository->create([
            'customer_address_id' => $order->customer_address_id,
            'tracking_number' => $order->tracking_number,
            'tracking_status_id' => $trackingStatus->id,
            'payment_id' => $order->payment_id,
            'cost' => 0,
        ]);

        $descrption = null;
        $order->products->each(function ($product) use (&$descrption) {
            $descrption .= implode(chr(32), [$product->sku, $product->name, $product->pivot->quantity]) . PHP_EOL;
        });

        $label = 'Batch of ordered products';

        $this->shipmentItemRepository->create([
            'shipment_id' => $shipment->id,
            'name' => $label,
            'quantity' => 1,
            'weight' => 0,
            'description' => $descrption,
        ]);
    }
}
