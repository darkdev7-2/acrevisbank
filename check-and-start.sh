#!/bin/bash

echo "════════════════════════════════════════════════════════════════════════════"
echo "  VÉRIFICATION ET DÉMARRAGE - ACREVIS BANK"
echo "════════════════════════════════════════════════════════════════════════════"
echo ""

# Fonction pour vérifier MySQL
check_mysql() {
    echo "🔍 Vérification de MySQL..."

    # Vérifier si MySQL est actif
    if systemctl is-active --quiet mysql 2>/dev/null; then
        echo "✅ MySQL est démarré"
        return 0
    elif service mysql status 2>/dev/null | grep -q "running"; then
        echo "✅ MySQL est démarré"
        return 0
    else
        echo "❌ MySQL n'est PAS démarré"
        return 1
    fi
}

# Fonction pour démarrer MySQL
start_mysql() {
    echo ""
    echo "🚀 Démarrage de MySQL..."

    if sudo systemctl start mysql 2>/dev/null; then
        echo "✅ MySQL démarré avec systemctl"
        return 0
    elif sudo service mysql start 2>/dev/null; then
        echo "✅ MySQL démarré avec service"
        return 0
    else
        echo "❌ Impossible de démarrer MySQL"
        echo "Veuillez démarrer MySQL manuellement:"
        echo "  sudo systemctl start mysql"
        echo "  OU"
        echo "  sudo service mysql start"
        return 1
    fi
}

# Vérifier MySQL
if ! check_mysql; then
    echo ""
    read -p "Voulez-vous démarrer MySQL maintenant? (o/n) " -n 1 -r
    echo
    if [[ $REPLY =~ ^[OoYy]$ ]]; then
        if ! start_mysql; then
            exit 1
        fi
    else
        echo "⚠️  MySQL doit être démarré pour utiliser l'application"
        exit 1
    fi
fi

echo ""
echo "🔌 Test de connexion à la base de données..."
php artisan db:show 2>/dev/null

if [ $? -ne 0 ]; then
    echo ""
    echo "❌ ERREUR: Impossible de se connecter à la base de données"
    echo ""
    echo "Causes possibles:"
    echo "  1. La base de données 'acrevisbank' n'existe pas"
    echo "  2. Les identifiants dans .env sont incorrects"
    echo "  3. MySQL n'accepte pas les connexions"
    echo ""
    echo "Solutions:"
    echo "  1. Créer la base de données:"
    echo "     mysql -u root -p -e \"CREATE DATABASE acrevisbank CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;\""
    echo ""
    echo "  2. Vérifier votre fichier .env:"
    echo "     DB_DATABASE=acrevisbank"
    echo "     DB_USERNAME=votre_utilisateur"
    echo "     DB_PASSWORD=votre_mot_de_passe"
    echo ""
    exit 1
fi

echo "✅ Connexion à la base de données réussie"
echo ""

# Vérifier si les tables existent
echo "📊 Vérification des tables..."
TABLE_COUNT=$(mysql -u $(grep DB_USERNAME .env | cut -d '=' -f2) -p$(grep DB_PASSWORD .env | cut -d '=' -f2) $(grep DB_DATABASE .env | cut -d '=' -f2) -e "SHOW TABLES;" 2>/dev/null | wc -l)

if [ "$TABLE_COUNT" -lt 5 ]; then
    echo "⚠️  Peu ou pas de tables trouvées"
    echo ""
    read -p "Voulez-vous exécuter les migrations et seeders? (o/n) " -n 1 -r
    echo
    if [[ $REPLY =~ ^[OoYy]$ ]]; then
        echo ""
        echo "📦 Exécution des migrations..."
        php artisan migrate --force

        echo ""
        echo "🌱 Exécution des seeders..."
        php artisan db:seed --force

        echo ""
        echo "✅ Base de données initialisée"
    fi
else
    echo "✅ Tables de base de données trouvées"
fi

echo ""
echo "🧹 Nettoyage des caches..."
php artisan config:clear 2>/dev/null
php artisan cache:clear 2>/dev/null
php artisan route:clear 2>/dev/null
php artisan view:clear 2>/dev/null
echo "✅ Caches nettoyés"

echo ""
echo "════════════════════════════════════════════════════════════════════════════"
echo "  ✅ SYSTÈME PRÊT"
echo "════════════════════════════════════════════════════════════════════════════"
echo ""
echo "Pour démarrer le serveur:"
echo "  php artisan serve"
echo ""
echo "Puis accédez à:"
echo "  http://127.0.0.1:8000"
echo ""
echo "Comptes de test:"
echo "  Admin:  admin@acrevis.ch / password"
echo "  Client: test@example.com / password"
echo ""
