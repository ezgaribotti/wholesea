<?php

namespace App\Entities;

use Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Entity
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'status',
        'identity_document_type_id',
        'identity_document',
        'email',
        'phone',
    ];

    protected static function newFactory(): object
    {
        return CustomerFactory::new();
    }
}
