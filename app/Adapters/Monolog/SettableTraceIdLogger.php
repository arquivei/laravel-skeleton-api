<?php

declare(strict_types=1);

namespace App\Adapters\Monolog;

use Core\Dependencies\LogInterface;

interface SettableTraceIdLogger extends LogInterface
{
    public function setTraceId(?string $traceId = null): void;
}
