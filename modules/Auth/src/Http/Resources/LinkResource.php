<?php

namespace Modules\Auth\src\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'route_name' => $this->route_name,
            'icon' => $this->icon,
        ];
    }
}
