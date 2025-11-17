<?php

namespace App\Http\Controllers;

use App\Services\TwoFactorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    protected TwoFactorService $twoFactorService;

    public function __construct(TwoFactorService $twoFactorService)
    {
        $this->twoFactorService = $twoFactorService;
        $this->middleware('auth');
    }

    /**
     * Show the 2FA verification form
     */
    public function show()
    {
        $user = Auth::user();

        // Check if locked out
        if ($this->twoFactorService->isLockedOut($user)) {
            $remainingTime = $this->twoFactorService->getRemainingLockoutTime($user);
            return view('auth.two-factor-locked', compact('remainingTime'));
        }

        // Generate and send code if not already sent or expired
        if (!$user->two_factor_email_code || $user->two_factor_email_code_expires_at < now()) {
            $this->twoFactorService->generateAndSendCode($user);
        }

        return view('auth.two-factor-challenge');
    }

    /**
     * Verify the 2FA code
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $user = Auth::user();

        // Check if locked out
        if ($this->twoFactorService->isLockedOut($user)) {
            $remainingTime = $this->twoFactorService->getRemainingLockoutTime($user);
            return back()->withErrors([
                'code' => __('Votre compte est temporairement verrouillé. Veuillez réessayer dans :minutes minutes.', [
                    'minutes' => $remainingTime
                ])
            ]);
        }

        // Verify code
        if ($this->twoFactorService->verifyCode($user, $request->code)) {
            // Mark as verified for this session
            $this->twoFactorService->markAsVerifiedForSession($user);

            // Redirect to intended page or dashboard
            $locale = session('locale', config('app.locale', 'fr'));

            if ($user->hasRole('Admin')) {
                return redirect()->intended('/admin');
            }

            return redirect()->intended(route('dashboard.index', ['locale' => $locale]));
        }

        // Failed verification
        return back()->withErrors([
            'code' => __('Le code est invalide ou a expiré. Veuillez réessayer.')
        ])->withInput();
    }

    /**
     * Resend the 2FA code
     */
    public function resend()
    {
        $user = Auth::user();

        // Check if locked out
        if ($this->twoFactorService->isLockedOut($user)) {
            return back()->withErrors([
                'code' => __('Votre compte est temporairement verrouillé.')
            ]);
        }

        // Generate and send new code
        if ($this->twoFactorService->generateAndSendCode($user)) {
            return back()->with('status', __('Un nouveau code a été envoyé à votre adresse email.'));
        }

        return back()->withErrors([
            'code' => __('Impossible d\'envoyer le code. Veuillez réessayer.')
        ]);
    }

    /**
     * Enable 2FA for current user
     */
    public function enable()
    {
        $user = Auth::user();

        if ($this->twoFactorService->enableTwoFactor($user)) {
            return back()->with('status', __('L\'authentification à deux facteurs a été activée avec succès.'));
        }

        return back()->withErrors([
            'two_factor' => __('Impossible d\'activer l\'authentification à deux facteurs.')
        ]);
    }

    /**
     * Disable 2FA for current user
     */
    public function disable(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password',
        ]);

        $user = Auth::user();

        if ($this->twoFactorService->disableTwoFactor($user)) {
            return back()->with('status', __('L\'authentification à deux facteurs a été désactivée.'));
        }

        return back()->withErrors([
            'two_factor' => __('Impossible de désactiver l\'authentification à deux facteurs.')
        ]);
    }
}
