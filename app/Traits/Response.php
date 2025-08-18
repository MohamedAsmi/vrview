<?php

// app/Traits/ApiResponse.php
namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

trait Response
{
   
    private function coreResponse(
        bool $success,
        string $message,
        mixed $data = null,
        mixed $errors = null,
        int $statusCode
    ): JsonResponse {
        
        if ($data instanceof ResourceCollection) {
            $data = $data->response()->getData(true);
        } elseif ($data instanceof JsonResource) {
            $data = $data->response()->getData();
        }

        $response = [
            'success' => $success,
            'message' => $message,
            'data' => $data,
            'errors' => $errors,
            'status' => $statusCode,
            'timestamp' => now()->toDateTimeString(),
        ];

        return response()->json($response, $statusCode);
    }

    protected function sendResponse(
        string $message,
        mixed $data = null,
        int $statusCode = 200
    ): JsonResponse {
        return $this->coreResponse(true, $message, $data, null, $statusCode);
    }

    
    protected function sendError(
        string $message,
        mixed $errors = null,
        int $statusCode = 400
    ): JsonResponse {
        return $this->coreResponse(false, $message, null, $errors, $statusCode);
    }

  

    public function successResponse(
        string $message = 'Resource created successfully',
        mixed $data = null
    ): JsonResponse {
        return $this->sendResponse($message, $data, 201);
    }

    public function respondNoContent(string $message = 'No content'): JsonResponse
    {
        return $this->sendResponse($message, null, 204);
    }

    
    public function respondBadRequest(
        string $message = 'Bad request',
        mixed $errors = null
    ): JsonResponse {
        return $this->sendError($message, $errors, 400);
    }

    public function respondUnauthorized(
        string $message = 'Unauthorized',
        mixed $errors = null
    ): JsonResponse {
        return $this->sendError($message, $errors, 401);
    }

    public function respondForbidden(
        string $message = 'Forbidden',
        mixed $errors = null
    ): JsonResponse {
        return $this->sendError($message, $errors, 403);
    }

    public function respondNotFound(
        string $message = 'Resource not found',
        mixed $errors = null
    ): JsonResponse {
        return $this->sendError($message, $errors, 404);
    }

    public function respondMethodNotAllowed(
        string $message = 'Method not allowed',
        mixed $errors = null
    ): JsonResponse {
        return $this->sendError($message, $errors, 405);
    }

    public function respondNotAcceptable(
        string $message = 'Not acceptable',
        mixed $errors = null
    ): JsonResponse {
        return $this->sendError($message, $errors, 406);
    }

    public function respondConflict(
        string $message = 'Conflict',
        mixed $errors = null
    ): JsonResponse {
        return $this->sendError($message, $errors, 409);
    }

    public function respondUnprocessableEntity(
        string $message = 'Validation failed',
        mixed $errors = null
    ): JsonResponse {
        return $this->sendError($message, $errors, 422);
    }

    public function respondTooManyRequests(
        string $message = 'Too many requests',
        mixed $errors = null
    ): JsonResponse {
        return $this->sendError($message, $errors, 429);
    }

    public function respondInternalError(
        string $message = 'Internal server error',
        mixed $errors = null
    ): JsonResponse {
        return $this->sendError($message, $errors, 500);
    }

    public function respondNotImplemented(
        string $message = 'Not implemented',
        mixed $errors = null
    ): JsonResponse {
        return $this->sendError($message, $errors, 501);
    }

    public function respondServiceUnavailable(
        string $message = 'Service unavailable',
        mixed $errors = null
    ): JsonResponse {
        return $this->sendError($message, $errors, 503);
    }

    
}