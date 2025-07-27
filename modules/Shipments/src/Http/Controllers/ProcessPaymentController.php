<?php

namespace Modules\Shipments\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Modules\Common\src\Services\StripeService;
use Modules\Shipments\src\Interfaces\PaymentRepositoryInterface;
use Modules\Shipments\src\Interfaces\ShipmentRepositoryInterface;
use Modules\Shipments\src\Interfaces\TrackingStatusRepositoryInterface;
use Modules\Shipments\src\Mail\ShipmentPaid;

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
        $shipment = $this->shipmentRepository->find($request->reference_id);
        $payment = $shipment->payment;
        $session = StripeService::retrieveSession($payment->external_reference);

        if ($session->status != 'complete' || $session->payment_status != 'paid') {
            return response('Unpaid or incomplete payment to process.');

        }
        $this->paymentRepository->update(['status' => $session->payment_status], $payment->id);

        $trackingStatus = $this->trackingStatusRepository->findByName('pending');
        $this->shipmentRepository->update([
            'tracking_status_id' => $trackingStatus->id,
        ], $shipment->id);

        $customer = $shipment->customerAddress->customer;
        Mail::to($customer->email)
            ->send(new ShipmentPaid($shipment));

        return response('Shipment successfully paid.');
    }

    public function cancel(Request $request): object
    {
        return response('Shipment successfully canceled.');
    }
}
