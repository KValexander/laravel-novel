<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SessionMiddleware
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
        if(Auth::check()) {
            $user = Auth::user();
            if($user->access == "Редактор" || $user->access == "Модератор" || $user->access == "Администратор" ) {
                return $next($request);
            } else {
                return redirect()->route("message");
            }
        } else {
            return redirect()->route("message");
        }
    }
}
