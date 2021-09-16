<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if (Auth::check()) {
            $current_user = Auth::user()->role->pluck('name')->first();
            if ($current_user == 'Admin') {
                return $next($request);
            } else {
                return redirect('/');
            }
        } else {
            return route('login');
        }
    }
}
