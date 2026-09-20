<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ThrottleRequestsException $e, Request $request) {
            if ($request->is('kirim-pesan')) {
                return redirect()->back()->with('error', 'Terlalu banyak pengiriman pesan. Silakan coba lagi beberapa saat lagi.');
            }

            if ($request->is('client/register')) {
                return redirect()->back()->with('error', 'Terlalu banyak pendaftaran. Silakan coba lagi beberapa saat lagi.');
            }
        });
    })->create();
