<?php

namespace Modules\Auth\src\Entities;

use App\Entities\Entity;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as HasActingAs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Modules\Auth\database\Factories\OperatorFactory;

class Operator extends Entity implements Authenticatable
{
    use HasFactory, HasApiTokens, HasActingAs;

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

    protected $casts = [
        'password' => 'hashed'
    ];

    public function permissions(): object
    {
        return $this->belongsToMany(Permission::class);
    }

    protected static function newFactory(): object
    {
        return OperatorFactory::new();
    }
}
