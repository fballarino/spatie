<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GoldtrackMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->is('goldtracks')) {
            if (!Auth::user()->hasPermissionTo('Goldtrack View')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('goldtracks/*')) {
            if (!Auth::user()->hasPermissionTo('Goldtrack Show')) {
                abort('401');
            } else {
                return $next($request);
            }
        }


        if ($request->is('goldtracks/create')) {
            if (!Auth::user()->hasPermissionTo('Goldtrack Create')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('goldtracks/*/edit')) {
            if (!Auth::user()->hasPermissionTo('Goldtrack Edit')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('goldtracks/verify')) {
            if (!Auth::user()->hasPermissionTo('Goldtrack Verify')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete'))
        {
            if (!Auth::user()->hasPermissionTo('Goldtrack Delete')) {
                abort('405');
            }
            else
            {
                return $next($request);
            }
        }
    }
}
