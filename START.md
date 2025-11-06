# Guide de Démarrage - Acrevis Bank

## ⚠️ IMPORTANT : Pour que Livewire fonctionne

Le formulaire de crédit et tous les composants Livewire **NÉCESSITENT** que le serveur Vite soit en cours d'exécution.

## 🚀 Démarrage Rapide

### Option 1 : Mode Développement (Recommandé)

Ouvrez **DEUX** terminaux :

**Terminal 1 - Serveur Laravel :**
```bash
php artisan serve
```

**Terminal 2 - Serveur Vite (OBLIGATOIRE) :**
```bash
npm run dev
```

✅ **Gardez les deux terminaux ouverts** pendant que vous travaillez !

### Option 2 : Mode Production

Si vous ne voulez pas laisser `npm run dev` tourner en permanence :

```bash
# Compiler les assets une seule fois
npm run build

# Puis lancer le serveur Laravel
php artisan serve
```

⚠️ **Inconvénient** : Vous devrez relancer `npm run build` après chaque modification CSS/JS.

## 🔍 Vérification

Pour vérifier que tout fonctionne :

1. Accédez à : http://127.0.0.1:8000/fr/credit-request
2. Tapez dans les champs → Les valeurs doivent se mettre à jour en temps réel
3. Cliquez "Suivant" sans remplir → Erreurs rouges doivent s'afficher
4. Ouvrez la console navigateur (F12) → Aucune erreur JavaScript

## ❌ Symptômes si Vite ne tourne pas

- Les champs du formulaire ne réagissent pas
- wire:model ne met pas à jour les valeurs
- wire:click ne déclenche rien
- Aucune erreur de validation ne s'affiche
- Console navigateur : "Failed to fetch dynamically imported module"

## 📝 Commandes Utiles

```bash
# Réinstaller les dépendances si nécessaire
composer install
npm install

# Migrer la base de données
php artisan migrate:fresh --seed

# Vider les caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Republier les assets Livewire
php artisan livewire:publish --assets
```

## 🎯 Accès à l'Application

- **Frontend** : http://127.0.0.1:8000
- **Admin Filament** : http://127.0.0.1:8000/admin
  - Email : admin@acrevisbank.ch
  - Password : password

## 💡 Pourquoi deux serveurs ?

- **php artisan serve** : Sert l'application Laravel (PHP)
- **npm run dev** : Compile et sert les assets (CSS, JS, Livewire, Alpine.js)

Sans `npm run dev`, aucun JavaScript n'est chargé → Livewire ne peut pas fonctionner.
