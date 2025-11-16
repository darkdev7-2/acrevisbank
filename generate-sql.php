<?php
/**
 * Générateur de SQL d'installation pour cPanel
 * À exécuter en local: php generate-sql.php
 */

// Charger Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Connexion à la base de données
$pdo = DB::connection()->getPdo();

// Créer le répertoire si nécessaire
if (!is_dir(__DIR__ . '/database')) {
    mkdir(__DIR__ . '/database', 0755, true);
}

$output = "-- Acrevis Bank - Installation SQL\n";
$output .= "-- Généré le: " . date('Y-m-d H:i:s') . "\n\n";
$output .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

// Liste des tables à exporter
$tables = [
    'users',
    'password_reset_tokens',
    'sessions',
    'cache',
    'cache_locks',
    'jobs',
    'job_batches',
    'failed_jobs',
    'permissions',
    'roles',
    'model_has_permissions',
    'model_has_roles',
    'role_has_permissions',
    'activity_log',
    'services',
    'pages',
    'article_categories',
    'articles',
    'credit_requests',
    'media_files',
    'contact_form_submissions',
    'newsletter_subscriptions',
    'agencies',
    'accounts',
    'transactions',
    'beneficiaries',
    'careers',
    'suspicious_activities',
    'notifications',
    'cards',
    'card_transactions',
    'messages',
    'notification_preferences',
    'notification_templates',
    'contact_infos'
];

// Exporter la structure de chaque table
foreach ($tables as $table) {
    try {
        // Supprimer la table si elle existe
        $output .= "DROP TABLE IF EXISTS `$table`;\n";

        // Obtenir CREATE TABLE
        $stmt = $pdo->query("SHOW CREATE TABLE `$table`");
        $row = $stmt->fetch(PDO::FETCH_NUM);

        if ($row) {
            $output .= $row[1] . ";\n\n";
        }
    } catch (Exception $e) {
        echo "Attention: Table $table ignorée (" . $e->getMessage() . ")\n";
    }
}

$output .= "SET FOREIGN_KEY_CHECKS=1;\n\n";

// Ajouter les données de base (seeders essentiels)
$output .= "-- Données de base\n\n";

// Permissions par défaut
$output .= "-- Permissions (à adapter selon vos besoins)\n";
$output .= "INSERT INTO `permissions` (`name`, `guard_name`, `created_at`, `updated_at`) VALUES\n";
$output .= "('view_users', 'web', NOW(), NOW()),\n";
$output .= "('create_users', 'web', NOW(), NOW()),\n";
$output .= "('edit_users', 'web', NOW(), NOW()),\n";
$output .= "('delete_users', 'web', NOW(), NOW());\n\n";

// Role admin
$output .= "-- Rôle administrateur\n";
$output .= "INSERT INTO `roles` (`name`, `guard_name`, `created_at`, `updated_at`) VALUES\n";
$output .= "('super_admin', 'web', NOW(), NOW());\n\n";

// Sauvegarder
file_put_contents(__DIR__ . '/database/install.sql', $output);

echo "✅ Fichier SQL généré: database/install.sql\n";
echo "📊 " . count($tables) . " tables exportées\n";
