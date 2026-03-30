<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // spatie permission middleware
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,

            'redirect.if.no.permission' => \App\Http\Middleware\RedirectWithoutPermission::class,
            
            'log_visitor' => \App\Http\Middleware\LogVisitor::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();



// use Illuminate\Foundation\Application;
// use Illuminate\Foundation\Configuration\Exceptions;
// use Illuminate\Foundation\Configuration\Middleware;
// use Illuminate\Routing\Router; // <-- এই লাইনটি যোগ করা ভালো

// return Application::configure(basePath: dirname(__DIR__))
//     ->withRouting(
//         // web: __DIR__.'/../routes/web.php', // <-- আমরা এই লাইনটি মুছে দিয়েছি
//         commands: __DIR__.'/../routes/console.php',
//         health: '/up',
        
//         // 'using' ব্যবহার করে আমরা কাস্টম রুট লোড করার নিয়ম যোগ করেছি
//         using: function (Router $router) {
            
//             // ফ্রন্টএন্ড রুটের জন্য নিয়ম
//             // এই রুটের উপর শুধুমাত্র সাধারণ 'web' middleware গ্রুপ প্রয়োগ হবে
//             $router->middleware('web')
//                   ->group(base_path('routes/frontend.php'));

//             // অ্যাডমিন রুটের জন্য নিয়ম
//             // Starkit-এর অন্য কোনো middleware লাগলে এখানে যোগ করুন, যেমন: 'auth'
//             $router->middleware(['web', 'auth']) 
//                 //   ->prefix('admin')
//                 //   ->name('admin.')
//                   ->group(base_path('routes/admin.php'));
//         }
//     )
//     ->withMiddleware(function (Middleware $middleware) {
//         // আপনার Middleware alias গুলো অপরিবর্তিত থাকবে
//         $middleware->alias([
//             'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
//             'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
//             'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
//             'redirect.if.no.permission' => \App\Http\Middleware\RedirectWithoutPermission::class,
//         ]);
//     })
//     ->withExceptions(function (Exceptions $exceptions) {
//         //
//     })->create();