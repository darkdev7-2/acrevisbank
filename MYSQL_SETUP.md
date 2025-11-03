# Configuration MySQL pour Acrevis Bank

## Étape 1 : Créer la base de données

Connectez-vous à MySQL en tant que root :
```bash
mysql -u root -p
```

Ensuite, exécutez ces commandes SQL :
```sql
-- Créer la base de données
CREATE DATABASE acrevisbank CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Créer un utilisateur dédié (RECOMMANDÉ)
CREATE USER 'acrevis'@'localhost' IDENTIFIED BY 'VotreMotDePasseSecurise123!';

-- Donner tous les privilèges sur la base de données
GRANT ALL PRIVILEGES ON acrevisbank.* TO 'acrevis'@'localhost';

-- Appliquer les privilèges
FLUSH PRIVILEGES;

-- Quitter MySQL
EXIT;
```

## Étape 2 : Configurer le fichier .env

Modifiez votre fichier `.env` avec ces paramètres :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=acrevisbank
DB_USERNAME=acrevis
DB_PASSWORD=VotreMotDePasseSecurise123!
```

**OU** si vous utilisez l'utilisateur root directement (non recommandé en production) :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=acrevisbank
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe_root
```

## Étape 3 : Exécuter les migrations et seeders

```bash
# Installer les dépendances PHP
composer install

# Installer les dépendances NPM
npm install

# Compiler les assets
npm run build

# Générer la clé d'application
php artisan key:generate

# Nettoyer les caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Exécuter les migrations
php artisan migrate

# Exécuter les seeders
php artisan db:seed

# OU en une seule commande (réinitialise tout)
php artisan migrate:fresh --seed
```

## Étape 4 : Vérifier que tout fonctionne

```bash
# Démarrer le serveur
php artisan serve

# Dans un autre terminal, démarrer Vite (pour le développement)
npm run dev
```

Ouvrez votre navigateur sur : http://localhost:8000

## Comptes de test créés

### Compte Admin
- **Email :** admin@acrevis.ch
- **Mot de passe :** password
- **Accès :** Panel d'administration Filament (/admin)

### Compte Client Test
- **Email :** test@example.com
- **Mot de passe :** password
- **Accès :** Dashboard client (/fr/dashboard)
- **Comptes bancaires :**
  - Compte courant : CH93 0076 2011 6238 5295 7 (Solde : ~15'842 CHF)
  - Compte d'épargne : CH45 0839 0020 0060 4165 2 (Solde : ~42'500 CHF)

## Dépannage

### Erreur "Access denied for user"
```bash
# Vérifiez que MySQL fonctionne
sudo systemctl status mysql

# OU
sudo service mysql status

# Si MySQL n'est pas démarré
sudo systemctl start mysql
# OU
sudo service mysql start
```

### Erreur "Database does not exist"
```bash
# Reconnectez-vous à MySQL et recréez la base de données
mysql -u root -p
CREATE DATABASE acrevisbank CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### Erreur "SQLSTATE[HY000] [2002]"
Cela signifie que MySQL n'est pas démarré ou que le port est incorrect.
```bash
# Vérifier le port MySQL (devrait être 3306)
mysql -u root -p -e "SHOW VARIABLES LIKE 'port';"
```

### Réinitialisation complète
Si vous voulez tout recommencer :
```bash
# Supprimer et recréer la base de données
mysql -u root -p -e "DROP DATABASE IF EXISTS acrevisbank; CREATE DATABASE acrevisbank CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Relancer migrations et seeders
php artisan migrate:fresh --seed
```

## Script automatique (recommandé)

J'ai créé un script `setup.sh` mais voici une version MySQL-friendly :

```bash
#!/bin/bash

echo "🚀 Acrevis Bank - Configuration MySQL"
echo "======================================"
echo ""

# Vérifier que MySQL fonctionne
echo "📊 Vérification de MySQL..."
if ! systemctl is-active --quiet mysql && ! service mysql status > /dev/null 2>&1; then
    echo "❌ MySQL n'est pas démarré"
    echo "Démarrage de MySQL..."
    sudo systemctl start mysql || sudo service mysql start
fi

# Tester la connexion
echo "🔌 Test de connexion à la base de données..."
php artisan db:show 2>/dev/null
if [ $? -ne 0 ]; then
    echo "❌ ERREUR: Impossible de se connecter à la base de données"
    echo ""
    echo "🔧 Actions requises:"
    echo "   1. Vérifiez votre fichier .env"
    echo "   2. Vérifiez que la base de données 'acrevisbank' existe"
    echo "   3. Vérifiez les identifiants MySQL"
    exit 1
fi

echo "✅ Connexion réussie"
echo ""

# Nettoyer les caches
echo "🧹 Nettoyage des caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
echo "✅ Caches nettoyés"
echo ""

# Migrations
echo "📦 Exécution des migrations..."
php artisan migrate --force
echo "✅ Migrations terminées"
echo ""

# Seeders
echo "🌱 Génération des données..."
php artisan db:seed --force
echo "✅ Données générées"
echo ""

# Compiler les assets
echo "🎨 Compilation des assets..."
npm run build
echo "✅ Assets compilés"
echo ""

echo "🎉 Configuration terminée avec succès!"
echo ""
echo "📝 Identifiants admin:"
echo "   Email: admin@acrevis.ch"
echo "   Password: password"
echo ""
echo "📝 Identifiants client test:"
echo "   Email: test@example.com"
echo "   Password: password"
echo ""
echo "🚀 Démarrage du serveur:"
echo "   php artisan serve"
echo "   npm run dev (dans un autre terminal)"
```

Sauvegardez ce script dans `setup-mysql.sh` et exécutez :
```bash
chmod +x setup-mysql.sh
./setup-mysql.sh
```
