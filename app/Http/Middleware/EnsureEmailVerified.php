<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EnsureEmailVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->email_verified_at ==1) {
            return $next($request);
        }
        Auth::logout();
        throw new NotFoundHttpException();
    }
}
