<?php

namespace App\Entities;

use Database\Factories\OperatorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Operator extends Entity
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'full_name',
        'internal_code',
        'status',
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
