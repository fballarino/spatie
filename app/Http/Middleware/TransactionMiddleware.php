<?php

namespace App\Http\Middleware;

use Closure;

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

        if ($request->is('banks/create')) {
            if (!Auth::user()->hasPermissionTo('Transaction Create')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('banks/*/edit')) {
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
