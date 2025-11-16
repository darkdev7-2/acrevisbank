<?php

namespace App\Services;

use App\Models\SuspiciousActivity;
use App\Models\User;
use App\Notifications\SuspiciousActivityDetected;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SuspiciousActivityDetectionService
{
    /**
     * Détecter et enregistrer une activité suspecte
     */
    public function detect(User $user, string $type, array $details = [], string $severity = 'medium'): ?SuspiciousActivity
    {
        $riskScore = $this->calculateRiskScore($user, $type, $details);

        // Créer l'enregistrement d'activité suspecte
        $activity = SuspiciousActivity::create([
            'user_id' => $user->id,
            'type' => $type,
            'severity' => $severity,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'location' => $this->getLocationFromIp(request()->ip()),
            'details' => $details,
            'risk_score' => $riskScore,
        ]);

        // Log l'activité
        Log::warning('Suspicious activity detected', [
            'user_id' => $user->id,
            'type' => $type,
            'severity' => $severity,
            'risk_score' => $riskScore,
            'ip' => request()->ip(),
        ]);

        // Log dans Spatie Activity Log
        activity()
            ->performedOn($user)
            ->causedBy($user)
            ->withProperties([
                'type' => $type,
                'severity' => $severity,
                'risk_score' => $riskScore,
                'ip' => request()->ip(),
                'details' => $details,
            ])
            ->log('Suspicious activity detected: ' . $type);

        // Notifier les admins si c'est critique
        if (in_array($severity, ['high', 'critical'])) {
            $this->notifyAdmins($activity);
        }

        // Prendre des actions automatiques si nécessaire
        $this->takeAutomaticActions($user, $activity);

        return $activity;
    }

    /**
     * Vérifier les tentatives de connexion multiples
     */
    public function checkMultipleLoginAttempts(string $identifier): bool
    {
        $cacheKey = 'login_attempts_' . md5($identifier);
        $attempts = Cache::get($cacheKey, 0);

        if ($attempts >= 3) {
            return true; // Activité suspecte détectée
        }

        return false;
    }

    /**
     * Enregistrer une tentative de connexion échouée
     */
    public function recordFailedLoginAttempt(string $identifier): void
    {
        $cacheKey = 'login_attempts_' . md5($identifier);
        $attempts = Cache::get($cacheKey, 0);
        Cache::put($cacheKey, $attempts + 1, now()->addMinutes(15));
    }

    /**
     * Vérifier le changement d'IP
     */
    public function checkIpChange(User $user): bool
    {
        $currentIp = request()->ip();
        $lastIp = Cache::get('last_ip_' . $user->id);

        if ($lastIp && $lastIp !== $currentIp) {
            return true; // Changement d'IP détecté
        }

        Cache::put('last_ip_' . $user->id, $currentIp, now()->addDays(30));
        return false;
    }

    /**
     * Vérifier l'heure de connexion inhabituelle
     */
    public function checkUnusualTime(): bool
    {
        $hour = now()->hour;

        // Considérer 2h-6h comme inhabituel pour une banque
        if ($hour >= 2 && $hour <= 6) {
            return true;
        }

        return false;
    }

    /**
     * Vérifier les transactions rapides successives
     */
    public function checkRapidTransactions(User $user): bool
    {
        $cacheKey = 'transactions_count_' . $user->id;
        $count = Cache::get($cacheKey, 0);

        if ($count >= 5) { // 5 transactions en 5 minutes
            return true;
        }

        Cache::put($cacheKey, $count + 1, now()->addMinutes(5));
        return false;
    }

    /**
     * Calculer le score de risque (0-100)
     */
    protected function calculateRiskScore(User $user, string $type, array $details): float
    {
        $baseScores = [
            'multiple_login_failures' => 60,
            'ip_change' => 40,
            'unusual_time' => 30,
            'rapid_transactions' => 70,
            'high_value_transaction' => 50,
            'password_change' => 35,
            'location_change' => 45,
            'session_hijack' => 90,
            'brute_force' => 95,
        ];

        $score = $baseScores[$type] ?? 50;

        // Ajuster le score en fonction des détails
        if (isset($details['attempts']) && $details['attempts'] > 5) {
            $score += 20;
        }

        if (isset($details['amount']) && $details['amount'] > 10000) {
            $score += 15;
        }

        // Vérifier l'historique de l'utilisateur
        $recentSuspiciousCount = SuspiciousActivity::where('user_id', $user->id)
            ->where('created_at', '>=', now()->subDays(7))
            ->count();

        if ($recentSuspiciousCount > 3) {
            $score += 10;
        }

        return min(100, $score);
    }

    /**
     * Obtenir la localisation depuis l'IP (simplifié)
     */
    protected function getLocationFromIp(string $ip): ?string
    {
        // Dans une vraie application, utiliser un service comme GeoIP2
        // Pour l'instant, retourner null
        return null;
    }

    /**
     * Notifier les administrateurs
     */
    protected function notifyAdmins(SuspiciousActivity $activity): void
    {
        $admins = User::role('Admin')->get();

        foreach ($admins as $admin) {
            try {
                $admin->notify(new SuspiciousActivityDetected($activity));
            } catch (\Exception $e) {
                Log::error('Failed to notify admin about suspicious activity', [
                    'admin_id' => $admin->id,
                    'activity_id' => $activity->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }

    /**
     * Prendre des actions automatiques
     */
    protected function takeAutomaticActions(User $user, SuspiciousActivity $activity): void
    {
        // Si le score de risque est très élevé, bloquer temporairement le compte
        if ($activity->risk_score >= 90) {
            // Envoyer une notification à l'utilisateur
            Log::warning('High risk activity detected, consider account suspension', [
                'user_id' => $user->id,
                'activity_id' => $activity->id,
            ]);

            // Dans une vraie application, on pourrait:
            // - Suspendre temporairement le compte
            // - Forcer une réinitialisation de mot de passe
            // - Exiger une vérification supplémentaire
        }

        // Si c'est une tentative de force brute, augmenter le délai
        if ($activity->type === 'brute_force') {
            Cache::put('brute_force_delay_' . $user->id, true, now()->addHours(1));
        }
    }

    /**
     * Résoudre une activité suspecte
     */
    public function resolve(SuspiciousActivity $activity, User $resolver, string $notes, bool $isFalsePositive = false): bool
    {
        return $activity->update([
            'is_resolved' => true,
            'resolved_by' => $resolver->id,
            'resolved_at' => now(),
            'resolution_notes' => $notes,
            'false_positive' => $isFalsePositive,
        ]);
    }

    /**
     * Obtenir les statistiques des activités suspectes
     */
    public function getStatistics(int $days = 30): array
    {
        $activities = SuspiciousActivity::where('created_at', '>=', now()->subDays($days))->get();

        return [
            'total' => $activities->count(),
            'unresolved' => $activities->where('is_resolved', false)->count(),
            'high_risk' => $activities->where('severity', 'high')->count(),
            'critical' => $activities->where('severity', 'critical')->count(),
            'false_positives' => $activities->where('false_positive', true)->count(),
            'by_type' => $activities->groupBy('type')->map->count(),
            'avg_risk_score' => round($activities->avg('risk_score'), 2),
        ];
    }
}
