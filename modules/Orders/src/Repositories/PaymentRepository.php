<?php

namespace Modules\Orders\src\Repositories;

use App\Repositories\Repository;
use Modules\Orders\src\Entities\Payment;
use Modules\Orders\src\Interfaces\PaymentRepositoryInterface;

class PaymentRepository extends Repository implements PaymentRepositoryInterface
{
    public function __construct(Payment $payment)
    {
        parent::__construct($payment);
    }
}
