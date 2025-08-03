<?php

namespace Modules\Orders\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $trackingCode = Str::ulid();
        $totalAmount = 0;

        $order = $this->orderRepository->create([
            'tracking_code' => $trackingCode,
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

            $this->productRepository->update([
                'stock' => $product->stock - $item->quantity
            ], $product->id);

            $totalAmount += $product->unit_price * $item->quantity;
            $items[] = [
                'name' => $product->name,
                'unit_amount' => $product->unit_price,
                'quantity' => $item->quantity,
            ];
        });
        $routeNames = config('orders.route_names');

        $customer = $order->customerAddress->customer;
        $session = StripeService::createSession($order->id, $trackingCode, $customer->email, $items, $routeNames);

        $payment = $this->paymentRepository->create([
            'external_session_id' => $session->id,
            'tracking_code' => $trackingCode,
            'url' => $session->url,
        ]);

        $this->orderRepository->update([
            'total_amount' => $totalAmount,
            'payment_id' => $payment->id,
        ], $order->id);

        $order = $this->orderRepository->find($order->id);
        return response()->success($request->pay_shipping ? new OrderResource($order) : new UrlToPayResource($session->url));
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
