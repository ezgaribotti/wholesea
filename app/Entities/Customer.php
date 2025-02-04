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

    public function identityDocumentType(): object
    {
        return $this->belongsTo(IdentityDocumentType::class);
    }

    public function addresses(): object
    {
        return $this->hasMany(CustomerAddress::class);
    }

    protected static function newFactory(): object
    {
        return CustomerFactory::new();
    }
}
