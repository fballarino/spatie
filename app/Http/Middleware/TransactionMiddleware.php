<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TransactionMiddleware
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
        if ($request->is('transactions')) {
            if (!Auth::user()->hasPermissionTo('Transaction View')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('transactions/create')) {
            if (!Auth::user()->hasPermissionTo('Transaction Create')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('transactions/*/edit')) {
            if (!Auth::user()->hasPermissionTo('Transaction Edit')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete'))
        {
            if (!Auth::user()->hasPermissionTo('Transaction Delete')) {
                abort('405');
            }
            else
            {
                return $next($request);
            }
        }


    }
}
