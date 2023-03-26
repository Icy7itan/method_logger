<?php

namespace App\Services;
use App\Models\Method;
use App\Models\MethodCall;
use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\ArrayShape;
use App\Exceptions\MethodDeleteException;
use Illuminate\Pipeline\Pipeline;
use App\Filters\MethodCall\MethodCallDateFilter;

class MethodService
{
    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return Method::all();
    }

    /**
     * @param $validated
     * @return Method
     */
    public function store($validated): Method
    {
        return Method::create($validated);
    }

    /**
     * @param $validated
     * @param $method
     * @return void
     */
    public function update($validated, &$method)
    {
        $method->update($validated);
    }

    /**
     * @param $id
     * @return bool
     * @throws MethodDeleteException
     */
    public function destroy($id): bool
    {
        $method = Method::withTrashed()->find($id);

        if(!$method){
            return throw new MethodDeleteException();
        }

        if ($method->trashed()) {
            return $method->forceDelete();
        }else{
            return $method->delete();
        }
    }

    /**
     * @param $id
     * @return array
     */
    #[ArrayShape([
        'seconds' => 0,
        'memory' => 0,
        'calls_count' => 0
    ])]
    public function getStatistic($id): array
    {
        $methodCallsQuery = MethodCall::query()->where('method_id', $id);

        $methodCall = app(Pipeline::class)
                ->send($methodCallsQuery)
                ->through([
                    MethodCallDateFilter::class,
                ])
                ->via('apply')
                ->then(function ($methodCall) {
                    return $methodCall->get();
                });

        return [
            'seconds' => $methodCall->sum('lead_time_seconds'),
            'memory' => $methodCall->sum('memory_usage_bit'),
            'calls_count' => $methodCall->count(),
        ];
    }
}
