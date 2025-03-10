<?php

namespace Modules\Orders\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Orders\src\Interfaces\PaymentRepositoryInterface;

class StripeController extends Controller
{
    public function __construct(
        protected PaymentRepositoryInterface $paymentRepository,
    )
    {
    }

    public function success(string $trackingNumber): object
    {
        return response()->json($trackingNumber);
    }

    public function cancel(string $trackingNumber): object
    {
        return response()->json($trackingNumber);
    }
}
