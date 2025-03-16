<?php

namespace Modules\Shipments\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\src\Services\StripeService;
use Modules\Shipments\src\Interfaces\ShipmentRepositoryInterface;
use Modules\Shipments\src\Interfaces\TrackingRepositoryInterface;
use Modules\Shipments\src\Interfaces\TrackingStatusRepositoryInterface;

class ProcessPaymentController extends Controller
{
    public function __construct(
        protected ShipmentRepositoryInterface $shipmentRepository,
        protected TrackingStatusRepositoryInterface $trackingStatusRepository,
        protected TrackingRepositoryInterface $trackingRepository,
    )
    {
    }

    public function success(Request $request): object
    {
        if (!$request->hasValidSignature()) {
            return redirect()->toClient([
                'message' => 'Invalid signature.'
            ]);
        }

        $shipment = $this->shipmentRepository->find($request->reference_id);
        if ($shipment->status != 'in_progress') {
            return redirect()->toClient([
                'message' => 'Payment has already been processed.'
            ]);
        }
        $session = StripeService::retrieveSession($shipment->external_reference);

        if ($session->status != 'complete' || $session->payment_status != 'paid') {
            return redirect()->toClient([
                'message' => 'Payment is not processable.'
            ]);
        }

        $this->shipmentRepository->update([
            'status' => $session->payment_status,
            'issued_at' => $request->issued_at,
        ], $shipment->id);

        $trackingStatus = $this->trackingStatusRepository->findByName('pending');

        $this->trackingRepository->create([
            'shipment_id' => $shipment->id,
            'tracking_status_id' => $trackingStatus->id,
        ]);

        return redirect()->toClient([
            'message' => 'Shipment successfully paid.'
        ]);
    }

    public function cancel(Request $request): object
    {
        if (!$request->hasValidSignature()) {
            return redirect()->toClient([
                'message' => 'Invalid signature.'
            ]);
        }

        $shipment = $this->shipmentRepository->find($request->reference_id);
        if ($shipment->status != 'in_progress') {
            return redirect()->toClient([
                'message' => 'Payment has already been processed.'
            ]);
        }

        $this->shipmentRepository->update([
            'issued_at' => $request->issued_at,
            'status' => 'canceled',
        ], $shipment->id);

        return redirect()->toClient([
            'message' => 'Shipment successfully canceled.'
        ]);
    }
}
