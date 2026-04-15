<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RedirectIfSessionForgotten
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('temp_user_id')) {
            return redirect()->route('login.account');
        }

        return $next($request);
    }
}
