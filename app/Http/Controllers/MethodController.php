<?php

namespace App\Http\Controllers;

use App\Http\Requests\Method\IndexMethodRequest;
use App\Http\Requests\Method\StoreMethodRequest;
use App\Http\Requests\Method\UpdateMethodRequest;
use App\Http\Resources\MethodResource;
use App\Http\Resources\MethodStatisticResource;
use App\Models\Method;
use App\Services\MethodService;
use App\Services\ResponseService;
use Illuminate\Http\JsonResponse;

class MethodController extends Controller
{
    public function __construct(protected MethodService $methodService, protected ResponseService $responseService){}

    /**
     * Display a listing of the resource.
     */
    public function index(IndexMethodRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $methods = $this->methodService->index($validated);

        return $this->responseService->success(
            MethodResource::collection($methods)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMethodRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $method = $this->methodService->store($validated);

        return $this->responseService->created(
            new MethodResource($method)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMethodRequest $request, Method $method): JsonResponse
    {
        $validated = $request->validated();
        $this->methodService->update($validated, $method);

        return $this->responseService->created(
            new MethodResource($method)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Method $method): JsonResponse
    {
        return $this->responseService->success(
            new MethodResource($method)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->methodService->destroy($id);
        return $this->responseService->success(['message'=>'Method was deleted']);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function getMethodStatistic($method): JsonResponse
    {
        $statistic = $this->methodService->getStatistic($method);

        return $this->responseService->success(
            new MethodStatisticResource($statistic)
        );
    }
}
