<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\TwoFactorCodeNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Facades\LogActivity;

class TwoFactorService
{
    /**
     * Maximum number of failed attempts before lockout
     */
    const MAX_ATTEMPTS = 5;

    /**
     * Lockout duration in minutes
     */
    const LOCKOUT_DURATION = 30;

    /**
     * Code expiration time in minutes
     */
    const CODE_EXPIRATION = 10;

    /**
     * Generate and send a new 2FA code
     */
    public function generateAndSendCode(User $user): bool
    {
        try {
            // Check if user is locked out
            if ($this->isLockedOut($user)) {
                return false;
            }

            // Generate a 6-digit code
            $code = $this->generateCode();

            // Update user with new code and expiration
            $user->update([
                'two_factor_email_code' => $code,
                'two_factor_email_code_expires_at' => Carbon::now()->addMinutes(self::CODE_EXPIRATION),
                'two_factor_verified_at' => null,
            ]);

            // Send notification
            $user->notify(new TwoFactorCodeNotification($code));

            // Log activity
            activity()
                ->performedOn($user)
                ->causedBy($user)
                ->withProperties([
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ])
                ->log('2FA code generated and sent');

            return true;
        } catch (\Exception $e) {
            Log::error('Error generating 2FA code', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Verify the 2FA code
     */
    public function verifyCode(User $user, string $code): bool
    {
        // Check if user is locked out
        if ($this->isLockedOut($user)) {
            return false;
        }

        // Check if code exists
        if (empty($user->two_factor_email_code)) {
            return false;
        }

        // Check if code is expired
        if ($user->two_factor_email_code_expires_at < Carbon::now()) {
            activity()
                ->performedOn($user)
                ->causedBy($user)
                ->withProperties([
                    'ip' => request()->ip(),
                    'reason' => 'Expired code',
                ])
                ->log('2FA verification failed - expired code');
            return false;
        }

        // Verify the code
        if ($user->two_factor_email_code === $code) {
            // Success - reset attempts and mark as verified
            $user->update([
                'two_factor_verified_at' => Carbon::now(),
                'failed_two_factor_attempts' => 0,
                'two_factor_locked_until' => null,
                'two_factor_email_code' => null,
                'two_factor_email_code_expires_at' => null,
            ]);

            activity()
                ->performedOn($user)
                ->causedBy($user)
                ->withProperties([
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ])
                ->log('2FA verification successful');

            return true;
        }

        // Failed attempt - increment counter
        $this->recordFailedAttempt($user);

        return false;
    }

    /**
     * Record a failed 2FA attempt
     */
    protected function recordFailedAttempt(User $user): void
    {
        $attempts = $user->failed_two_factor_attempts + 1;

        $updateData = [
            'failed_two_factor_attempts' => $attempts,
        ];

        // Lock account if max attempts reached
        if ($attempts >= self::MAX_ATTEMPTS) {
            $updateData['two_factor_locked_until'] = Carbon::now()->addMinutes(self::LOCKOUT_DURATION);

            activity()
                ->performedOn($user)
                ->causedBy($user)
                ->withProperties([
                    'ip' => request()->ip(),
                    'attempts' => $attempts,
                    'locked_until' => $updateData['two_factor_locked_until'],
                ])
                ->log('2FA account locked due to too many failed attempts');
        } else {
            activity()
                ->performedOn($user)
                ->causedBy($user)
                ->withProperties([
                    'ip' => request()->ip(),
                    'attempts' => $attempts,
                ])
                ->log('2FA verification failed - invalid code');
        }

        $user->update($updateData);
    }

    /**
     * Check if user is locked out
     */
    public function isLockedOut(User $user): bool
    {
        if (!$user->two_factor_locked_until) {
            return false;
        }

        // Check if lockout has expired
        if ($user->two_factor_locked_until < Carbon::now()) {
            // Reset lockout
            $user->update([
                'two_factor_locked_until' => null,
                'failed_two_factor_attempts' => 0,
            ]);
            return false;
        }

        return true;
    }

    /**
     * Get remaining lockout time in minutes
     */
    public function getRemainingLockoutTime(User $user): int
    {
        if (!$user->two_factor_locked_until) {
            return 0;
        }

        $diff = Carbon::now()->diffInMinutes($user->two_factor_locked_until, false);
        return max(0, (int) ceil($diff));
    }

    /**
     * Generate a 6-digit code
     */
    protected function generateCode(): string
    {
        return str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Check if user needs 2FA verification
     */
    public function needsVerification(User $user): bool
    {
        // 2FA not enabled
        if (!$user->two_factor_enabled) {
            return false;
        }

        // Already verified in this session
        if (session()->has('two_factor_verified_user_' . $user->id)) {
            return false;
        }

        // Verification needed
        return true;
    }

    /**
     * Mark 2FA as verified for this session
     */
    public function markAsVerifiedForSession(User $user): void
    {
        session()->put('two_factor_verified_user_' . $user->id, true);
        session()->put('two_factor_verified_at', Carbon::now()->toISOString());
    }

    /**
     * Enable 2FA for user
     */
    public function enableTwoFactor(User $user): bool
    {
        $user->update(['two_factor_enabled' => true]);

        activity()
            ->performedOn($user)
            ->causedBy($user)
            ->withProperties(['ip' => request()->ip()])
            ->log('2FA enabled');

        return true;
    }

    /**
     * Disable 2FA for user
     */
    public function disableTwoFactor(User $user): bool
    {
        $user->update([
            'two_factor_enabled' => false,
            'two_factor_email_code' => null,
            'two_factor_email_code_expires_at' => null,
            'two_factor_verified_at' => null,
            'failed_two_factor_attempts' => 0,
            'two_factor_locked_until' => null,
        ]);

        activity()
            ->performedOn($user)
            ->causedBy($user)
            ->withProperties(['ip' => request()->ip()])
            ->log('2FA disabled');

        return true;
    }
}
