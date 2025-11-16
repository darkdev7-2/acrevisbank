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

    /**
     * Absolute session timeout in minutes (8 hours = 480 minutes)
     */
    protected int $absoluteTimeout = 480;

    public function __construct()
    {
        // Timeout en minutes (15 minutes par défaut pour une banque)
        $this->timeout = config('session.lifetime', 15);
        $this->absoluteTimeout = config('session.absolute_timeout', 480);
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
            $sessionStarted = Session::get('session_started_at');
            $currentTime = now()->timestamp;

            // Si c'est la première activité de cette session
            if (!$lastActivity || !$sessionStarted) {
                Session::put('last_activity_time', $currentTime);
                Session::put('session_started_at', $currentTime);
                return $next($request);
            }

            // Calculer le temps total de la session en minutes
            $totalSessionMinutes = ($currentTime - $sessionStarted) / 60;

            // Vérifier le timeout absolu (8 heures maximum)
            if ($totalSessionMinutes > $this->absoluteTimeout) {
                $this->logSessionTimeout('absolute');

                Auth::logout();
                Session::flush();
                Session::regenerate();

                return redirect()->route('login', ['locale' => app()->getLocale()])
                    ->with('status', __('Votre session a expiré après 8 heures. Veuillez vous reconnecter.'))
                    ->with('session_expired', true);
            }

            // Calculer le temps d'inactivité en minutes
            $inactiveMinutes = ($currentTime - $lastActivity) / 60;

            // Si l'utilisateur a été inactif trop longtemps
            if ($inactiveMinutes > $this->timeout) {
                $this->logSessionTimeout('inactivity');

                Auth::logout();
                Session::flush();
                Session::regenerate();

                return redirect()->route('login', ['locale' => app()->getLocale()])
                    ->with('status', __('Votre session a expiré en raison d\'une inactivité. Veuillez vous reconnecter.'))
                    ->with('session_expired', true);
            }

            // Mettre à jour le dernier moment d'activité
            Session::put('last_activity_time', $currentTime);

            // Ajouter des headers pour informer le client
            $response = $next($request);
            $response->headers->set('X-Session-Timeout', $this->timeout * 60);
            $response->headers->set('X-Session-Remaining', ($this->timeout * 60) - ($inactiveMinutes * 60));
            $response->headers->set('X-Session-Absolute-Remaining', ($this->absoluteTimeout * 60) - ($totalSessionMinutes * 60));

            return $response;
        }

        return $next($request);
    }

    /**
     * Log session timeout
     */
    protected function logSessionTimeout(string $type = 'inactivity'): void
    {
        $user = Auth::user();

        if ($user) {
            $reason = $type === 'absolute'
                ? 'Session timeout after maximum duration (8 hours)'
                : 'Session timeout due to inactivity';

            activity()
                ->performedOn($user)
                ->causedBy($user)
                ->withProperties([
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'reason' => $reason,
                    'type' => $type,
                    'timeout_minutes' => $type === 'absolute' ? $this->absoluteTimeout : $this->timeout,
                ])
                ->log("Session expired: {$type}");
        }
    }
}
