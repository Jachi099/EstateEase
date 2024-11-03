<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        if (!$user || !in_array($user->account_type, $roles)) {
            return redirect()->route('public.home')->with('error', 'You do not have access to this resource.');
        }

        return $next($request);
    }
}

