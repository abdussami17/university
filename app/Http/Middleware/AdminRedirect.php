<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('web')->check()){
            $user = Auth::user();

                            if ($user->role == 'admin') {
                                return redirect('/admin/dashboard');
                            } elseif (empty($user->student_card)) {
                                return redirect()->route('student.upload.card');
                            } elseif (is_null($user->email_verified_at)) {
                                return redirect()->route('auth.verify');
                            }
            
                            return redirect('/account/dashboard');
        }
        return $next($request);
    }
}
