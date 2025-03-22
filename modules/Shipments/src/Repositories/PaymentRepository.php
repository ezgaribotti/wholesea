<?php

namespace Modules\Shipments\src\Repositories;

use App\Repositories\Repository;
use Modules\Common\src\Entities\Payment;
use Modules\Shipments\src\Interfaces\PaymentRepositoryInterface;

class PaymentRepository extends Repository implements PaymentRepositoryInterface
{
    public function __construct(Payment $payment)
    {
        parent::__construct($payment);
    }
}
