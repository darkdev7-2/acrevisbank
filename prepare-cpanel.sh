#!/bin/bash

echo "🚀 Préparation du package pour cPanel Hostinger..."
echo ""

# 1. Installer les dépendances Composer (production)
echo "📦 Installation des dépendances PHP..."
composer install --no-dev --optimize-autoloader --no-interaction

# 2. Compiler les assets pour production
echo "🎨 Compilation des assets frontend..."
npm install
npm run build

# 3. Nettoyer node_modules (pas nécessaire en production)
echo "🧹 Nettoyage de node_modules..."
rm -rf node_modules

# 4. Créer le fichier .env.cpanel (template)
echo "⚙️  Création du template .env..."
cat > .env.cpanel << 'EOF'
APP_NAME="Acrevis Bank"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=https://votredomaine.com

APP_LOCALE=fr
APP_FALLBACK_LOCALE=fr
APP_FAKER_LOCALE=fr_FR

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=votre_db_name
DB_USERNAME=votre_db_user
DB_PASSWORD=votre_db_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=public
QUEUE_CONNECTION=database
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=noreply@votredomaine.com
MAIL_PASSWORD=votre_password_email
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@votredomaine.com
MAIL_FROM_NAME="${APP_NAME}"

SCOUT_DRIVER=database
EOF

# 5. Créer le répertoire de déploiement
echo "📁 Création du package de déploiement..."
mkdir -p ../acrevisbank-cpanel-deploy
rsync -av --progress ./ ../acrevisbank-cpanel-deploy/ \
  --exclude='.git' \
  --exclude='.github' \
  --exclude='node_modules' \
  --exclude='.env' \
  --exclude='.env.example' \
  --exclude='storage/logs/*' \
  --exclude='storage/framework/sessions/*' \
  --exclude='storage/framework/views/*' \
  --exclude='storage/framework/cache/*' \
  --exclude='tests' \
  --exclude='.phpunit.result.cache' \
  --exclude='phpunit.xml'

# 6. Créer les répertoires nécessaires
echo "📂 Création des répertoires storage..."
mkdir -p ../acrevisbank-cpanel-deploy/storage/framework/{sessions,views,cache}
mkdir -p ../acrevisbank-cpanel-deploy/storage/logs
mkdir -p ../acrevisbank-cpanel-deploy/bootstrap/cache

# 7. Créer le fichier .htaccess pour le root
cat > ../acrevisbank-cpanel-deploy/.htaccess << 'EOF'
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
EOF

# 8. Créer le .htaccess optimisé pour public/
cat > ../acrevisbank-cpanel-deploy/public/.htaccess << 'EOF'
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Force HTTPS
    RewriteCond %{HTTPS} !=on
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:AUTHORIZATION}]

    # Redirect Trailing Slashes
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>

# Disable directory browsing
Options -Indexes

# Protect sensitive files
<FilesMatch "^\.">
    Order allow,deny
    Deny from all
</FilesMatch>

<Files .env>
    Order allow,deny
    Deny from all
</Files>

# PHP Settings
<IfModule mod_php.c>
    php_value upload_max_filesize 64M
    php_value post_max_size 64M
    php_value max_execution_time 300
    php_value max_input_time 300
</IfModule>
EOF

# 9. Compresser le tout
echo "🗜️  Compression du package..."
cd ..
tar -czf acrevisbank-cpanel-deploy.tar.gz acrevisbank-cpanel-deploy/
zip -r acrevisbank-cpanel-deploy.zip acrevisbank-cpanel-deploy/

echo ""
echo "✅ Package prêt!"
echo ""
echo "📦 Fichiers créés:"
echo "   - acrevisbank-cpanel-deploy.tar.gz"
echo "   - acrevisbank-cpanel-deploy.zip"
echo ""
echo "📤 Uploadez l'un de ces fichiers sur votre cPanel Hostinger"
echo ""
