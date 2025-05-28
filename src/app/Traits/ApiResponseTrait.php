<?php

namespace App\Traits;

trait ApiResponseTrait
{
    protected function getMessageByStatusCode(int $code): string
    {
        $messages = [
            200 => 'OK',
            201 => 'Created',
            204 => 'No Content',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found',
            422 => 'Unprocessable Entity',
            500 => 'Internal Server Error',
        ];

        return $messages[$code] ?? 'Unknown Status';
    }

    protected function apiResponse($data = null, int $code = 200): \Illuminate\Http\JsonResponse
    {
        $response = ['message' => $this->getMessageByStatusCode($code)];

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }
}
