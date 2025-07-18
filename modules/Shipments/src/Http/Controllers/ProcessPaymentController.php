<?php

namespace Modules\Shipments\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\src\Services\StripeService;
use Modules\Shipments\src\Interfaces\PaymentRepositoryInterface;
use Modules\Shipments\src\Interfaces\ShipmentRepositoryInterface;
use Modules\Shipments\src\Interfaces\TrackingStatusRepositoryInterface;

class ProcessPaymentController extends Controller
{
    public function __construct(
        protected ShipmentRepositoryInterface $shipmentRepository,
        protected TrackingStatusRepositoryInterface $trackingStatusRepository,
        protected PaymentRepositoryInterface $paymentRepository,
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
        $payment = $shipment->payment;
        if ($payment->status != 'in_progress') {
            return redirect()->toClient([
                'message' => 'Payment has already been processed.'
            ]);
        }
        $session = StripeService::retrieveSession($payment->external_reference);

        if ($session->status != 'complete' || $session->payment_status != 'paid') {
            return redirect()->toClient([
                'message' => 'Payment is not processable.'
            ]);
        }

        $this->paymentRepository->update(['status' => $session->payment_status], $payment->id);

        $trackingStatus = $this->trackingStatusRepository->findByName('pending');
        $this->shipmentRepository->update([
            'tracking_status_id' => $trackingStatus->id,
        ], $shipment->id);

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
        $payment = $shipment->payment;
        if ($payment->status != 'in_progress') {
            return redirect()->toClient([
                'message' => 'Payment has already been processed.'
            ]);
        }

        $this->paymentRepository->update(['status' => 'canceled'], $payment->id);

        return redirect()->toClient([
            'message' => 'Shipment successfully canceled.'
        ]);
    }
}
