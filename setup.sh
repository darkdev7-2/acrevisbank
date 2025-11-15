#!/bin/bash

echo "🚀 Acrevis Bank - Script de configuration"
echo "=========================================="
echo ""

# Check if database is accessible
echo "📊 Vérification de la connexion à la base de données..."
php artisan db:show 2>/dev/null
if [ $? -ne 0 ]; then
    echo "❌ ERREUR: La base de données n'est pas accessible"
    echo ""
    echo "🔧 Actions requises:"
    echo "   1. Démarrez MySQL/MariaDB: sudo systemctl start mysql"
    echo "   2. OU démarrez Docker: docker-compose up -d"
    echo "   3. Vérifiez vos paramètres dans .env:"
    echo "      DB_CONNECTION=mysql"
    echo "      DB_HOST=127.0.0.1"
    echo "      DB_PORT=3306"
    echo "      DB_DATABASE=acrevisbank"
    echo "      DB_USERNAME=root"
    echo "      DB_PASSWORD=your_password"
    echo ""
    exit 1
fi

echo "✅ Base de données accessible"
echo ""

# Run migrations
echo "📦 Exécution des migrations..."
php artisan migrate --force
echo "✅ Migrations terminées"
echo ""

# Run seeders
echo "🌱 Génération des données..."
php artisan db:seed --force
echo "✅ Données générées"
echo ""

# Clear caches
echo "🧹 Nettoyage des caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo "✅ Caches nettoyés"
echo ""

echo "🎉 Configuration terminée avec succès!"
echo ""
echo "📝 Identifiants admin:"
echo "   Email: admin@acrevis.ch"
echo "   Password: password"
echo ""
echo "🚀 Démarrez le serveur: php artisan serve"
