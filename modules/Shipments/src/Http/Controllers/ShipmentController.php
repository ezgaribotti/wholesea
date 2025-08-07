<?php

namespace Modules\Shipments\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Modules\Common\src\Http\Resources\UrlToPayResource;
use Modules\Common\src\Services\StripeService;
use Modules\Shipments\src\Http\Requests\StoreShipmentRequest;
use Modules\Shipments\src\Http\Requests\UpdateShipmentRequest;
use Modules\Shipments\src\Http\Resources\ShipmentResource;
use Modules\Shipments\src\Http\Resources\ShipmentSummaryResource;
use Modules\Shipments\src\Interfaces\OrderRepositoryInterface;
use Modules\Shipments\src\Interfaces\PaymentRepositoryInterface;
use Modules\Shipments\src\Interfaces\ShipmentRepositoryInterface;
use Modules\Shipments\src\Interfaces\TaxRepositoryInterface;
use Modules\Shipments\src\Interfaces\TrackingStatusRepositoryInterface;
use Modules\Shipments\src\Mail\ShipmentSynced;

class ShipmentController extends Controller
{
    public function __construct(
        protected ShipmentRepositoryInterface $shipmentRepository,
        protected TrackingStatusRepositoryInterface $trackingStatusRepository,
        protected PaymentRepositoryInterface $paymentRepository,
        protected OrderRepositoryInterface $orderRepository,
        protected TaxRepositoryInterface $taxRepository,
    )
    {
    }

    public function index(Request $request): object
    {
        $shipments = $this->shipmentRepository->paginate($request->filters);
        return response()->withPaginate(ShipmentSummaryResource::collection($shipments));
    }

    public function store(StoreShipmentRequest $request): object
    {
        $shipment = $this->shipmentRepository->findByOrderId($request->order_id);
        if ($shipment && $payment = $shipment->order->payment) {
            if ($payment->status == 'in_progress') {

                return response()->success(new UrlToPayResource($payment->url));
            }

            // To create another shipment you have to step on the existing one

            abort(422, 'The shipment has no payment in progress.');
        }
        $order = $this->orderRepository->find($request->order_id);

        $weight = $order->products->sum('weight');
        if ($weight <= 0) {
            abort(422, 'The weight of the items must be greater than 0.');
        }
        $cost = $weight * $order->country->cost_per_weight;

        // Update payment to add the shipping option

        $payment = $order->payment;
        $session = StripeService::addShippingOptions($payment->session_id, $cost);

        $trackingStatus = $this->trackingStatusRepository->findByName('unpaid');
        $this->shipmentRepository->create(array_merge($request->validated(), [
            'final_cost' => $cost,
            'coordinates' => json_encode([]),
            'tracking_status_id' => $trackingStatus->id,
            'weight' => $weight,
        ]));

        $this->paymentRepository->update(['total_amount' => $payment->total_amount + $cost], $payment->id);

        return response()->success(new UrlToPayResource($session->url));
    }

    public function show(string $id): object
    {
        $shipment = $this->shipmentRepository->find($id);
        if (!$shipment) {
            abort(404, 'Shipment not found.');
        }
        return response()->success(new ShipmentResource($shipment));
    }

    public function update(UpdateShipmentRequest $request, string $id): object
    {
        $this->shipmentRepository->update($request->validated(), $id);
        $shipment = $this->shipmentRepository->find($id);

        $customer = $shipment->order->customerAddress->customer;
        Mail::to($customer->email)->send(new ShipmentSynced($shipment));

        return response()->justMessage('Shipment successfully updated.');
    }
}
