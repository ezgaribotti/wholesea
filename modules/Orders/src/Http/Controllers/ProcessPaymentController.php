<?php

namespace Modules\Orders\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\src\Services\StripeService;
use Modules\Orders\src\Events\ShippingPaid;
use Modules\Orders\src\Interfaces\OrderRepositoryInterface;
use Modules\Orders\src\Interfaces\PaymentRepositoryInterface;
use Modules\Orders\src\Interfaces\ProductRepositoryInterface;

class ProcessPaymentController extends Controller
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
        protected PaymentRepositoryInterface $paymentRepository,
        protected ProductRepositoryInterface $productRepository,
    )
    {
    }

    public function success(Request $request): object
    {
        $order = $this->orderRepository->find($request->reference_id);
        $payment = $order->payment;

        if ($payment->status === 'canceled') {
            return response('Payment previously canceled.');
        }

        $session = StripeService::retrieveSession($payment->external_reference);

        if ($session->status != 'complete' || $session->payment_status != 'paid') {
            return response('Unpaid or incomplete payment to process.');

        }
        $this->paymentRepository->update(['status' => $session->payment_status], $payment->id);

        if ($session->shipping_options) {
            ShippingPaid::dispatch($order);
        }
        return response('Order successfully paid.');
    }

    public function cancel(Request $request): object
    {
        $order = $this->orderRepository->find($request->reference_id);
        $payment = $order->payment;

        if ($payment->status === 'canceled') {
            return response('Payment previously canceled.');
        }

        // Restore reserved stock

        $order->products->each(function ($product) {
            $this->productRepository->update([
                'stock' => $product->stock + $product->pivot->quantity
            ], $product->id);
        });

        $this->paymentRepository->update(['status' => 'canceled'], $payment->id);

        return response('Order successfully canceled.');
    }
}
