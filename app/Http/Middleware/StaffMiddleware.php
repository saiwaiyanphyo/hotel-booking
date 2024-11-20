<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

class StaffMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {

        if (auth()->guard('employee')->check()) {
            if ($request->hasSession() && !auth('employee')->check()) {
                throw new UnauthorizedException();
            }

            if (! $request->hasSession()) {
                auth()->guard('employee')->login(auth()->user());
            }
        }
        throw new UnauthorizedException();
    }

    protected function revokeToken()
    {
        auth()->guard('user')->logout();
    }
}
