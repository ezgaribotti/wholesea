<?php

namespace Modules\Orders\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Modules\Common\src\Enums\CustomerStatus;
use Modules\Common\src\Services\StripeService;
use Modules\Orders\src\Events\ShippingPaid;
use Modules\Orders\src\Interfaces\OrderRepositoryInterface;
use Modules\Orders\src\Interfaces\PaymentRepositoryInterface;
use Modules\Orders\src\Interfaces\ProductRepositoryInterface;
use Modules\Orders\src\Mail\OrderPaid;

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
        $session = StripeService::retrieveSession($payment->session_id);

        if ($session->status != 'complete' || $session->payment_status != 'paid') {
            return response('Unpaid or incomplete payment to process.');

        }
        $this->paymentRepository->update([
            'status' => CustomerStatus::Paid, 'paid_at' => now()], $payment->id);

        if ($session->shipping_options) {
            ShippingPaid::dispatch($order);
        }
        $customer = $order->customerAddress->customer;
        Mail::to($customer->email)
            ->send(new OrderPaid($order, count($session->shipping_options) === 1));

        return response('Order successfully paid.');
    }

    public function cancel(Request $request): object
    {
        $order = $this->orderRepository->find($request->reference_id);
        $payment = $order->payment;

        // Restore reserved stock

        $order->products->each(function ($product) {
            $this->productRepository->update([
                'stock' => $product->stock + $product->pivot->quantity
            ], $product->id);
        });

        StripeService::expireSession($payment->session_id);
        $this->paymentRepository->update(['status' => CustomerStatus::Canceled], $payment->id);

        return response('Order successfully canceled.');
    }
}
