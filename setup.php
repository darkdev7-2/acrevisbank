<?php
/**
 * Installateur Web pour Acrevis Bank
 * À placer à la racine du projet et accéder via: https://votredomaine.com/setup.php
 */

// Sécurité: supprimer ce fichier après installation
$lockFile = __DIR__ . '/setup.lock';
if (file_exists($lockFile)) {
    die('❌ Installation déjà effectuée. Supprimez le fichier setup.lock pour réinstaller.');
}

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Étape du processus
$step = $_GET['step'] ?? 1;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation Acrevis Bank</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #d946a6 0%, #ec4899 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 { font-size: 2em; margin-bottom: 10px; }
        .header p { opacity: 0.9; }
        .content { padding: 40px; }
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            padding: 0 20px;
        }
        .step {
            flex: 1;
            text-align: center;
            padding: 10px;
            border-bottom: 3px solid #e5e7eb;
            color: #9ca3af;
            font-weight: 600;
        }
        .step.active {
            border-bottom-color: #ec4899;
            color: #ec4899;
        }
        .step.completed {
            border-bottom-color: #10b981;
            color: #10b981;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="url"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        input:focus {
            outline: none;
            border-color: #ec4899;
        }
        .btn {
            background: linear-gradient(135deg, #ec4899 0%, #d946a6 100%);
            color: white;
            padding: 14px 30px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
            width: 100%;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(236, 72, 153, 0.4);
        }
        .alert {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }
        .alert-info {
            background: #dbeafe;
            color: #1e40af;
            border-left: 4px solid #3b82f6;
        }
        .check-item {
            display: flex;
            align-items: center;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 6px;
            background: #f9fafb;
        }
        .check-item.success { background: #d1fae5; }
        .check-item.error { background: #fee2e2; }
        .check-icon {
            margin-right: 10px;
            font-size: 20px;
        }
        .small-text {
            font-size: 12px;
            color: #6b7280;
            margin-top: 5px;
        }
        code {
            background: #f3f4f6;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏦 Acrevis Bank</h1>
            <p>Assistant d'installation - Hostinger cPanel</p>
        </div>

        <div class="step-indicator">
            <div class="step <?= $step >= 1 ? 'active' : '' ?> <?= $step > 1 ? 'completed' : '' ?>">1. Vérification</div>
            <div class="step <?= $step >= 2 ? 'active' : '' ?> <?= $step > 2 ? 'completed' : '' ?>">2. Base de données</div>
            <div class="step <?= $step >= 3 ? 'active' : '' ?> <?= $step > 3 ? 'completed' : '' ?>">3. Configuration</div>
            <div class="step <?= $step >= 4 ? 'active' : '' ?>">4. Finalisation</div>
        </div>

        <div class="content">
            <?php
            // ÉTAPE 1: Vérification des prérequis
            if ($step == 1) {
                $checks = [];

                // Check PHP version
                $phpVersion = phpversion();
                $checks[] = [
                    'name' => 'Version PHP',
                    'status' => version_compare($phpVersion, '8.2.0', '>='),
                    'message' => "PHP $phpVersion" . (version_compare($phpVersion, '8.2.0', '>=') ? ' ✓' : ' (requis: 8.2+)')
                ];

                // Check extensions
                $requiredExtensions = ['pdo', 'pdo_mysql', 'mbstring', 'xml', 'json', 'openssl', 'tokenizer', 'fileinfo', 'curl'];
                foreach ($requiredExtensions as $ext) {
                    $checks[] = [
                        'name' => "Extension $ext",
                        'status' => extension_loaded($ext),
                        'message' => extension_loaded($ext) ? 'Installée ✓' : 'Manquante ✗'
                    ];
                }

                // Check directories
                $dirs = ['storage/framework/sessions', 'storage/framework/views', 'storage/framework/cache', 'storage/logs', 'bootstrap/cache'];
                foreach ($dirs as $dir) {
                    $path = __DIR__ . '/' . $dir;
                    $writable = is_dir($path) && is_writable($path);
                    $checks[] = [
                        'name' => "Écriture $dir",
                        'status' => $writable,
                        'message' => $writable ? 'OK ✓' : 'Pas d\'accès en écriture ✗'
                    ];
                }

                $allPassed = array_reduce($checks, fn($carry, $item) => $carry && $item['status'], true);

                echo '<h2>Vérification des prérequis</h2>';

                foreach ($checks as $check) {
                    $class = $check['status'] ? 'success' : 'error';
                    $icon = $check['status'] ? '✅' : '❌';
                    echo "<div class='check-item $class'>";
                    echo "<span class='check-icon'>$icon</span>";
                    echo "<div>";
                    echo "<strong>{$check['name']}</strong><br>";
                    echo "<span class='small-text'>{$check['message']}</span>";
                    echo "</div>";
                    echo "</div>";
                }

                if (!$allPassed) {
                    echo '<div class="alert alert-error">Certains prérequis ne sont pas satisfaits. Contactez votre hébergeur Hostinger.</div>';
                } else {
                    echo '<div class="alert alert-success">Tous les prérequis sont satisfaits! Vous pouvez continuer.</div>';
                    echo '<form method="get"><input type="hidden" name="step" value="2"><button type="submit" class="btn">Continuer →</button></form>';
                }
            }

            // ÉTAPE 2: Configuration base de données
            elseif ($step == 2) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dbHost = $_POST['db_host'];
                    $dbName = $_POST['db_name'];
                    $dbUser = $_POST['db_user'];
                    $dbPass = $_POST['db_password'];

                    try {
                        $pdo = new PDO("mysql:host=$dbHost", $dbUser, $dbPass);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Créer la base si elle n'existe pas
                        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                        $pdo->exec("USE `$dbName`");

                        // Sauvegarder en session
                        $_SESSION['db_config'] = [
                            'host' => $dbHost,
                            'name' => $dbName,
                            'user' => $dbUser,
                            'pass' => $dbPass
                        ];

                        echo '<div class="alert alert-success">✅ Connexion à la base de données réussie!</div>';
                        echo '<form method="get"><input type="hidden" name="step" value="3"><button type="submit" class="btn">Continuer →</button></form>';

                    } catch (PDOException $e) {
                        echo '<div class="alert alert-error">❌ Erreur de connexion: ' . htmlspecialchars($e->getMessage()) . '</div>';
                        echo '<br><a href="?step=2" class="btn">Réessayer</a>';
                    }
                } else {
                    echo '<h2>Configuration de la base de données</h2>';
                    echo '<div class="alert alert-info">📝 Créez d\'abord une base de données MySQL dans cPanel > MySQL Databases</div>';

                    echo '<form method="post">';
                    echo '<div class="form-group">';
                    echo '<label>Hôte de la base de données</label>';
                    echo '<input type="text" name="db_host" value="localhost" required>';
                    echo '<div class="small-text">Généralement "localhost" chez Hostinger</div>';
                    echo '</div>';

                    echo '<div class="form-group">';
                    echo '<label>Nom de la base de données</label>';
                    echo '<input type="text" name="db_name" placeholder="u123456789_acrevis" required>';
                    echo '<div class="small-text">Format Hostinger: u123456789_nombase</div>';
                    echo '</div>';

                    echo '<div class="form-group">';
                    echo '<label>Utilisateur</label>';
                    echo '<input type="text" name="db_user" placeholder="u123456789_user" required>';
                    echo '</div>';

                    echo '<div class="form-group">';
                    echo '<label>Mot de passe</label>';
                    echo '<input type="password" name="db_password" required>';
                    echo '</div>';

                    echo '<button type="submit" class="btn">Tester la connexion →</button>';
                    echo '</form>';
                }
            }

            // ÉTAPE 3: Configuration de l'application
            elseif ($step == 3) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $appUrl = rtrim($_POST['app_url'], '/');
                    $appName = $_POST['app_name'];
                    $mailHost = $_POST['mail_host'];
                    $mailUsername = $_POST['mail_username'];
                    $mailPassword = $_POST['mail_password'];

                    $_SESSION['app_config'] = [
                        'url' => $appUrl,
                        'name' => $appName,
                        'mail_host' => $mailHost,
                        'mail_user' => $mailUsername,
                        'mail_pass' => $mailPassword
                    ];

                    echo '<div class="alert alert-success">✅ Configuration enregistrée!</div>';
                    echo '<form method="get"><input type="hidden" name="step" value="4"><button type="submit" class="btn">Continuer →</button></form>';
                } else {
                    $currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

                    echo '<h2>Configuration de l\'application</h2>';
                    echo '<form method="post">';

                    echo '<div class="form-group">';
                    echo '<label>URL du site</label>';
                    echo '<input type="url" name="app_url" value="' . htmlspecialchars($currentUrl) . '" required>';
                    echo '<div class="small-text">URL complète avec https://</div>';
                    echo '</div>';

                    echo '<div class="form-group">';
                    echo '<label>Nom de l\'application</label>';
                    echo '<input type="text" name="app_name" value="Acrevis Bank" required>';
                    echo '</div>';

                    echo '<h3 style="margin-top: 30px; margin-bottom: 20px;">Configuration Email (SMTP)</h3>';

                    echo '<div class="form-group">';
                    echo '<label>Serveur SMTP</label>';
                    echo '<input type="text" name="mail_host" value="smtp.hostinger.com" required>';
                    echo '<div class="small-text">Pour Hostinger: smtp.hostinger.com</div>';
                    echo '</div>';

                    echo '<div class="form-group">';
                    echo '<label>Email (utilisateur SMTP)</label>';
                    echo '<input type="email" name="mail_username" placeholder="noreply@votredomaine.com" required>';
                    echo '<div class="small-text">Créez une adresse email dans cPanel > Email Accounts</div>';
                    echo '</div>';

                    echo '<div class="form-group">';
                    echo '<label>Mot de passe email</label>';
                    echo '<input type="password" name="mail_password" required>';
                    echo '</div>';

                    echo '<button type="submit" class="btn">Enregistrer →</button>';
                    echo '</form>';
                }
            }

            // ÉTAPE 4: Installation finale
            elseif ($step == 4) {
                if (!isset($_SESSION['db_config']) || !isset($_SESSION['app_config'])) {
                    die('❌ Configuration manquante. Recommencez depuis l\'étape 1.');
                }

                $db = $_SESSION['db_config'];
                $app = $_SESSION['app_config'];

                try {
                    // 1. Générer APP_KEY
                    $appKey = 'base64:' . base64_encode(random_bytes(32));

                    // 2. Créer le fichier .env
                    $envContent = "APP_NAME=\"{$app['name']}\"
APP_ENV=production
APP_KEY=$appKey
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL={$app['url']}

APP_LOCALE=fr
APP_FALLBACK_LOCALE=fr
APP_FAKER_LOCALE=fr_FR

DB_CONNECTION=mysql
DB_HOST={$db['host']}
DB_PORT=3306
DB_DATABASE={$db['name']}
DB_USERNAME={$db['user']}
DB_PASSWORD={$db['pass']}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=public
QUEUE_CONNECTION=database
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST={$app['mail_host']}
MAIL_PORT=587
MAIL_USERNAME={$app['mail_user']}
MAIL_PASSWORD={$app['mail_pass']}
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS={$app['mail_user']}
MAIL_FROM_NAME=\"{$app['name']}\"

SCOUT_DRIVER=database
";

                    file_put_contents(__DIR__ . '/.env', $envContent);

                    // 3. Importer le SQL
                    $pdo = new PDO("mysql:host={$db['host']};dbname={$db['name']}", $db['user'], $db['pass']);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Lire le fichier SQL d'installation
                    $sqlFile = __DIR__ . '/database/install.sql';
                    if (file_exists($sqlFile)) {
                        $sql = file_get_contents($sqlFile);
                        $pdo->exec($sql);
                    }

                    // 4. Créer le fichier lock
                    file_put_contents($lockFile, date('Y-m-d H:i:s'));

                    // 5. Nettoyer la session
                    session_destroy();

                    echo '<div class="alert alert-success">';
                    echo '<h2 style="margin-bottom: 15px;">🎉 Installation terminée avec succès!</h2>';
                    echo '<p>Votre application Acrevis Bank est maintenant installée.</p>';
                    echo '</div>';

                    echo '<div class="alert alert-info">';
                    echo '<h3>📋 Prochaines étapes:</h3>';
                    echo '<ol style="margin-left: 20px; margin-top: 10px;">';
                    echo '<li style="margin-bottom: 10px;"><strong>Supprimez setup.php</strong> pour des raisons de sécurité</li>';
                    echo '<li style="margin-bottom: 10px;">Accédez à l\'admin: <code>' . htmlspecialchars($app['url']) . '/admin</code></li>';
                    echo '<li style="margin-bottom: 10px;">Créez votre premier utilisateur admin dans cPanel > phpMyAdmin</li>';
                    echo '<li style="margin-bottom: 10px;">Configurez un Cron Job pour les tâches planifiées</li>';
                    echo '</ol>';
                    echo '</div>';

                    echo '<a href="' . htmlspecialchars($app['url']) . '" class="btn" style="margin-top: 20px;">Visiter le site →</a>';

                } catch (Exception $e) {
                    echo '<div class="alert alert-error">❌ Erreur: ' . htmlspecialchars($e->getMessage()) . '</div>';
                    echo '<br><a href="?step=2" class="btn">Recommencer</a>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
