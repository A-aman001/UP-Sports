<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // ค่าเดิมของคุณ
    ];

    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    protected $routeMiddleware = [
        'auth'     => \App\Http\Middleware\Authenticate::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        // 👇 เพิ่มสองบรรทัดนี้ให้มีจริง และไม่มีซ้ำซ้อน
        'staff'    => \App\Http\Middleware\RequireStaff::class,
        'person'   => \App\Http\Middleware\RequirePerson::class,
    ];
}