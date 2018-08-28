<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CharacterMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->hasPermissionTo('Administer Roles & Permissions')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('characters')) {
            if (!Auth::user()->hasPermissionTo('Character View')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('characters/create')) {
            if (!Auth::user()->hasPermissionTo('Character Create')) {
                abort('402');
            } else {
                return $next($request);
            }
        }

        if ($request->is('characters/*/edit')) {
            if (!Auth::user()->hasPermissionTo('Character Edit')) {
                abort('403');
            } else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete')) //If user is deleting a post
        {
            if (!Auth::user()->hasPermissionTo('Character Delete')) {
                abort('403');
            }
            else
            {
                return $next($request);
            }
        }
    }

}