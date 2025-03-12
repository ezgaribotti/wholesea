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
        $clientUrl = config('common.client_url');

        if (!$request->hasValidSignature()) {
            return redirect()->away(build_url($clientUrl, [
                'has_error' => 1,
                'message' => 'Invalid signature.',
            ]));
        }

        $order = $this->orderRepository->find($request->order_id);
        if (!$order) {
            return redirect()->away(build_url($clientUrl, [
                'has_error' => 1,
                'message' => 'Order not found.',
            ]));
        }

        $payment = $order->payment;
        if ($payment->status != 'in_progress') {
            return redirect()->away(build_url($clientUrl, [
                'has_error' => 1,
                'message' => 'Payment has already been processed.',
            ]));
        }
        $session = StripeService::retrieveSession($payment->session_id);

        if ($session->status != 'complete' || $session->payment_status != 'paid') {
            return redirect()->away(build_url($clientUrl, [
                'has_error' => 1,
                'message' => 'Payment is not processable.',
            ]));
        }
        $this->paymentRepository->update(['status' => $session->payment_status], $payment->id);

        return redirect()->away(build_url($clientUrl, [
            'has_error' => 0,
            'message' => 'Payment successfully paid.',
        ]));
    }

    public function cancel(Request $request): object
    {
        $clientUrl = config('common.client_url');

        if (!$request->hasValidSignature()) {
            return redirect()->away(build_url($clientUrl, [
                'has_error' => 1,
                'message' => 'Invalid signature.',
            ]));
        }

        $order = $this->orderRepository->find($request->order_id);
        if (!$order) {
            return redirect()->away(build_url($clientUrl, [
                'has_error' => 1,
                'message' => 'Order not found.',
            ]));
        }

        $payment = $order->payment;
        if ($payment->status != 'in_progress') {
            return redirect()->away(build_url($clientUrl, [
                'has_error' => 1,
                'message' => 'Payment has already been processed.',
            ]));
        }

        $this->orderRepository->update(['status' => 'canceled'], $order->id);
        $this->paymentRepository->update(['status' => 'canceled'], $payment->id);

        return redirect()->away(build_url($clientUrl, [
            'has_error' => 0,
            'message' => 'Payment successfully canceled.',
        ]));
    }
}
