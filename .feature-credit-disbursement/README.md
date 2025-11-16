# Système de Déboursement de Crédit

## Vue d'ensemble

Ce système permet une validation sécurisée en deux étapes pour le déboursement des crédits approuvés :

1. **Le client** génère un code de déboursement unique à 8 chiffres
2. **L'administrateur** voit le code et le communique au client (par téléphone, email, etc.)
3. **Le client** entre le code pour valider et créditer son compte

## Architecture

### Fichiers intégrés

#### Migration
- **Emplacement** : `database/migrations/2024_11_16_add_disbursement_code_to_credit_requests.php`
- **Champs ajoutés à `credit_requests`** :
  - `disbursement_code` (string, 8 caractères) - Code unique généré
  - `disbursement_code_generated_at` (timestamp) - Date de génération
  - `disbursement_status` (string) - Statut : `code_generated`, `validated`, `expired`
  - `account_id` (foreign key) - Compte à créditer
  - `disbursed_at` (timestamp) - Date effective du crédit

#### Contrôleur
- **Emplacement** : `app/Http/Controllers/CreditDisbursementController.php`
- **Méthodes** :
  - `generateCode($creditRequestId)` - Génère un code unique (CLIENT)
  - `validateCode($creditRequestId)` - Valide le code et crédite le compte (CLIENT)
  - `adminViewCodes()` - Affiche tous les codes générés (ADMIN)
  - `cancelCode($creditRequestId)` - Annule un code (ADMIN)

#### Vues Blade

**Vue client** :
- **Emplacement** : `resources/views/components/credit-disbursement-section.blade.php`
- **Usage** : À inclure dans la page de détail d'une demande de crédit
```php
@include('components.credit-disbursement-section', ['creditRequest' => $creditRequest])
```

**Vue admin** :
- **Emplacement** : `resources/views/admin/credit-disbursement-codes.blade.php`
- **Accessible via** : `/admin/credit-disbursement-codes`
- **Fonctionnalités** :
  - Liste de tous les codes générés
  - Filtrage par statut
  - Copie du code en un clic
  - Annulation de code

#### Routes
Routes ajoutées dans `routes/web.php` :

**Routes client** (dans le groupe `dashboard`) :
```php
POST /{locale}/dashboard/credit-disbursement/{id}/generate
POST /{locale}/dashboard/credit-disbursement/{id}/validate
```

**Routes admin** :
```php
GET  /{locale}/admin/credit-disbursement-codes
DELETE /{locale}/admin/credit-disbursement/{id}/cancel
```

## Workflow complet

### 1. Génération du code (Client)

Lorsqu'un crédit est **approuvé** (`status = 'approved'`), le client voit un bouton "Créditer mon compte".

**Action** : Le client clique sur le bouton
- Route : `POST /{locale}/dashboard/credit-disbursement/{id}/generate`
- Contrôleur : `CreditDisbursementController@generateCode`
- Résultat : Code à 8 chiffres généré et stocké

**Sécurité** :
- Code unique (vérification dans la base)
- Validité : 24 heures
- Un seul code actif par crédit

### 2. Communication du code (Admin)

L'administrateur accède à la liste des codes :
- URL : `/{locale}/admin/credit-disbursement-codes`
- Vue : Table affichant tous les codes avec :
  - Référence du crédit
  - Nom et email du client
  - Montant
  - **Code en grand** (copiable)
  - Date de génération
  - Statut

**Action** : L'admin communique le code au client par téléphone, email sécurisé, etc.

### 3. Validation du code (Client)

Le client entre le code dans le formulaire affiché.

**Champs requis** :
- Code (8 chiffres)
- Compte à créditer (sélection parmi ses comptes)

**Validation** :
- Route : `POST /{locale}/dashboard/credit-disbursement/{id}/validate`
- Contrôleur : `CreditDisbursementController@validateCode`
- Vérifications :
  1. Code correspond
  2. Code non expiré (< 24h)
  3. Compte appartient au client
  4. Crédit non déjà déboursé

**Si succès** :
1. Crédit du compte (`accounts.balance += amount`)
2. Création d'une transaction (`type = 'credit'`, `category = 'loan_disbursement'`)
3. Mise à jour du crédit (`disbursement_status = 'validated'`, `disbursed_at = now()`)
4. Logging de l'activité

**Si échec** :
- Code incorrect : Message d'erreur, tentative loggée
- Code expiré : Statut changé en `expired`, client peut générer un nouveau code
- Compte invalide : Erreur de validation

## Prérequis pour l'intégration complète

### 1. Modèle CreditRequest

Le modèle `App\Models\CreditRequest` doit exister avec les champs :

```php
protected $fillable = [
    'user_id',
    'reference_number',
    'amount',
    'currency',
    'status', // 'pending', 'approved', 'rejected'

    // Nouveaux champs pour le déboursement
    'disbursement_code',
    'disbursement_code_generated_at',
    'disbursement_status',
    'account_id',
    'disbursed_at',
];

protected $casts = [
    'disbursement_code_generated_at' => 'datetime',
    'disbursed_at' => 'datetime',
];

// Relations
public function user()
{
    return $this->belongsTo(User::class);
}

public function account()
{
    return $this->belongsTo(Account::class);
}
```

### 2. Modèle Account

Le modèle `App\Models\Account` doit exister :

```php
protected $fillable = [
    'user_id',
    'account_number',
    'account_type',
    'balance',
    'currency',
];

public function user()
{
    return $this->belongsTo(User::class);
}
```

### 3. Modèle Transaction

Le modèle `App\Models\Transaction` pour le logging :

```php
protected $fillable = [
    'account_id',
    'type', // 'credit', 'debit'
    'category', // 'loan_disbursement', etc.
    'amount',
    'currency',
    'description',
    'reference',
    'status',
    'balance_after',
    'transaction_date',
];
```

### 4. Package Spatie ActivityLog

Le contrôleur utilise `activity()` pour le logging. Installer si nécessaire :

```bash
composer require spatie/laravel-activitylog
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-migrations"
php artisan migrate
```

### 5. Vérification Admin

Dans le contrôleur, la vérification admin se fait via :

```php
if (!auth()->user()->is_admin) {
    abort(403);
}
```

S'assurer que le modèle `User` a un attribut `is_admin` ou un système de rôles équivalent.

### 6. Page de détail du crédit

Intégrer la section de déboursement dans la vue de détail :

```php
// resources/views/pages/dashboard/credit-requests/show.blade.php

<x-layouts.dashboard>
    <!-- Détails du crédit -->

    <!-- Section de déboursement (uniquement si approuvé) -->
    @include('components.credit-disbursement-section', ['creditRequest' => $creditRequest])
</x-layouts.dashboard>
```

## Commandes d'installation

```bash
# 1. Exécuter la migration
php artisan migrate

# 2. Vérifier que les routes sont enregistrées
php artisan route:list | grep disbursement

# 3. (Optionnel) Créer des données de test
php artisan tinker
>>> $credit = CreditRequest::create([...]);
>>> $credit->update(['status' => 'approved']);
```

## Sécurité

### Mesures implémentées

1. **Code unique** : Génération avec vérification de collision
2. **Expiration** : 24 heures après génération
3. **Logging** : Toutes les tentatives de validation loggées
4. **Transaction atomique** : Utilisation de `DB::beginTransaction()`
5. **Vérification propriétaire** : Le compte doit appartenir au client
6. **Middleware auth** : Toutes les routes protégées

### Mesures recommandées

1. **Rate limiting** : Limiter les tentatives de validation
2. **Notifications** : Email/SMS lors de la génération/validation
3. **Two-factor** : Ajouter un middleware 2FA pour les actions sensibles
4. **Audit trail** : Conserver l'historique complet dans ActivityLog
5. **Encryption** : Chiffrer les codes en base (optionnel)

## Extension future

Ce système peut être étendu pour :

- **Dépôts** : Validation des dépôts sur compte
- **Retraits** : Confirmation des retraits
- **Virements importants** : Au-delà d'un certain montant
- **Modifications de données sensibles** : Changement d'adresse, email, etc.

## Tests

### Test manuel

1. Créer une demande de crédit
2. Approuver la demande (admin)
3. Générer un code (client)
4. Vérifier que le code s'affiche (admin)
5. Valider avec le bon code (client)
6. Vérifier que le compte est crédité
7. Tester avec un mauvais code
8. Tester avec un code expiré

### Tests automatisés (à créer)

```php
// tests/Feature/CreditDisbursementTest.php
public function test_client_can_generate_code()
public function test_client_can_validate_with_correct_code()
public function test_validation_fails_with_wrong_code()
public function test_code_expires_after_24_hours()
public function test_admin_can_view_all_codes()
public function test_admin_can_cancel_code()
```

## Support

Pour toute question ou problème :
1. Vérifier que tous les prérequis sont installés
2. Consulter les logs Laravel : `storage/logs/laravel.log`
3. Vérifier les logs d'activité : Table `activity_log`

## Statut d'intégration

- [x] Migration créée et copiée
- [x] Contrôleur créé et copié
- [x] Vues client et admin créées et copiées
- [x] Routes ajoutées dans web.php
- [ ] Migration exécutée (`php artisan migrate`)
- [ ] Modèles CreditRequest, Account, Transaction existants et configurés
- [ ] Package ActivityLog installé et configuré
- [ ] Section intégrée dans la page de détail du crédit
- [ ] Tests créés et exécutés
- [ ] Documentation utilisateur créée
