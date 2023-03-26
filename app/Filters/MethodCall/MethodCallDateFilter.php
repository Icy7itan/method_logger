<?php

namespace App\Filters\MethodCall;

use App\Filters\Pipe;
use Closure;

class MethodCallDateFilter implements Pipe
{
    /**
     * @param $methodCall
     * @param Closure $next
     * @return mixed
     */
    public function apply($methodCall, Closure $next)
    {
        if (request()->has('date_from') && request()->has('date_end')) {
            $methodCall->whereBetween('created_at', [request()->has('date_from'),request()->has('date_end')]);
        }

        return $next($methodCall);
    }
}
