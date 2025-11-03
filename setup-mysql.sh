#!/bin/bash

echo "🚀 Acrevis Bank - Configuration MySQL"
echo "======================================"
echo ""

# Vérifier que MySQL fonctionne
echo "📊 Vérification de MySQL..."
if ! systemctl is-active --quiet mysql 2>/dev/null && ! service mysql status > /dev/null 2>&1; then
    echo "⚠️  MySQL n'est pas démarré"
    echo "Tentative de démarrage de MySQL..."
    sudo systemctl start mysql 2>/dev/null || sudo service mysql start 2>/dev/null
    sleep 2
fi

# Tester la connexion
echo "🔌 Test de connexion à la base de données..."
php artisan db:show 2>/dev/null
if [ $? -ne 0 ]; then
    echo "❌ ERREUR: Impossible de se connecter à la base de données"
    echo ""
    echo "🔧 Actions requises:"
    echo "   1. Vérifiez votre fichier .env (DB_DATABASE, DB_USERNAME, DB_PASSWORD)"
    echo "   2. Créez la base de données si elle n'existe pas:"
    echo "      mysql -u root -p -e \"CREATE DATABASE acrevisbank CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;\""
    echo "   3. Vérifiez que MySQL est bien démarré:"
    echo "      sudo systemctl status mysql"
    exit 1
fi

echo "✅ Connexion à MySQL réussie"
echo ""

# Nettoyer les caches
echo "🧹 Nettoyage des caches..."
php artisan config:clear > /dev/null 2>&1
php artisan cache:clear > /dev/null 2>&1
php artisan route:clear > /dev/null 2>&1
php artisan view:clear > /dev/null 2>&1
echo "✅ Caches nettoyés"
echo ""

# Migrations
echo "📦 Exécution des migrations..."
php artisan migrate --force
if [ $? -ne 0 ]; then
    echo "❌ Erreur lors des migrations"
    exit 1
fi
echo "✅ Migrations terminées"
echo ""

# Seeders
echo "🌱 Génération des données..."
php artisan db:seed --force
if [ $? -ne 0 ]; then
    echo "❌ Erreur lors du seeding"
    exit 1
fi
echo "✅ Données générées"
echo ""

# Vérifier si npm est installé
if command -v npm &> /dev/null; then
    echo "🎨 Compilation des assets..."
    npm run build
    echo "✅ Assets compilés"
    echo ""
else
    echo "⚠️  NPM non trouvé - assets non compilés"
    echo "   Installez Node.js puis exécutez: npm install && npm run build"
    echo ""
fi

echo "🎉 Configuration terminée avec succès!"
echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📝 IDENTIFIANTS DE CONNEXION"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "👨‍💼 ADMIN (Panel d'administration)"
echo "   URL: http://localhost:8000/admin"
echo "   Email: admin@acrevis.ch"
echo "   Password: password"
echo ""
echo "👤 CLIENT TEST (Dashboard bancaire)"
echo "   URL: http://localhost:8000/fr/dashboard"
echo "   Email: test@example.com"
echo "   Password: password"
echo "   Comptes:"
echo "   • Compte courant: CH93 0076 2011 6238 5295 7 (~15'842 CHF)"
echo "   • Compte épargne: CH45 0839 0020 0060 4165 2 (~42'500 CHF)"
echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "🚀 DÉMARRER LE PROJET"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "Terminal 1 (Serveur Laravel):"
echo "   php artisan serve"
echo ""
echo "Terminal 2 (Assets en développement - optionnel):"
echo "   npm run dev"
echo ""
