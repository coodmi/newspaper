<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectWithoutPermission
{
    public function handle(Request $request, Closure $next, $permissions)
    {
        $permissionsArray = explode('|', $permissions);

        if (!Auth::user()->canany($permissionsArray)) {
            $userHaveAnyPermission = auth()->user()->roles->isNotEmpty() ? 1 : 0;

            if ($userHaveAnyPermission) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home');
            }
        }

        return $next($request);
    }

}