<?php

namespace App\Http\Middleware;

use Closure;

class AdminAccessMiddleware
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
        if (\Auth::check()) {
            $user_type = \Auth::user()->types->user_type_name;
            if (
                $user_type === "Administrator" || 
                $user_type === "Staff" ||
                $user_type === "Web Master"
                ) {
                return $next($request);
            } else {
                return back();
            }
        }
        return redirect()->route('auth.login');
    }
}
