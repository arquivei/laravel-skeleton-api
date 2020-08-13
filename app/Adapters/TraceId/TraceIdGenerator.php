<?php

declare(strict_types=1);

namespace App\Adapters\TraceId;

use Ramsey\Uuid\Uuid;

class TraceIdGenerator
{
    public function generate(): string
    {
        return str_replace('-', '', Uuid::uuid4());
    }
}
