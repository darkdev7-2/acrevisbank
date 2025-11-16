<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SessionTimeout
{
    /**
     * Session timeout in minutes (configurable)
     */
    protected int $timeout;

    public function __construct()
    {
        // Timeout en minutes (15 minutes par défaut pour une banque)
        $this->timeout = config('session.lifetime', 15);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $lastActivity = Session::get('last_activity_time');
            $currentTime = now()->timestamp;

            // Si c'est la première activité de cette session
            if (!$lastActivity) {
                Session::put('last_activity_time', $currentTime);
                Session::put('session_started_at', $currentTime);
                return $next($request);
            }

            // Calculer le temps d'inactivité en minutes
            $inactiveMinutes = ($currentTime - $lastActivity) / 60;

            // Si l'utilisateur a été inactif trop longtemps
            if ($inactiveMinutes > $this->timeout) {
                $this->logSessionTimeout();

                Auth::logout();
                Session::flush();
                Session::regenerate();

                return redirect()->route('login', ['locale' => app()->getLocale()])
                    ->with('status', __('Votre session a expiré en raison d\'une inactivité. Veuillez vous reconnecter.'))
                    ->with('session_expired', true);
            }

            // Mettre à jour le dernier moment d'activité
            Session::put('last_activity_time', $currentTime);

            // Ajouter un header pour informer le client du temps restant
            $response = $next($request);
            $response->headers->set('X-Session-Timeout', $this->timeout * 60);
            $response->headers->set('X-Session-Remaining', ($this->timeout * 60) - ($inactiveMinutes * 60));

            return $response;
        }

        return $next($request);
    }

    /**
     * Log session timeout
     */
    protected function logSessionTimeout(): void
    {
        $user = Auth::user();

        if ($user) {
            activity()
                ->performedOn($user)
                ->causedBy($user)
                ->withProperties([
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'reason' => 'Session timeout due to inactivity',
                    'inactive_minutes' => $this->timeout,
                ])
                ->log('Session expired due to inactivity');
        }
    }
}
