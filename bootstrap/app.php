<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Middleware\StaffMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\UserShopMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
            
            Route::middleware('web')
                ->group(base_path('routes/employee.php'));
            
            Route::prefix('api')
                ->group(base_path('routes/api.php'));
            
        },
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'employee' => StaffMiddleware::class,
            'admin' => AdminMiddleware::class,
        ]);
        
        $middleware->redirectGuestsTo(function (Request $request) {
            $previousUrl = url()->previous();
            
            if (str_contains($previousUrl, '/admin')) {
                return route('admin.login.form');
            }
            
            return route('employee.login.form');
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
