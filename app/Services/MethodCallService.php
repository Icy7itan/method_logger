<?php

namespace App\Services;


use App\Models\MethodCall;

class MethodCallService
{
    public function store($validated)
    {
        return MethodCall::create($validated);
    }
}
