<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // --- 1. Konfigurasi CORS (FIXED L11 Pattern) ---
        // Menggunakan array konfigurasi untuk HandleCors di API group.
        $middleware->api(prepend: [
             HandleCors::class . ':' . json_encode([
                 // Mengizinkan Next.js Origin
                 'allowed_origins' => [
                     'http://localhost:3000',
                     'http://127.0.0.1:3000',
                 ],
                 'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                 'allowed_headers' => ['Content-Type', 'Authorization', 'X-Requested-With'],
                 'max_age' => 0,
                 'supports_credentials' => true, // PENTING untuk Sanctum
             ]),
        ]);

        // --- 2. Alias Middleware (Role Middleware) ---
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);

        // --- 3. Pengecualian CSRF ---
        $middleware->validateCsrfTokens(except: [
            'api/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
