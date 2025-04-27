<?php

namespace Modules\Auth\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Auth\database\Factories\LinkFactory;
use Modules\Common\src\Entities\Scopes\ActiveScope;

class Link extends Entity
{
    use HasFactory;

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope());
    }

    protected static function newFactory(): object
    {
        return LinkFactory::new();
    }
}
