<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Illuminate\Http\JsonResponse;

class RegisterResponse implements RegisterResponseContract
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

        // After registration, redirect to dashboard with locale
        return $request->wantsJson()
            ? new JsonResponse('', 201)
            : redirect()->route('dashboard.index', ['locale' => $locale]);
    }
}
