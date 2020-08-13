<?php

namespace App\Http\Controllers;

use App\Events\Modules\Test\TestEvent;
use Core\Modules\Test\Entities\Test;
use Illuminate\Http\JsonResponse;

class TestController extends BaseController
{
    public function index(): JsonResponse
    {
        /** Kafka event sending test */
        /*
        $this->eventSender->push(
            new TestEvent(
                new Test(1, 'something')
            )
        );
        */

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
}
