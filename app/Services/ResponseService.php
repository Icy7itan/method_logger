<?php

namespace App\Services;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\JsonResponse;

class ResponseService
{
    /**
     * @param $status
     * @param $errors
     * @param $data
     * @return array
     */
    private static function responseParams($status, $errors = [], $data = [])
    {
        return [
            'success' => $status,
            'errors' => (object)$errors,
            'data' => (object)$data,
        ];
    }

    /**
     * @param $success
     * @param $code
     * @param $errors
     * @param $data
     * @return JsonResponse
     */
    public static function sendJsonResponse($success, $code = 200, $errors = [], $data = []): JsonResponse
    {
        return response()->json(
            self::responseParams($success, $errors, $data),
            $code
        );
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public static function success($data = []): JsonResponse
    {
        return self::sendJsonResponse(true, 200, [], $data);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public static function noContent($data = []): JsonResponse
    {
        return self::sendJsonResponse(true, 204, [], $data);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public static function created($data = []): JsonResponse
    {
        return self::sendJsonResponse(true, 201, [], $data);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public static function badRequest($data = []): JsonResponse
    {
        return self::sendJsonResponse(false, 400, [], []);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public static function notFound($data = []): JsonResponse
    {
        return self::sendJsonResponse(false, 404, [], $data);
    }
}
