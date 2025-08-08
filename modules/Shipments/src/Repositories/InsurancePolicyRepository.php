<?php

namespace Modules\Shipments\src\Repositories;

use App\Repositories\Repository;
use Modules\Shipments\src\Entities\InsurancePolicy;
use Modules\Shipments\src\Interfaces\InsurancePolicyRepositoryInterface;

class InsurancePolicyRepository extends Repository implements InsurancePolicyRepositoryInterface
{
    public function __construct(InsurancePolicy $insurancePolicy)
    {
        parent::__construct($insurancePolicy);
    }
}
