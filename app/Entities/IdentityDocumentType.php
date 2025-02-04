<?php

namespace App\Entities;

use Database\Factories\IdentityDocumentTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IdentityDocumentType extends NoTimestamp
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_id',
    ];

    protected static function newFactory(): object
    {
        return IdentityDocumentTypeFactory::new();
    }
}
