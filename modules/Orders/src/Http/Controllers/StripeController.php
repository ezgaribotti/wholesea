<?php

namespace Modules\Orders\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Orders\src\Interfaces\OrderRepositoryInterface;
use Modules\Orders\src\Interfaces\PaymentRepositoryInterface;
use Modules\Orders\src\Services\StripeService;

class StripeController extends Controller
{
    public function __construct(
        protected PaymentRepositoryInterface $paymentRepository,
        protected OrderRepositoryInterface $orderRepository,
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

        $order = $this->orderRepository->find($request->order_id);
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
        $this->paymentRepository->update([
            'status' => $session->payment_status
        ], $payment->id);

        return redirect()->toClient([
            'message' => 'Payment successfully paid.'
        ]);
    }

    public function cancel(Request $request): object
    {
        if (!$request->hasValidSignature()) {
            return redirect()->toClient([
                'message' => 'Invalid signature.'
            ]);
        }

        $order = $this->orderRepository->find($request->order_id);
        $payment = $order->payment;
        if ($payment->status != 'in_progress') {
            return redirect()->toClient([
                'message' => 'Payment has already been processed.'
            ]);
        }

        $this->orderRepository->update(['status' => 'canceled'], $order->id);
        $this->paymentRepository->update(['status' => 'canceled'], $payment->id);

        return redirect()->toClient([
            'message' => 'Payment successfully canceled.'
        ]);
    }
}
