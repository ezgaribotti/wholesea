<?php

namespace Modules\Shipments\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shipments\database\Factories\InsurancePolicyFactory;

class InsurancePolicy extends Entity
{
    use HasFactory;

    protected $fillable = [
        'name',
        'coverage_rate',
        'premium_factor',
        'description',
    ];

    protected static function newFactory(): object
    {
        return InsurancePolicyFactory::new();
    }
}
