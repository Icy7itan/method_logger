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
            $methodCall->whereBetween('created_at', [request()->get('date_from'),request()->get('date_end')]);
        }elseif (request()->has('date_from')){
            $methodCall->where('created_at', '>=',request()->get('date_from'));
        }elseif(request()->has('date_end')){
            $methodCall->where('created_at', '<=',request()->get('date_end'));
        }

        return $next($methodCall);
    }
}
