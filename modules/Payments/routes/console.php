<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schedule;
use Modules\Common\src\Enums\PaymentStatus;
use Modules\Common\src\Services\StripeService;
use Modules\Payments\src\Entities\Payment;

Schedule::call(function () {

    // Cancel expired payments

    $payments = Payment::whereStatus(PaymentStatus::InProgress)
        ->whereBetween('created_at', [Carbon::now()->subYear(), Carbon::now()->subWeek()])
        ->get();

    foreach ($payments as $payment) {
        $session = StripeService::retrieveSession($payment->external_reference);

        if ($session->status === 'expired') {
            Payment::find($payment->id)
                ->update(['status' => PaymentStatus::Canceled]);
        }
    }
})->daily();
