<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasAdminRights
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->admin==1) {
            return $next($request);
        } else if (Auth::user() && Auth::user()->is_admin==0) {
            return redirect('posts.all');
        } else {
            return redirect('login');
        }
    }
}

