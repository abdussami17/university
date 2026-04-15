<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EnsureUnverifiedUser
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('temp_user_id')) {
            session()->forget(['temp_user_id', 'temp_email', 'temp_password']);
            return redirect()->route('account.login')->with('error', __('auth.unauthorized_access'));
        }

        $user = User::find(session('temp_user_id'));

        if (!$user || !is_null($user->email_verified_at)) {
            session()->forget(['temp_user_id', 'temp_email', 'temp_password']);
            return redirect()->route('account.login')->with('error', __('auth.unauthorized_access'));
        }

        return $next($request);
    }
}
