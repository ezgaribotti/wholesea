<?php

namespace Modules\Orders\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\src\Http\Resources\UrlToPayResource;
use Modules\Common\src\Services\StripeService;
use Modules\Orders\src\Http\Requests\StoreOrderRequest;
use Modules\Orders\src\Http\Requests\UpdateOrderRequest;
use Modules\Orders\src\Http\Resources\OrderResource;
use Modules\Orders\src\Http\Resources\OrderSummaryResource;
use Modules\Orders\src\Interfaces\OrderRepositoryInterface;
use Modules\Orders\src\Interfaces\PaymentRepositoryInterface;
use Modules\Orders\src\Interfaces\ProductRepositoryInterface;

class OrderController extends Controller
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
        protected ProductRepositoryInterface $productRepository,
        protected PaymentRepositoryInterface $paymentRepository,
    )
    {
    }

    public function index(Request $request): object
    {
        $orders = $this->orderRepository->paginate($request->filters);
        return response()->withPaginate(OrderSummaryResource::collection($orders));
    }

    public function store(StoreOrderRequest $request): object
    {
        $trackingNumber = uniqid(create_prefix($request->path()));
        $totalAmount = 0;

        $order = $this->orderRepository->create([
            'tracking_number' => $trackingNumber,
            'customer_address_id' => $request->customer_address_id,
            'total_amount' => $totalAmount,
        ]);

        $items = [];
        collect($request->items)->each(function ($item) use ($order, &$items, &$totalAmount) {
            $item = to_object($item);
            $product = $this->productRepository->find($item->product_id);

            $order->products()->attach($product->id, [
                'fixed_price' => $product->unit_price,
                'quantity' => $item->quantity
            ]);

            $totalAmount += $product->unit_price * $item->quantity;
            $items[] = [
                'name' => $product->name,
                'unit_amount' => $product->unit_price,
                'quantity' => $item->quantity,
            ];
        });
        $routeNames = config('orders.route_names');

        $shippingCost = $request->pay_shipping ? 2000 : 0;
        $customer = $order->customerAddress->customer;
        $session = StripeService::createSession($order->id, $customer->email, $items, $routeNames, $shippingCost);

        $payment = $this->paymentRepository->create([
            'external_reference' => $session->id,
        ]);

        $this->orderRepository->update([
            'total_amount' => $totalAmount + $shippingCost,
            'payment_id' => $payment->id,
        ], $order->id);

        return response()->success(new UrlToPayResource($session->url));
    }

    public function show(string $id): object
    {
        $order = $this->orderRepository->find($id);
        if (!$order) {
            abort(404, 'Order not found.');
        }

        return response()->success(new OrderResource($order));
    }

    public function update(UpdateOrderRequest $request, string $id): object
    {
        $this->orderRepository->update($request->validated(), $id);
        return response()->justMessage('Order successfully updated.');
    }
}
