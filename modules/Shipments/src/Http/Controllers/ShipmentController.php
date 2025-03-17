<?php

namespace Modules\Shipments\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\src\Http\Resources\UrlToPayResource;
use Modules\Common\src\Services\StripeService;
use Modules\Shipments\src\Http\Requests\StoreShipmentRequest;
use Modules\Shipments\src\Http\Requests\UpdateShipmentRequest;
use Modules\Shipments\src\Http\Resources\ShipmentResource;
use Modules\Shipments\src\Http\Resources\ShipmentSummaryResource;
use Modules\Shipments\src\Interfaces\PaymentRepositoryInterface;
use Modules\Shipments\src\Interfaces\ShipmentItemRepositoryInterface;
use Modules\Shipments\src\Interfaces\ShipmentRepositoryInterface;

class ShipmentController extends Controller
{
    public function __construct(
        protected ShipmentRepositoryInterface $shipmentRepository,
        protected ShipmentItemRepositoryInterface $itemRepository,
        protected PaymentRepositoryInterface $paymentRepository,
    )
    {
    }

    public function index(Request $request)
    {
        $shipments = $this->shipmentRepository->paginate($request->filters);
        return response()->withPaginate(ShipmentSummaryResource::collection($shipments));
    }

    public function store(StoreShipmentRequest $request)
    {
        $trackingNumber = uniqid();

        $cost = config('shipments.cost');

        $shipment = $this->shipmentRepository->create([
            'tracking_number' => $trackingNumber,
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
        $session = StripeService::createSession($shipment->id, $customer->email, $items, $routeNames);

        $payment = $this->paymentRepository->create([
            'external_reference' => $session->id
        ]);

        $this->shipmentRepository->update([
            'payment_id' => $payment->id,
        ], $shipment->id);

        return response()->success(new UrlToPayResource($session->url));
    }

    public function show(string $id)
    {
        $shipment = $this->shipmentRepository->find($id);
        if (!$shipment) {
            abort(404, 'Shipment not found.');
        }
        return response()->success(new ShipmentResource($shipment));
    }

    public function update(UpdateShipmentRequest $request, string $id)
    {
        $this->shipmentRepository->update($request->validated(), $id);
        return response()->justMessage('Shipment successfully updated.');
    }
}
