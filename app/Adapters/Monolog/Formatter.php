<?php

namespace App\Adapters\Monolog;

use Monolog\Formatter\JsonFormatter;

class Formatter
{
    public function __invoke($monolog)
    {
        $jsonFormatter = new JsonFormatter();
        foreach ($monolog->getHandlers() as $handler) {
            $handler->setFormatter($jsonFormatter);
        }

        $monolog->pushProcessor(function ($record) {
            $record['datetime'] = $record['datetime']->format('c');
            return $record;
        });
    }
}
