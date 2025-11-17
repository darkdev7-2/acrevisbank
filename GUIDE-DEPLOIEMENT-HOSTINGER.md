# 🚀 Guide de Déploiement Hostinger cPanel (Sans SSH)

## 📋 Vue d'ensemble

Ce guide vous explique comment déployer Acrevis Bank sur Hostinger cPanel sans accès SSH, en 3 étapes simples:

1. **Préparation en local** (sur votre ordinateur)
2. **Upload sur Hostinger**
3. **Installation via navigateur**

---

## 🔧 PARTIE 1: Préparation en Local

### Étape 1.1: Installer les outils nécessaires (sur votre PC)

Vous devez avoir installé:
- **PHP 8.2+** → https://www.php.net/downloads
- **Composer** → https://getcomposer.org/download/
- **Node.js 18+** → https://nodejs.org/

Vérifier:
```bash
php -v
composer -V
node -v
npm -v
```

### Étape 1.2: Cloner le projet

```bash
# Si vous avez git
git clone https://github.com/darkdev7-2/acrevisbank.git
cd acrevisbank

# Ou téléchargez le ZIP et décompressez-le
```

### Étape 1.3: Rendre le script exécutable et le lancer

```bash
# Sur Linux/Mac
chmod +x prepare-cpanel.sh
./prepare-cpanel.sh

# Sur Windows (avec Git Bash)
bash prepare-cpanel.sh
```

**⏱️ Durée: 5-10 minutes** (téléchargement des dépendances)

### Étape 1.4: Fichiers générés

Le script crée:
- `../acrevisbank-cpanel-deploy.tar.gz` (pour Linux/Mac)
- `../acrevisbank-cpanel-deploy.zip` (pour Windows)

**📦 Taille: ~50-100 MB**

---

## 📤 PARTIE 2: Upload sur Hostinger

### Étape 2.1: Se connecter à Hostinger cPanel

1. Allez sur https://hpanel.hostinger.com
2. Cliquez sur votre hébergement
3. Cliquez sur **"File Manager"**

### Étape 2.2: Choisir le bon emplacement

**Option A: Site principal** (votredomaine.com)
- Placez-vous dans le dossier: `public_html`
- Supprimez tous les fichiers existants (sauvegardez index.html si besoin)

**Option B: Sous-domaine** (acrevis.votredomaine.com) **[RECOMMANDÉ]**
1. Créez d'abord un sous-domaine dans hPanel
2. Notez le dossier créé (ex: `public_html/acrevis`)
3. Placez-vous dans ce dossier

### Étape 2.3: Uploader le fichier

1. Cliquez sur **"Upload"** en haut à droite
2. Sélectionnez `acrevisbank-cpanel-deploy.zip`
3. Attendez la fin de l'upload

**⏱️ Durée: 2-5 minutes** selon votre connexion

### Étape 2.4: Extraire l'archive

1. Faites un clic droit sur le fichier `.zip`
2. Cliquez sur **"Extract"**
3. Sélectionnez le dossier actuel
4. Cliquez sur **"Extract File(s)"**

**Résultat:** Tous les fichiers doivent maintenant être visibles dans le File Manager

### Étape 2.5: Déplacer les fichiers à la racine

Les fichiers sont dans `acrevisbank-cpanel-deploy/`. Il faut les déplacer:

1. Entrez dans le dossier `acrevisbank-cpanel-deploy`
2. Sélectionnez **tous les fichiers** (Ctrl+A)
3. Cliquez sur **"Move"**
4. Destination: le dossier parent (ex: `/public_html/`)
5. Confirmez

**6. Nettoyage:**
- Supprimez le dossier vide `acrevisbank-cpanel-deploy`
- Supprimez le fichier `.zip`

---

## 🗄️ PARTIE 3: Créer la Base de Données

### Étape 3.1: Accéder à MySQL Databases

1. Retournez au **hPanel**
2. Cherchez **"MySQL Databases"** (ou "Bases de données")
3. Cliquez dessus

### Étape 3.2: Créer la base de données

1. **Nom de la base:** `acrevisbank` (Hostinger ajoutera un préfixe automatiquement)
2. Cliquez sur **"Create"**
3. **Notez le nom complet:** `u123456789_acrevisbank` (exemple)

### Étape 3.3: Créer un utilisateur

1. **Nom d'utilisateur:** `acrevisbank_user`
2. **Mot de passe:** Générez un mot de passe fort (cliquez sur le générateur)
3. **⚠️ IMPORTANT:** Copiez et sauvegardez le mot de passe quelque part!
4. Cliquez sur **"Create"**

### Étape 3.4: Assigner l'utilisateur à la base

1. Cherchez la section **"Add User to Database"**
2. **Utilisateur:** Sélectionnez `u123456789_acrevisbank_user`
3. **Base de données:** Sélectionnez `u123456789_acrevisbank`
4. Cochez **"All Privileges"** (tous les privilèges)
5. Cliquez sur **"Add"**

---

## 🌐 PARTIE 4: Installation via Navigateur

### Étape 4.1: Accéder à l'installateur

Dans votre navigateur, allez sur:
```
https://votredomaine.com/setup.php
```

**⚠️ Sécurité:** Utilisez HTTPS. Si SSL n'est pas encore activé:
1. hPanel → **SSL**
2. Activez **Let's Encrypt SSL** (gratuit)
3. Attendez 10-15 minutes

### Étape 4.2: Suivre l'assistant d'installation

#### **ÉTAPE 1: Vérification**
- Le système vérifie automatiquement les prérequis
- Tous doivent être ✅ verts
- Si ❌ rouge, contactez le support Hostinger

#### **ÉTAPE 2: Base de données**

Renseignez les informations notées plus tôt:

| Champ | Valeur |
|-------|--------|
| **Hôte** | `localhost` |
| **Nom de la base** | `u123456789_acrevisbank` |
| **Utilisateur** | `u123456789_acrevisbank_user` |
| **Mot de passe** | (celui généré à l'étape 3.3) |

Cliquez sur **"Tester la connexion"**

#### **ÉTAPE 3: Configuration de l'application**

| Champ | Exemple | Description |
|-------|---------|-------------|
| **URL du site** | `https://acrevis.votredomaine.com` | URL complète avec https:// |
| **Nom de l'application** | `Acrevis Bank` | Peut rester par défaut |
| **Serveur SMTP** | `smtp.hostinger.com` | Pour Hostinger |
| **Email (utilisateur)** | `noreply@votredomaine.com` | Créez dans cPanel > Email Accounts |
| **Mot de passe email** | `***********` | Le mot de passe de cet email |

**📧 Créer l'adresse email:**
1. hPanel → **Email Accounts**
2. Créez `noreply@votredomaine.com`
3. Utilisez le mot de passe généré

#### **ÉTAPE 4: Finalisation**

- L'installation se lance automatiquement
- Les tables de base de données sont créées
- Le fichier `.env` est configuré
- ✅ **Installation terminée!**

### Étape 4.3: Sécurité post-installation

**⚠️ IMPORTANT - À faire immédiatement:**

1. **Supprimez setup.php**
   - File Manager → Sélectionnez `setup.php`
   - Delete (Supprimer)

2. **Supprimez setup.lock**
   - File Manager → Sélectionnez `setup.lock`
   - Delete

3. **Protégez le fichier .env**
   - Le .htaccess le protège déjà
   - Vérifiez qu'il n'est pas accessible: `https://votredomaine.com/.env`
   - Vous devez avoir une erreur 403 ou 404

---

## 👨‍💼 PARTIE 5: Créer le Premier Administrateur

### Option 1: Via phpMyAdmin (Recommandé)

1. **hPanel → phpMyAdmin**
2. Sélectionnez votre base `u123456789_acrevisbank`
3. Cliquez sur l'onglet **SQL**
4. Exécutez cette requête:

```sql
-- Créer un utilisateur administrateur
INSERT INTO users (
    name,
    email,
    password,
    email_verified_at,
    is_active,
    created_at,
    updated_at
) VALUES (
    'Super Admin',
    'admin@acrevis.ch',
    '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    NOW(),
    1,
    NOW(),
    NOW()
);

-- Récupérer l'ID de l'utilisateur créé
SET @user_id = LAST_INSERT_ID();

-- Créer le rôle super_admin s'il n'existe pas
INSERT IGNORE INTO roles (name, guard_name, created_at, updated_at)
VALUES ('super_admin', 'web', NOW(), NOW());

-- Assigner le rôle à l'utilisateur
INSERT INTO model_has_roles (role_id, model_type, model_id)
VALUES (
    (SELECT id FROM roles WHERE name = 'super_admin' LIMIT 1),
    'App\\Models\\User',
    @user_id
);
```

**Credentials par défaut:**
- Email: `admin@acrevis.ch`
- Mot de passe: `password`

**⚠️ Changez immédiatement le mot de passe!**

### Option 2: Créer manuellement dans la table

1. phpMyAdmin → Table `users` → Insert
2. Remplissez:
   - `name`: Votre nom
   - `email`: votre@email.com
   - `password`: Utilisez un hash bcrypt (voir ci-dessous)
   - `email_verified_at`: Date actuelle
   - `is_active`: 1

**Générer un hash de mot de passe:**
```php
<?php
// Créez un fichier hash.php à la racine du site
echo password_hash('VotreMotDePasse', PASSWORD_BCRYPT);
```
Accédez à `https://votredomaine.com/hash.php` puis supprimez le fichier.

---

## ⚙️ PARTIE 6: Configuration Finale

### 6.1: Configurer le Cron Job

**Important pour:** Emails, notifications, jobs en arrière-plan

1. **hPanel → Advanced → Cron Jobs**
2. Cliquez sur **"Create Cron Job"**
3. Configuration:

| Champ | Valeur |
|-------|--------|
| **Type** | Common Settings → Once Per Minute |
| **Minute** | `*` |
| **Hour** | `*` |
| **Day** | `*` |
| **Month** | `*` |
| **Weekday** | `*` |
| **Command** | Voir ci-dessous |

**Commande (ajustez le chemin):**
```bash
cd /home/u123456789/public_html && php artisan schedule:run >> /dev/null 2>&1
```

**Commande Queue Worker (optionnel):**
```bash
cd /home/u123456789/public_html && php artisan queue:work --stop-when-empty >> /dev/null 2>&1
```

**Comment trouver le bon chemin:**
- File Manager → Regardez en haut, le chemin complet s'affiche
- Exemple: `/home/u123456789/domains/votredomaine.com/public_html`

### 6.2: Optimiser les performances

**Créez un fichier `optimize.php` à la racine:**

```php
<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo "Optimisation en cours...\n";

// Config cache
$kernel->call('config:cache');
echo "✅ Config cachée\n";

// Route cache
$kernel->call('route:cache');
echo "✅ Routes cachées\n";

// View cache
$kernel->call('view:cache');
echo "✅ Views cachées\n";

echo "\n✅ Optimisation terminée!\n";
echo "Supprimez ce fichier optimize.php pour la sécurité.\n";
```

**Accédez à:** `https://votredomaine.com/optimize.php`

Puis **supprimez le fichier** `optimize.php`

### 6.3: Vérifier le lien symbolique storage

**Créez un fichier `link-storage.php`:**

```php
<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->call('storage:link');

echo "✅ Lien symbolique créé pour storage/public → public/storage\n";
echo "Supprimez ce fichier link-storage.php\n";
```

**Accédez à:** `https://votredomaine.com/link-storage.php`

Puis **supprimez** `link-storage.php`

---

## ✅ PARTIE 7: Tests Post-Déploiement

### Checklist de vérification

- [ ] **Page d'accueil:** `https://votredomaine.com/fr` s'affiche correctement
- [ ] **Switch de langue:** FR/DE/EN/ES fonctionnent
- [ ] **Admin:** `https://votredomaine.com/admin` → Page de login
- [ ] **Login admin:** Connexion avec credentials créés
- [ ] **Services:** Les pages services s'affichent
- [ ] **Agences:** La page agences s'affiche
- [ ] **Contact:** Le formulaire de contact fonctionne
- [ ] **Widget WhatsApp:** Visible en bas à gauche
- [ ] **Images:** Toutes les images chargent (pas de 404)
- [ ] **HTTPS:** Cadenas vert dans le navigateur
- [ ] **Mobile:** Test sur téléphone

### Tests fonctionnels

**Test 1: Formulaire de contact**
1. Allez sur `/fr/contact`
2. Remplissez le formulaire
3. Envoyez
4. Vérifiez dans l'admin: ContactFormSubmissions

**Test 2: Recherche globale**
1. Cliquez sur l'icône de recherche
2. Tapez "compte"
3. Vérifiez que les résultats s'affichent

**Test 3: Inscription client**
1. Allez sur `/register-account`
2. Créez un compte test
3. Vérifiez la réception du 2FA

---

## 🐛 Dépannage

### Problème: Page blanche

**Causes possibles:**
1. **PHP version < 8.2**
   - hPanel → PHP Configuration → Sélectionnez PHP 8.2 ou 8.3

2. **Permissions des dossiers**
   - File Manager → Sélectionnez `storage`
   - Permissions → 755 (ou 775)
   - Cochez "Recursively" → Save

3. **Erreur dans .env**
   - Vérifiez que le fichier `.env` existe
   - Vérifiez qu'il n'y a pas de guillemets manquants

### Problème: Erreur 500

**Activer les logs:**
```
# Dans .env, changez temporairement:
APP_DEBUG=true
```

Rechargez la page, l'erreur s'affichera.

**⚠️ N'oubliez pas de remettre `APP_DEBUG=false` après!**

**Consulter les logs:**
- File Manager → `storage/logs/laravel.log`
- Téléchargez et ouvrez avec un éditeur de texte

### Problème: CSS/JS ne chargent pas

1. **Vérifiez APP_URL dans .env**
   ```
   APP_URL=https://votredomaine.com
   ```

2. **Vérifiez que les fichiers existent:**
   - `public/build/assets/*.css`
   - `public/build/assets/*.js`

3. **Si absents, re-compilez en local:**
   ```bash
   npm run build
   # Puis re-uploadez le dossier public/build/
   ```

### Problème: Base de données non connectée

**Vérifiez dans .env:**
```
DB_HOST=localhost
DB_DATABASE=u123456789_acrevis  # Nom exact avec préfixe
DB_USERNAME=u123456789_user      # Nom exact
DB_PASSWORD=MotDePasseExact      # Sans guillemets
```

### Problème: Emails non envoyés

1. **Test de configuration SMTP:**
   - Créez `test-email.php`:
   ```php
   <?php
   $to = "votre@email.com";
   $subject = "Test";
   $message = "Test email depuis Acrevis Bank";
   $headers = "From: noreply@votredomaine.com";

   if(mail($to, $subject, $message, $headers)) {
       echo "✅ Email envoyé!";
   } else {
       echo "❌ Échec envoi";
   }
   ```

2. **Vérifiez les paramètres SMTP dans .env**

3. **Vérifiez que l'email existe dans cPanel**

### Problème: Formulaire ne soumet pas

**Livewire non chargé:**
1. Vérifiez que `public/livewire/` existe
2. Si absent:
   ```
   # En local
   php artisan livewire:publish --assets
   # Puis uploadez le dossier public/livewire/
   ```

---

## 📊 Maintenance

### Mise à jour du site

1. **Sauvegarde:**
   - File Manager → Compressez `public_html` → Téléchargez
   - phpMyAdmin → Export de la base

2. **Mise à jour:**
   - Uploadez les nouveaux fichiers
   - Lancez `optimize.php` (puis supprimez-le)

### Nettoyer les caches

Si le site ne se met pas à jour:

**Créez `clear-cache.php`:**
```php
<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->call('cache:clear');
$kernel->call('config:clear');
$kernel->call('route:clear');
$kernel->call('view:clear');

echo "✅ Tous les caches nettoyés!\n";
echo "Supprimez ce fichier.\n";
```

Accédez puis supprimez.

---

## 📞 Support

### Ressources Hostinger

- **Documentation:** https://support.hostinger.com
- **Chat support:** Disponible 24/7 dans hPanel
- **Tutoriels:** https://www.hostinger.com/tutorials

### Problèmes courants

- **Limite PHP:** hPanel → PHP Configuration → Augmentez `memory_limit` et `max_execution_time`
- **Upload size:** Augmentez `upload_max_filesize` et `post_max_size`

---

## 🎉 Félicitations!

Votre site **Acrevis Bank** est maintenant en ligne!

### URLs importantes

- **Site public:** `https://votredomaine.com/fr`
- **Administration:** `https://votredomaine.com/admin`
- **Espace client:** `https://votredomaine.com/fr/dashboard`

### Prochaines étapes recommandées

1. Remplir les contenus dans l'admin (services, articles, agences)
2. Créer les pages légales avec votre contenu
3. Configurer les emails transactionnels
4. Ajouter Google Analytics
5. Configurer une sauvegarde automatique

**Bon lancement! 🚀**
