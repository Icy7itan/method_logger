<?php

namespace App\Services;


use App\Models\MethodCall;

class MethodCallService
{
    /**
     * @param $validated
     * @return mixed
     */
    public function store($validated)
    {
        return MethodCall::create($validated);
    }
}
