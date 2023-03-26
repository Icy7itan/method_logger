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
     * @param IndexMethodRequest $request
     * @return JsonResponse
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
     * @param StoreMethodRequest $request
     * @return JsonResponse
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
     * @param UpdateMethodRequest $request
     * @param Method $method
     * @return JsonResponse
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
     * @param Method $method
     * @return JsonResponse
     */
    public function show(Method $method): JsonResponse
    {
        return $this->responseService->success(
            new MethodResource($method)
        );
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws \App\Exceptions\MethodDeleteException
     */
    public function destroy($id)
    {
        $this->methodService->destroy($id);
        return $this->responseService->success(['message'=>'Method was deleted']);
    }


    /**
     * @param $method
     * @return JsonResponse
     */
    public function getMethodStatistic($method): JsonResponse
    {
        $statistic = $this->methodService->getStatistic($method);

        return $this->responseService->success(
            new MethodStatisticResource($statistic)
        );
    }
}
