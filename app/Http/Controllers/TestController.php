<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class TestController extends BaseController
{
    public function index(): JsonResponse
    {
        $this->logger->info('Logging from test controller');

        return new JsonResponse(
            [
                'data' => [],
                'status' => [
                    'code' => 200,
                    'message' => sprintf('%s - Everything it is OK', env('APP_IDENTIFIER'))
                ],
            ],
            200
        );
    }

    public function logs(): JsonResponse
    {
        $this->logger->info('Starting Logging');

        return new JsonResponse(
            [
                'data' => [],
                'status' => [
                    'code' => 200,
                    'message' => sprintf('%s - Everything it is OK', env('APP_IDENTIFIER'))
                ],
            ],
            200
        );
    }
}
