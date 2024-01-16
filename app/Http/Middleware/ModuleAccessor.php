<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ModuleAccessor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $module): Response
    {
        if ($request->user()->role_id == 1) {
            return $next($request);
        } else {
            $access = true;

            if ($request->user()->permissions->count() > 0) {
                foreach ($request->user()->permissions as $p) {
                    if ($p->slug == $module) {
                        return $next($request);
                    } else {
                        $access = false;
                    }
                }
            } else {
                $access = false;
            }

            if (!$access) {
                abort(403, 'Unauthorized Access');
            }
        }
        return $next($request);
    }
}
