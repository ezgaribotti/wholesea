<?php

namespace Modules\Shipments\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Common\src\Http\Resources\UrlToPayResource;
use Modules\Common\src\Services\StripeService;
use Modules\Shipments\src\Http\Requests\StoreShipmentRequest;
use Modules\Shipments\src\Http\Requests\UpdateShipmentRequest;
use Modules\Shipments\src\Http\Resources\ShipmentResource;
use Modules\Shipments\src\Http\Resources\ShipmentSummaryResource;
use Modules\Shipments\src\Interfaces\PaymentRepositoryInterface;
use Modules\Shipments\src\Interfaces\ShipmentItemRepositoryInterface;
use Modules\Shipments\src\Interfaces\ShipmentRepositoryInterface;
use Modules\Shipments\src\Interfaces\TrackingStatusRepositoryInterface;

class ShipmentController extends Controller
{
    public function __construct(
        protected ShipmentRepositoryInterface $shipmentRepository,
        protected ShipmentItemRepositoryInterface $itemRepository,
        protected TrackingStatusRepositoryInterface $trackingStatusRepository,
        protected PaymentRepositoryInterface $paymentRepository,
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
        $cost = config('shipments.cost');

        $trackingCode = Str::ulid();
        $trackingStatus = $this->trackingStatusRepository->findByName('unpaid');
        $shipment = $this->shipmentRepository->create([
            'tracking_code' => $trackingCode,
            'tracking_status_id' => $trackingStatus->id,
            'customer_address_id' => $request->customer_address_id,
            'cost' => $cost,
        ]);

        collect($request->items)->each(function ($item) use ($shipment) {
            $item = to_object($item);

            $this->itemRepository->create([
                'shipment_id' => $shipment->id,
                'name' => $item->name,
                'weight' => $item->weight,
                'quantity' => $item->quantity,
                'description' => $item->description,
            ]);

        });
        $label = 'Payment for shipping';

        $items = [[
            'name' => $label,
            'unit_amount' => $cost,
            'quantity' => 1,
        ]];

        $routeNames = config('shipments.route_names');

        $customer = $shipment->customerAddress->customer;
        $session = StripeService::createSession($shipment->id, $trackingCode, $customer->email, $items, $routeNames);

        $payment = $this->paymentRepository->create([
            'external_reference' => $session->id,
            'tracking_code' => $trackingCode,
        ]);

        $this->shipmentRepository->update([
            'payment_id' => $payment->id,
        ], $shipment->id);

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
        return response()->justMessage('Shipment successfully updated.');
    }
}
