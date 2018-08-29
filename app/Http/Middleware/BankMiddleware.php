<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class BankMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->is('banks')) {
            if (!Auth::user()->hasPermissionTo('Bank View')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('banks/create')) {
            if (!Auth::user()->hasPermissionTo('Bank Create')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('banks/*/edit')) {
            if (!Auth::user()->hasPermissionTo('Bank Edit')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete'))
        {
            if (!Auth::user()->hasPermissionTo('Bank Delete')) {
                abort('405');
            }
            else
            {
                return $next($request);
            }
        }
    }
}
