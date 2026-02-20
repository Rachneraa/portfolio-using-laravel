<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsDebugMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $origin = $request->header('Origin');
        $allowedOrigins = [
            'https://portfoliotasya.riachoune.my.id',
            'https://riachoune.my.id',
            'http://localhost:3000',
            'http://127.0.0.1:5173',
        ];

        $response = $next($request);

        if (in_array($origin, $allowedOrigins) || $request->isMethod('options')) {
            $response->header('Access-Control-Allow-Origin', $origin ?? '*');
            $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS, HEAD');
            $response->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
            $response->header('Access-Control-Expose-Headers', 'Content-Length, Content-Range');
            $response->header('Access-Control-Allow-Credentials', 'true');
        }

        return $response;
    }
}
