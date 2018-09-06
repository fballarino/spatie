<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TeamMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->is('teams')) {
            if (!Auth::user()->hasPermissionTo('Team View')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('teams/*')) {
            if (!Auth::user()->hasPermissionTo('Team View')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('teams/create')) {
            if (!Auth::user()->hasPermissionTo('Team Create')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('teams/*/edit')) {
            if (!Auth::user()->hasPermissionTo('Team Edit')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete')) //If user is deleting a team
        {
            if (!Auth::user()->hasPermissionTo('Team Delete')) {
                abort('404');
            }
            else
            {
                return $next($request);
            }
        }

        if ($request->isMethod('Patch')) //If user is updating a team
        {
            if (!Auth::user()->hasPermissionTo('Team Delete')) {
                abort('404');
            }
            else
            {
                return $next($request);
            }
        }
    }

}