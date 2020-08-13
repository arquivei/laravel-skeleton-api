<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Adapters\Monolog\SettableTraceIdLogger;
use Closure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLoggerTraceId
{
    private const X_TRACEID = 'x-traceid';

    private SettableTraceIdLogger $logger;

    public function __construct(SettableTraceIdLogger $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $traceId = $request->headers->get(self::X_TRACEID);
        $this->logger->setTraceId($traceId);
        return $next($request);
    }
}
