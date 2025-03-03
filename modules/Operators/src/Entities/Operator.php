<?php

namespace Modules\Operators\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Modules\Operators\database\Factories\OperatorFactory;

class Operator extends Entity
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'full_name',
        'status',
        'internal_code',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected static function newFactory(): object
    {
        return OperatorFactory::new();
    }
}
