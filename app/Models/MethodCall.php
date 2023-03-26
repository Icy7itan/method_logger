<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class MethodCall extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'method_id',
        'lead_time_seconds',
        'memory_usage_bit',
    ];

    public function method(): hasOne
    {
        return $this->hasOne(Method::class, 'id', 'method_id');
    }
}
