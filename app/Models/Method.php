<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Method extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'route',
        'method',
    ];

    public function methodCalls(): hasMany
    {
        return $this->hasMany(MethodCall::class, 'method_id', 'id');
    }
}
