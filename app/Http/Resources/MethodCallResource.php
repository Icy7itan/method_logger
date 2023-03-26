<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MethodCallResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'method_id' => $this->method_id,
            'lead_time_seconds' => $this->lead_time_seconds,
            'memory_usage_bit' => $this->memory_usage_bit,
        ];
    }
}
