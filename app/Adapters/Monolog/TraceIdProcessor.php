<?php

namespace App\Adapters\Monolog;

use App\Adapters\TraceId\TraceIdGenerator;
use Monolog\Processor\ProcessorInterface;

class TraceIdProcessor implements ProcessorInterface
{
    private string $traceId;
    private TraceIdGenerator $traceIdGenerator;

    public function __construct(TraceIdGenerator $traceIdGenerator)
    {
        $this->traceIdGenerator = $traceIdGenerator;
        $this->setTraceId();
    }

    public function __invoke(array $records): array
    {
        $records['traceId'] = $this->traceId;

        return $records;
    }

    public function setTraceId(?string $traceId = null): void
    {
        $traceId = $traceId ?? $this->traceIdGenerator->generate();
        $this->traceId = $traceId;
    }
}
