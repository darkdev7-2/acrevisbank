<?php

namespace App\Http\Middleware;

use App\Services\TwoFactorService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorAuthenticated
{
    protected TwoFactorService $twoFactorService;

    public function __construct(TwoFactorService $twoFactorService)
    {
        $this->twoFactorService = $twoFactorService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // User not authenticated
        if (!$user) {
            return redirect()->route('login');
        }

        // 2FA not enabled for this user
        if (!$user->two_factor_enabled) {
            return $next($request);
        }

        // Already verified in this session
        if (!$this->twoFactorService->needsVerification($user)) {
            return $next($request);
        }

        // Redirect to 2FA verification page
        if (!$request->routeIs('two-factor.*')) {
            return redirect()->route('two-factor.show');
        }

        return $next($request);
    }
}
