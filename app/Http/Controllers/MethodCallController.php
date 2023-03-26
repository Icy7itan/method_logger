<?php

namespace App\Http\Controllers;

use App\Services\MethodCallService;
use App\Http\Requests\MethodCall\StoreMethodCallRequest;
use App\Http\Resources\MethodCallResource;
use App\Services\MethodService;
use App\Services\ResponseService;
use \Illuminate\Http\JsonResponse;

class MethodCallController extends Controller
{
    public function __construct(
        protected MethodCallService $methodCallService,
        protected ResponseService $responseService
    ){}

    /**
     * @param StoreMethodCallRequest $request
     * @return JsonResponse
     */
    public function store(StoreMethodCallRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $methodCall = $this->methodCallService->store($validated);

        return $this->responseService->success(
            new MethodCallResource($methodCall)
        );
    }

}
