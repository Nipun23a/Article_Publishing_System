<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->userRole && Auth::user()->userRole->role_name == 'admin' ) {
            return $next($request);
        }

        return redirect('home')->with('error', 'You do not have admin access.');
    }

}
