<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectAuthenticatedUsers
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
    
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
    
                if ($user->role == 'admin') {
                    return redirect('/admin/dashboard');
                } elseif (empty($user->student_card)) {
                    return redirect()->route('student.upload.card');
                } elseif (is_null($user->email_verified_at)) {
                    return redirect()->route('auth.verify');
                }
    
                return redirect('/account/dashboard');
            }
        }
    
        return $next($request);
    }
}
