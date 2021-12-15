<?php

namespace App\Http\Middleware;

use Arquivei\LogAdapter\OpenCensusHelper;
use Closure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HeadersMiddleware
{
    public const X_TRACEID = 'x-traceid';

    public function handle(Request $request, Closure $next): Response
    {
        $traceId = $request->headers->get(self::X_TRACEID);

        if (is_null($traceId)) {
            $traceId = OpenCensusHelper::traceId();
            $request->headers->set(self::X_TRACEID, $traceId);
        }

        $response = $next($request);
        $response->headers->set(self::X_TRACEID, $traceId);

        return $response;
    }
}
