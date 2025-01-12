<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('user.login'); // Redirect to login if not authenticated
        }

        $user = Auth::user();
        

        return $next($request);
    }
}
