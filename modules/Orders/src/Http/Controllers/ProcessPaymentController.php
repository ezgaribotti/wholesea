<?php

namespace Modules\Orders\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\src\Services\StripeService;
use Modules\Orders\src\Interfaces\OrderRepositoryInterface;

class ProcessPaymentController extends Controller
{
    public function __construct(
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

        $order = $this->orderRepository->find($request->reference_id);
        if ($order->status != 'in_progress') {
            return redirect()->toClient([
                'message' => 'Payment has already been processed.'
            ]);
        }
        $session = StripeService::retrieveSession($order->external_reference);

        if ($session->status != 'complete' || $session->payment_status != 'paid') {
            return redirect()->toClient([
                'message' => 'Payment is not processable.'
            ]);
        }

        $this->orderRepository->update([
            'status' => $session->payment_status,
            'issued_at' => $request->issued_at,
        ], $order->id);

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

        $order = $this->orderRepository->find($request->reference_id);
        if ($order->status != 'in_progress') {
            return redirect()->toClient([
                'message' => 'Payment has already been processed.'
            ]);
        }

        $this->orderRepository->update([
            'issued_at' => $request->issued_at,
            'status' => 'canceled',
        ], $order->id);

        return redirect()->toClient([
            'message' => 'Payment successfully canceled.'
        ]);
    }
}
