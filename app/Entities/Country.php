<?php

namespace App\Entities;

use Database\Factories\CountryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends NoTimestamp
{
    use HasFactory;

    protected $fillable = [
        'name',
        'iso_code',
    ];

    protected static function newFactory(): object
    {
        return CountryFactory::new();
    }
}
