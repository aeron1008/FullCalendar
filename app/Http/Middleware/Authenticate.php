<?php

namespace App\Http\Middleware;

use App\Models\Plan;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string[] ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        if (!appUser()->isAdmin) {
            if ( (!in_array($request->getRequestUri(), ['/admin/plans', '/admin/plans/pretplata', '/admin/subscription'])) && !appUser()->subscribedToprice(config('services.stripe.price'))) {
                return redirect()->route('admin.plans');
            }
        }

        return $next($request);
    }


    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}
