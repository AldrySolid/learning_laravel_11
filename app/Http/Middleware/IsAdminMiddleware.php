<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->is_admin) {
            return response(
                [
                    'message' => 'Forbidden'
                ], \Illuminate\Http\Response::HTTP_FORBIDDEN
            );
        }

        return $next($request);
    }
}
