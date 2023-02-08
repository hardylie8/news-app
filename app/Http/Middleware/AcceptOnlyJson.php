<?php

namespace App\Http\Middleware;

use Closure;

class AcceptOnlyJson
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->expectsJson()) {
            return response()->json([
                'status' => 405,
                'message' => 'Backend accept only json communication.',
                'results' => []
            ]);
        }

        return $next($request);
    }
}
