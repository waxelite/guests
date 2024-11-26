<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DebugHeadersMiddleware
{
    /**
     * Замеры данных.
     *
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|Response
     */
    public function handle(Request $request, Closure $next): JsonResponse|Response
    {
        $startTime = microtime(true);
        $startMemory = memory_get_usage();

        $response = $next($request);

        $endTime = microtime(true);
        $endMemory = memory_get_usage();

        $executionTime = round(($endTime - $startTime) * 1000, 2);
        $memoryUsage = round(($endMemory - $startMemory) / 1024, 2);

        $response->headers->set('X-Debug-Time', $executionTime . ' ms');
        $response->headers->set('X-Debug-Memory', $memoryUsage . ' KB');

        return $response;
    }
}

