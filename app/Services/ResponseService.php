<?php

namespace App\Services;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\JsonResponse;

class ResponseService
{

    private static function responseParams($status, $errors = [], $data = [])
    {
        return [
            'success' => $status,
            'errors' => (object)$errors,
            'data' => (object)$data,
        ];
    }

    public static function sendJsonResponse($success, $code = 200, $errors = [], $data = []): JsonResponse
    {
        return response()->json(
            self::responseParams($success, $errors, $data),
            $code
        );
    }

    public static function success($data = []): JsonResponse
    {
        return self::sendJsonResponse(true, 200, [], $data);
    }

    public static function noContent($data = []): JsonResponse
    {
        return self::sendJsonResponse(true, 204, [], $data);
    }

    public static function created($data = []): JsonResponse
    {
        return self::sendJsonResponse(true, 201, [], $data);
    }

    public static function badRequest($data = []): JsonResponse
    {
        return self::sendJsonResponse(false, 400, [], []);
    }

    public static function notFound($data = []): JsonResponse
    {
        return self::sendJsonResponse(false, 404, [], $data);
    }
}
