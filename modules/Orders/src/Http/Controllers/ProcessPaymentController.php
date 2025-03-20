<?php

namespace Modules\Orders\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\src\Services\StripeService;
use Modules\Orders\src\Events\ShippingPaid;
use Modules\Orders\src\Interfaces\OrderRepositoryInterface;
use Modules\Orders\src\Interfaces\PaymentRepositoryInterface;

class ProcessPaymentController extends Controller
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
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

        $order = $this->orderRepository->find($request->reference_id);
        $payment = $order->payment;
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

        if ($session->shipping_options) {
            ShippingPaid::dispatch($order);
        }

        return redirect()->toClient([
            'message' => 'Order successfully paid.'
        ]);
    }

    public function cancel(Request $request): object
    {
        if (!$request->hasValidSignature()) {
            return redirect()->toClient([
                'message' => 'Invalid signature.'
            ]);
        }

        $order = $this->orderRepository->find($request->reference_id);
        $payment = $order->payment;
        if ($payment->status != 'in_progress') {
            return redirect()->toClient([
                'message' => 'Payment has already been processed.'
            ]);
        }

        $this->paymentRepository->update(['status' => 'canceled'], $payment->id);

        return redirect()->toClient([
            'message' => 'Order successfully canceled.'
        ]);
    }
}
