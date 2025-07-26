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
        $trackingStatus = $this->trackingStatusRepository->findByName('pending');

        $shipment = $this->shipmentRepository->create([
            'customer_address_id' => $order->customer_address_id,
            'tracking_code' => $order->tracking_code,
            'tracking_status_id' => $trackingStatus->id,
            'payment_id' => $order->payment_id,
            'cost' => 0,
        ]);

        $shipmentId = $shipment->id;
        $order->products->each(function ($product) use ($shipmentId) {
            $this->shipmentItemRepository->create([
                'shipment_id' => $shipmentId,
                'name' => $product->sku,
                'quantity' => $product->pivot->quantity,
                'weight' => 0,
            ]);
        });
    }
}
