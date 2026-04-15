<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except:[
            'account/gemini/generate',
            'account/career/generate-resume',
            'account/financial/analyze',
            'account/discussion/topic/delete/*',
            'account/upload-student-card'
        ]);
    
        $middleware->alias([
            'admin.guest' => \App\Http\Middleware\AdminRedirect::class,
            'admin.auth' => \App\Http\Middleware\AdminAuthenticate::class,
            'verified' => \App\Http\Middleware\EnsureEmailVerified::class,
            'unverified' => \App\Http\Middleware\EnsureUnverifiedUser::class,
            'user.auth' => \App\Http\Middleware\AdminRedirect::class,
            'custom.auth' => \App\Http\Middleware\RedirectAuthenticatedUsers::class,
            'redirect.if.session.forgotten' => \App\Http\Middleware\RedirectIfSessionForgotten::class,

        ]);
    
        $middleware->redirectTo(
            guests: '/account/login',
            users: '/account/dashboard',
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
