<?php

namespace App\Http\Middleware;

use App\Adapters\TraceId\TraceIdGenerator;
use Closure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HeadersMiddleware
{
    public const X_TRACEID = 'x-traceid';
    private TraceIdGenerator $traceIdGenerator;

    public function __construct(TraceIdGenerator $traceIdGenerator)
    {
        $this->traceIdGenerator = $traceIdGenerator;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $traceId = $request->headers->get(self::X_TRACEID);

        if (is_null($traceId)) {
            $traceId = $this->traceIdGenerator->generate();
            $request->headers->set(self::X_TRACEID, $traceId);
        }

        $response = $next($request);
        $response->headers->set(self::X_TRACEID, $traceId);

        return $response;
    }
}
