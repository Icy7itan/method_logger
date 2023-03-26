<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MethodResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'method' => $this->method,
            'route' => $this->route,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'methodCalls' => MethodCallResource::collection($this->methodCalls),
        ];
    }
}
