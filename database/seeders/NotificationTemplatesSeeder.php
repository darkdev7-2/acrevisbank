<?php

namespace Database\Seeders;

use App\Models\NotificationTemplate;
use Illuminate\Database\Seeder;

class NotificationTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            // Transaction Templates
            [
                'code' => 'transaction_approved',
                'name' => 'Transaction approuvée',
                'description' => 'Notification envoyée lorsqu\'une transaction est approuvée',
                'type' => 'email',
                'category' => 'transaction',
                'subject' => 'Transaction approuvée - {{amount}} {{currency}}',
                'body' => "Votre transaction a été approuvée avec succès.\n\nMontant: {{amount}} {{currency}}\nMarchand: {{merchant}}\nDate: {{date}}\nRéférence: {{transaction_id}}\n\nSi vous ne reconnaissez pas cette transaction, veuillez contacter immédiatement notre service client.",
                'placeholders' => ['amount', 'currency', 'merchant', 'date', 'transaction_id'],
                'is_system' => true,
                'is_active' => true,
            ],
            [
                'code' => 'transaction_declined',
                'name' => 'Transaction refusée',
                'description' => 'Notification envoyée lorsqu\'une transaction est refusée',
                'type' => 'email',
                'category' => 'transaction',
                'subject' => 'Transaction refusée',
                'body' => "Votre transaction a été refusée.\n\nMontant: {{amount}} {{currency}}\nMarchand: {{merchant}}\nRaison: {{reason}}\n\nSi vous avez des questions, n'hésitez pas à nous contacter.",
                'placeholders' => ['amount', 'currency', 'merchant', 'reason'],
                'is_system' => true,
                'is_active' => true,
            ],

            // Card Templates
            [
                'code' => 'card_blocked',
                'name' => 'Carte bloquée',
                'description' => 'Notification envoyée lorsqu\'une carte est bloquée',
                'type' => 'email',
                'category' => 'card',
                'subject' => 'Votre carte {{card_number}} a été bloquée',
                'body' => "Votre carte bancaire a été bloquée.\n\nCarte: {{card_number}}\nRaison: {{reason}}\nDate: {{date}}\n\nPour débloquer votre carte, veuillez vous connecter à votre espace client ou contacter notre service client.",
                'placeholders' => ['card_number', 'reason', 'date'],
                'is_system' => true,
                'is_active' => true,
            ],
            [
                'code' => 'card_activated',
                'name' => 'Carte activée',
                'description' => 'Notification envoyée lorsqu\'une carte est activée',
                'type' => 'email',
                'category' => 'card',
                'subject' => 'Votre carte {{card_number}} est maintenant active',
                'body' => "Votre carte bancaire virtuelle est maintenant active et prête à être utilisée.\n\nCarte: {{card_number}}\nExpiration: {{expiry_date}}\nLimite journalière: {{daily_limit}} CHF\n\nVous pouvez consulter les détails complets dans votre espace client.",
                'placeholders' => ['card_number', 'expiry_date', 'daily_limit'],
                'is_system' => true,
                'is_active' => true,
            ],
            [
                'code' => 'card_renewed',
                'name' => 'Carte renouvelée',
                'description' => 'Notification envoyée lorsqu\'une carte est renouvelée',
                'type' => 'email',
                'category' => 'card',
                'subject' => 'Votre carte a été renouvelée',
                'body' => "Une nouvelle carte bancaire a été créée pour remplacer votre ancienne carte.\n\nNouveaux détails disponibles dans votre espace client.\n\nAncienne carte: {{old_card_number}}\nNouvelle carte: {{new_card_number}}\n\nL'ancienne carte a été désactivée.",
                'placeholders' => ['old_card_number', 'new_card_number'],
                'is_system' => true,
                'is_active' => true,
            ],

            // Security Templates
            [
                'code' => 'security_alert',
                'name' => 'Alerte de sécurité',
                'description' => 'Notification envoyée pour les alertes de sécurité',
                'type' => 'email',
                'category' => 'security',
                'subject' => 'Alerte de sécurité - {{alert_type}}',
                'body' => "Une activité inhabituelle a été détectée sur votre compte.\n\nType d'alerte: {{alert_type}}\nDate: {{date}}\nDétails: {{details}}\n\nSi vous n'êtes pas à l'origine de cette activité, veuillez immédiatement:\n1. Changer votre mot de passe\n2. Vérifier vos transactions récentes\n3. Contacter notre service client\n\nVotre sécurité est notre priorité.",
                'placeholders' => ['alert_type', 'date', 'details'],
                'is_system' => true,
                'is_active' => true,
            ],
            [
                'code' => 'suspicious_activity',
                'name' => 'Activité suspecte détectée',
                'description' => 'Notification pour activité suspecte',
                'type' => 'email',
                'category' => 'security',
                'subject' => 'Activité suspecte détectée',
                'body' => "Nous avons détecté une activité suspecte sur votre compte.\n\nType: {{activity_type}}\nNiveau de risque: {{risk_level}}\nIP: {{ip_address}}\nLocalisation: {{location}}\n\nPar mesure de sécurité, veuillez vérifier vos informations de compte.",
                'placeholders' => ['activity_type', 'risk_level', 'ip_address', 'location'],
                'is_system' => true,
                'is_active' => true,
            ],

            // Message Templates
            [
                'code' => 'new_message',
                'name' => 'Nouveau message',
                'description' => 'Notification pour nouveau message reçu',
                'type' => 'email',
                'category' => 'message',
                'subject' => 'Nouveau message: {{subject}}',
                'body' => "Vous avez reçu un nouveau message.\n\nDe: {{sender}}\nSujet: {{subject}}\nType: {{type}}\n\nAperçu:\n{{preview}}\n\nConnectez-vous à votre espace client pour lire le message complet.",
                'placeholders' => ['sender', 'subject', 'type', 'preview'],
                'is_system' => true,
                'is_active' => true,
            ],
            [
                'code' => 'message_reply',
                'name' => 'Réponse à votre message',
                'description' => 'Notification pour réponse à un message',
                'type' => 'email',
                'category' => 'message',
                'subject' => 'Re: {{subject}}',
                'body' => "Vous avez reçu une réponse à votre message.\n\nDe: {{sender}}\nSujet: {{subject}}\n\nAperçu:\n{{preview}}\n\nConnectez-vous à votre espace client pour lire la réponse complète.",
                'placeholders' => ['sender', 'subject', 'preview'],
                'is_system' => true,
                'is_active' => true,
            ],

            // Account Templates
            [
                'code' => 'account_update',
                'name' => 'Mise à jour de compte',
                'description' => 'Notification pour mise à jour de compte',
                'type' => 'email',
                'category' => 'account',
                'subject' => 'Mise à jour de votre compte',
                'body' => "Des modifications ont été apportées à votre compte.\n\nType de modification: {{update_type}}\nDate: {{date}}\n\nSi vous n'avez pas effectué cette modification, veuillez nous contacter immédiatement.",
                'placeholders' => ['update_type', 'date'],
                'is_system' => true,
                'is_active' => true,
            ],
        ];

        foreach ($templates as $template) {
            NotificationTemplate::updateOrCreate(
                ['code' => $template['code']],
                $template
            );
        }

        $this->command->info('Notification templates seeded successfully!');
    }
}
