<?php

namespace App\Http\Middleware;

use App\Services\SuspiciousActivityDetectionService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DetectSuspiciousActivity
{
    protected SuspiciousActivityDetectionService $detectionService;

    public function __construct(SuspiciousActivityDetectionService $detectionService)
    {
        $this->detectionService = $detectionService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Vérifier le changement d'IP
            if ($this->detectionService->checkIpChange($user)) {
                $this->detectionService->detect(
                    $user,
                    'ip_change',
                    [
                        'new_ip' => $request->ip(),
                        'previous_ip' => cache()->get('last_ip_' . $user->id),
                    ],
                    'medium'
                );
            }

            // Vérifier l'heure inhabituelle
            if ($this->detectionService->checkUnusualTime()) {
                $this->detectionService->detect(
                    $user,
                    'unusual_time',
                    [
                        'hour' => now()->hour,
                        'timezone' => config('app.timezone'),
                    ],
                    'low'
                );
            }

            // Vérifier les transactions rapides (seulement sur les routes de transaction)
            if ($request->is('*/transfer/execute') || $request->is('*/transactions/create')) {
                if ($this->detectionService->checkRapidTransactions($user)) {
                    $this->detectionService->detect(
                        $user,
                        'rapid_transactions',
                        [
                            'route' => $request->path(),
                            'method' => $request->method(),
                        ],
                        'high'
                    );
                }
            }
        }

        return $next($request);
    }
}
