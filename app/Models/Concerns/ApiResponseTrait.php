<?php
namespace App\Models\Concerns;
use Illuminate\Http\JsonResponse;
trait ApiResponseTrait {
    protected function successResponse($data, $message = null, $code = 200): JsonResponse {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function errorResponse($message, $code): JsonResponse {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => null
        ], $code);
    }

    protected function paginatedResponse($data, $message = null, $code = 200): JsonResponse {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data->items(),
            'pagination' => [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'from' => $data->firstItem(),
                'to' => $data->lastItem()
            ]
        ], $code);
    }

    protected function exceptionResponse(\Throwable $e, $message = 'Something went wrong!'): JsonResponse {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'error' => env('APP_DEBUG') ? $e->getMessage() : 'Internal Server Error',
        ], 500);
    }
}