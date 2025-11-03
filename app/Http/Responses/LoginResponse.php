<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\JsonResponse;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // Get locale from session or fallback to app default
        $locale = session('locale', config('app.locale', 'fr'));

        // Check if user is admin or customer
        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            // Redirect admins to Filament admin panel
            return $request->wantsJson()
                ? new JsonResponse('', 204)
                : redirect()->intended('/admin');
        }

        // Redirect customers to their dashboard with locale
        return $request->wantsJson()
            ? new JsonResponse('', 204)
            : redirect()->route('dashboard.index', ['locale' => $locale]);
    }
}
