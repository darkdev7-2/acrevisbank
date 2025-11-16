# 🚀 Déploiement Acrevis Bank sur Hostinger cPanel

## 📌 Résumé en 3 étapes

Ce projet est prêt pour un déploiement **sans SSH** sur Hostinger cPanel:

1. **⚡ Préparer** le package en local (5-10 min)
2. **📤 Uploader** sur Hostinger (5 min)
3. **🌐 Installer** via navigateur (2 min)

**Total: ~20 minutes**

---

## 🎯 ÉTAPE 1: Préparation (sur votre PC)

### Prérequis
- PHP 8.2+ installé
- Composer installé
- Node.js 18+ installé

### Commandes

```bash
# 1. Cloner ou télécharger le projet
git clone https://github.com/darkdev7-2/acrevisbank.git
cd acrevisbank

# 2. Rendre le script exécutable
chmod +x prepare-cpanel.sh

# 3. Exécuter la préparation
./prepare-cpanel.sh
```

**Sur Windows (avec Git Bash):**
```bash
bash prepare-cpanel.sh
```

### Résultat

Le script génère automatiquement:
- ✅ Installe toutes les dépendances PHP (Composer)
- ✅ Compile tous les assets frontend (npm build)
- ✅ Crée le fichier `.env.cpanel` (template de configuration)
- ✅ Crée les `.htaccess` optimisés
- ✅ Package complet dans: `../acrevisbank-cpanel-deploy.zip`

**📦 Fichier prêt à uploader:** `acrevisbank-cpanel-deploy.zip` (~50-100 MB)

---

## 📤 ÉTAPE 2: Upload sur Hostinger

### 2.1. Connexion
1. https://hpanel.hostinger.com
2. Votre hébergement → **File Manager**

### 2.2. Choisir l'emplacement
- **Site principal:** `public_html/`
- **Sous-domaine:** `public_html/nomdusite/` (recommandé)

### 2.3. Upload et extraction
1. Upload de `acrevisbank-cpanel-deploy.zip`
2. Clic droit → **Extract**
3. Déplacer tous les fichiers extraits à la racine
4. Supprimer le ZIP et le dossier vide

### 2.4. Créer la base de données
**hPanel → MySQL Databases:**
1. Créer une base: `acrevisbank`
2. Créer un utilisateur
3. Assigner l'utilisateur à la base (All Privileges)
4. **Noter:** nom complet de la base, utilisateur, mot de passe

---

## 🌐 ÉTAPE 3: Installation Web

### Accéder à l'installateur
```
https://votredomaine.com/setup.php
```

### Suivre l'assistant en 4 étapes

#### ✅ Étape 1: Vérification
- Le système vérifie automatiquement les prérequis
- Tout doit être vert ✅

#### 🗄️ Étape 2: Base de données
Renseigner les infos de l'étape 2.4:
- Hôte: `localhost`
- Nom de la base: `u123456789_acrevisbank`
- Utilisateur: `u123456789_user`
- Mot de passe: (celui créé)

#### ⚙️ Étape 3: Configuration
- URL du site: `https://votredomaine.com`
- Configuration email SMTP (Hostinger)

#### 🎉 Étape 4: Finalisation
- Installation automatique
- Création des tables
- Configuration finale

### ⚠️ Après installation

**IMPORTANT - Sécurité:**
1. Supprimez `setup.php`
2. Supprimez `setup.lock`

---

## 👨‍💼 Créer le Premier Admin

### Méthode 1: Via phpMyAdmin

**hPanel → phpMyAdmin → SQL:**

```sql
-- Créer l'admin
INSERT INTO users (name, email, password, email_verified_at, is_active, created_at, updated_at)
VALUES ('Admin', 'admin@acrevis.ch', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), 1, NOW(), NOW());

SET @user_id = LAST_INSERT_ID();

-- Créer le rôle
INSERT IGNORE INTO roles (name, guard_name, created_at, updated_at)
VALUES ('super_admin', 'web', NOW(), NOW());

-- Assigner le rôle
INSERT INTO model_has_roles (role_id, model_type, model_id)
VALUES ((SELECT id FROM roles WHERE name = 'super_admin'), 'App\\Models\\User', @user_id);
```

**Connexion:**
- Email: `admin@acrevis.ch`
- Mot de passe: `password`

⚠️ **Changez le mot de passe immédiatement!**

---

## ⚙️ Configuration Finale

### Cron Job (Obligatoire)

**hPanel → Advanced → Cron Jobs:**

**Fréquence:** Every Minute (toutes les minutes)

**Commande:**
```bash
cd /home/u123456789/public_html && php artisan schedule:run >> /dev/null 2>&1
```

**Ajustez le chemin selon votre installation!**

### Optimisation des performances

**Créez un fichier `optimize.php` à la racine:**

```php
<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->call('config:cache');
$kernel->call('route:cache');
$kernel->call('view:cache');
$kernel->call('storage:link');

echo "✅ Optimisation terminée! Supprimez ce fichier.";
```

**Accédez à:** `https://votredomaine.com/optimize.php`

Puis **supprimez** le fichier.

---

## ✅ Tests

### Checklist rapide
- [ ] Page d'accueil: `https://votredomaine.com/fr`
- [ ] Admin: `https://votredomaine.com/admin`
- [ ] Connexion admin fonctionne
- [ ] Switch de langue FR/DE/EN/ES
- [ ] Formulaire de contact
- [ ] Widget WhatsApp
- [ ] HTTPS actif (cadenas vert)

---

## 🐛 Problèmes Courants

| Problème | Solution |
|----------|----------|
| **Page blanche** | PHP < 8.2 → Changez dans hPanel PHP Configuration |
| **Erreur 500** | Vérifiez `.env`, permissions `storage` (755) |
| **CSS ne charge pas** | Vérifiez `APP_URL` dans `.env` |
| **BDD non connectée** | Vérifiez credentials dans `.env` |
| **Emails non envoyés** | Créez l'adresse email dans cPanel Email Accounts |

**Activer le debug temporairement:**
```
# Dans .env
APP_DEBUG=true
```

Puis **remettre à false** après!

---

## 📚 Documentation Complète

Pour un guide détaillé étape par étape avec captures d'écran:

👉 **[GUIDE-DEPLOIEMENT-HOSTINGER.md](./GUIDE-DEPLOIEMENT-HOSTINGER.md)**

---

## 🎯 Fichiers Créés pour le Déploiement

| Fichier | Description |
|---------|-------------|
| `prepare-cpanel.sh` | Script de préparation du package |
| `setup.php` | Installateur web automatique |
| `generate-sql.php` | Générateur de dump SQL (optionnel) |
| `GUIDE-DEPLOIEMENT-HOSTINGER.md` | Guide complet détaillé |
| `.env.cpanel` | Template de configuration |
| `.htaccess` | Configuration Apache optimisée |

---

## 🆘 Support

- **Documentation Hostinger:** https://support.hostinger.com
- **Chat support:** Disponible 24/7 dans hPanel
- **Issues GitHub:** https://github.com/darkdev7-2/acrevisbank/issues

---

## ✨ Fonctionnalités Incluses

✅ **Toutes les fonctionnalités testées et fonctionnelles:**
- Espace admin Filament (20 CRUDs)
- Authentification 2FA
- Pages publiques multi-langues
- Espace client dashboard
- Formulaire de contact (Livewire)
- Widget WhatsApp
- Recherche globale
- Export PDF/CSV
- Messagerie sécurisée

**Prêt pour production! 🚀**

---

## 📄 Licence

MIT License - Voir LICENSE pour plus de détails
