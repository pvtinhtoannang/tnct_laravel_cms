<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            //User role is admin
            $role = Auth::user()->roles[0]->name;
            if ($role === 'administrator' || $role === 'editor' || $role === 'author' || $role === 'contributor' || $role === 'shop_manager' || $role === 'seo_manager' || $role === 'seo_editor') {
                return $next($request);
            }

            if ($role === 'customer' || $role === 'subscriber') {
                return redirect('/');
            }
        }
        //default redirect
        return redirect('/');
    }
}
