<?php

namespace App\Listeners;

use App\Models\User;
use App\Services\SuspiciousActivityDetectionService;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Cache;

class AuthenticationEventSubscriber
{
    protected SuspiciousActivityDetectionService $detectionService;

    public function __construct(SuspiciousActivityDetectionService $detectionService)
    {
        $this->detectionService = $detectionService;
    }

    /**
     * Handle user login events.
     */
    public function handleLogin(Login $event): void
    {
        $user = $event->user;

        if (!$user instanceof User) {
            return;
        }

        // Check for IP change
        $this->detectionService->checkIpChange($user);

        // Check for unusual login time
        $this->detectionService->checkUnusualTime($user);

        // Clear failed login attempts on successful login
        Cache::forget("login_attempts_{$user->email}");
    }

    /**
     * Handle failed login attempts.
     */
    public function handleFailed(Failed $event): void
    {
        $user = $event->user;

        if (!$user instanceof User) {
            // Try to find user by email from credentials
            $credentials = $event->credentials;
            if (isset($credentials['email'])) {
                $user = User::where('email', $credentials['email'])->first();
            }
        }

        if ($user) {
            // Track failed attempts
            $cacheKey = "login_attempts_{$user->email}";
            $attempts = Cache::get($cacheKey, 0) + 1;
            Cache::put($cacheKey, $attempts, now()->addMinutes(15));

            // Check for multiple login failures
            $this->detectionService->checkMultipleLoginAttempts($user);

            // Log the failed attempt
            activity()
                ->performedOn($user)
                ->withProperties([
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'attempts' => $attempts,
                ])
                ->log('Failed login attempt');
        }
    }

    /**
     * Handle user lockout events.
     */
    public function handleLockout(Lockout $event): void
    {
        $request = $event->request;
        $email = $request->input('email');

        if ($email) {
            $user = User::where('email', $email)->first();

            if ($user) {
                // Detect as brute force attempt
                $this->detectionService->detect(
                    $user,
                    'brute_force',
                    [
                        'locked_at' => now()->toDateTimeString(),
                        'attempts' => Cache::get("login_attempts_{$user->email}", 0),
                    ],
                    'critical'
                );

                activity()
                    ->performedOn($user)
                    ->withProperties([
                        'ip' => request()->ip(),
                        'user_agent' => request()->userAgent(),
                    ])
                    ->log('Account locked due to too many failed login attempts');
            }
        }
    }

    /**
     * Register the listeners for the subscriber.
     */
    public function subscribe(Dispatcher $events): array
    {
        return [
            Login::class => 'handleLogin',
            Failed::class => 'handleFailed',
            Lockout::class => 'handleLockout',
        ];
    }
}
