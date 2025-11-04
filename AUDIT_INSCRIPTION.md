# 📋 RAPPORT D'AUDIT : SYSTÈME D'INSCRIPTION ACREVIS BANK

**Date**: 4 Novembre 2025
**Statut**: Phase 1 - Analyse complétée

---

## 🔍 1. ANALYSE DU FORMULAIRE D'INSCRIPTION

### ❌ Problèmes identifiés

**Formulaire actuel** (`resources/views/pages/auth/register.blade.php`):
```
- Prénom uniquement (pas de nom de famille séparé)
- Email
- Mot de passe
- Confirmation mot de passe
- Checkbox termes et conditions
```

### 🇨🇭 Standard bancaire suisse (KYC - Know Your Customer)

En Suisse, l'ouverture d'un compte bancaire nécessite **obligatoirement** :

**Informations personnelles** :
- ✅ Prénom
- ✅ Nom de famille
- ❌ Date de naissance
- ❌ Lieu de naissance
- ❌ Nationalité
- ❌ Numéro de téléphone (mobile)
- ❌ Adresse complète (rue, NPA, ville, pays)

**Pièces d'identité** :
- ❌ Type de document (Passeport, Carte d'identité, Permis de séjour)
- ❌ Numéro du document
- ❌ Upload du document (scan/photo)

**Informations professionnelles** (Anti-blanchiment) :
- ❌ Profession
- ❌ Employeur
- ❌ Revenu annuel estimé
- ❌ Source des fonds

**Type de compte** :
- ❌ Compte privé vs Compte épargne vs Compte joint
- ❌ Devise du compte (CHF, EUR, USD)

### 🎯 Recommandation

**Processus en 4 étapes** :
1. **Informations personnelles** (nom, prénom, date naissance, nationalité)
2. **Coordonnées** (adresse, téléphone, email)
3. **Informations professionnelles** (profession, employeur, revenus)
4. **Vérification d'identité** (upload pièce d'identité, confirmation)

---

## 🔧 2. ANALYSE DU BACKEND (CreateNewUser.php)

### ❌ Problèmes critiques

**Code actuel** :
```php
$user = User::create([
    'name' => $input['name'],
    'email' => $input['email'],
    'password' => Hash::make($input['password']),
]);

$user->assignRole('Customer');

return $user;  // C'est tout !
```

**Ce qui manque** :
- ❌ **Aucun compte bancaire créé** (pas d'Account)
- ❌ **Aucun email de bienvenue** au client
- ❌ **Aucune notification** à l'administrateur
- ❌ **Aucun système de validation** admin
- ❌ **Compte activé immédiatement** (pas de vérification email)
- ❌ **Pas de génération** de numéro de compte IBAN

### ✅ Ce qui devrait se passer

**Lors de l'inscription** :
1. Créer l'utilisateur avec statut `pending` (en attente de validation)
2. Envoyer un **email de vérification** au client
3. Envoyer une **notification à l'admin** (nouveau compte à valider)
4. **NE PAS créer de compte bancaire** avant validation admin
5. Rediriger vers une page "Votre demande est en cours de traitement"

**Après validation admin** :
1. Admin vérifie les documents d'identité
2. Admin valide le compte utilisateur (`status = active`)
3. **Créer automatiquement** un compte bancaire (Account)
4. **Générer un numéro IBAN** suisse (format: CH93 xxxx xxxx xxxx xxxx x)
5. Envoyer un **email de confirmation** au client avec :
   - Numéro de compte
   - IBAN
   - Instructions d'accès à l'e-banking
6. Log de l'événement pour audit

---

## 👨‍💼 3. ANALYSE DU PANNEAU ADMIN FILAMENT

### 📊 Ressources actuelles

**Existantes** :
- ✅ UserResource (gestion utilisateurs)
- ✅ CreditRequestResource (demandes de crédit)
- ✅ ArticleResource (blog)
- ✅ ServiceResource (services)
- ✅ AgencyResource (agences)
- ✅ ContactFormSubmissionResource (formulaires contact)
- ✅ NewsletterSubscriberResource (newsletter)
- ✅ MediaFileResource (fichiers média)
- ✅ PageResource (pages)

**Manquantes** :
- ❌ **AccountResource** (comptes bancaires) - CRITIQUE
- ❌ **TransactionResource** (transactions)
- ❌ **BeneficiaryResource** (bénéficiaires)
- ❌ **PendingRegistrationResource** (inscriptions en attente)

### 🎨 Organisation actuelle du menu

Actuellement, les ressources sont **découvertes automatiquement** sans organisation :

```
├─ Dashboard
├─ Users
├─ Credit Requests
├─ Articles
├─ Article Categories
├─ Services
├─ Agencies
├─ Contact Form Submissions
├─ Newsletter Subscribers
├─ Media Files
└─ Pages
```

### ✅ Organisation recommandée

**Menu avec groupes logiques** :

```
🏠 Dashboard

👥 GESTION CLIENTS
   ├─ Clients (Users avec filtre role=Customer)
   ├─ Inscriptions en attente (nouveau)
   └─ Comptes bancaires (nouveau)

💰 OPÉRATIONS BANCAIRES
   ├─ Transactions (nouveau)
   ├─ Bénéficiaires (nouveau)
   └─ Demandes de crédit

📄 CONTENU DU SITE
   ├─ Articles (Blog)
   ├─ Catégories d'articles
   ├─ Services
   ├─ Pages
   └─ Médias

🏢 GESTION BANQUE
   ├─ Agences
   └─ Équipe (Users avec filtre role=Admin)

📧 COMMUNICATION
   ├─ Formulaires de contact
   └─ Newsletter

⚙️ PARAMÈTRES
   ├─ Utilisateurs & Rôles
   └─ Configuration système
```

---

## 📝 PLAN D'ACTION RECOMMANDÉ

### Phase 1 : Formulaire d'inscription multi-étapes
- [ ] Créer composant Livewire multi-étapes (4 étapes)
- [ ] Ajouter tous les champs KYC requis
- [ ] Upload de pièce d'identité
- [ ] Validation avec règles suisses (IBAN, NPA, etc.)

### Phase 2 : Backend et notifications
- [ ] Modifier CreateNewUser pour ajouter statut `pending`
- [ ] Créer Notification email client (EmailVerification)
- [ ] Créer Notification email admin (NewRegistration)
- [ ] Créer page "En attente de validation"
- [ ] Créer migration pour ajouter colonnes KYC au User

### Phase 3 : Validation admin
- [ ] Créer AccountResource pour Filament
- [ ] Créer PendingRegistrationResource
- [ ] Ajouter action "Valider le compte"
- [ ] Générer automatiquement IBAN suisse
- [ ] Créer Account lors de la validation
- [ ] Email de confirmation avec IBAN

### Phase 4 : Organisation menu Filament
- [ ] Créer NavigationGroups dans AdminPanelProvider
- [ ] Organiser les ressources par groupe
- [ ] Ajouter icônes personnalisées
- [ ] Définir l'ordre des items

### Phase 5 : Ressources manquantes
- [ ] TransactionResource
- [ ] BeneficiaryResource
- [ ] Widgets dashboard (stats comptes, transactions)

---

## 🎯 PRIORITÉS

**URGENT** (Sécurité & Conformité) :
1. ⚠️ Système de validation admin avant activation compte
2. ⚠️ Collecte des informations KYC obligatoires
3. ⚠️ Vérification d'identité

**IMPORTANT** (UX & Business) :
4. Formulaire multi-étapes professionnel
5. Emails de notification
6. Génération automatique IBAN

**AMÉLIORATION** (Organisation) :
7. Ressource Account dans Filament
8. Organisation du menu admin
9. Dashboard avec statistiques

---

## 📊 COMPARAISON : ACTUEL vs RECOMMANDÉ

| Aspect | Actuel | Recommandé |
|--------|--------|------------|
| **Champs inscription** | 3 champs | 15+ champs KYC |
| **Processus** | 1 page | 4 étapes |
| **Validation** | Automatique | Admin manuel |
| **Compte bancaire** | ❌ Pas créé | ✅ Créé après validation |
| **IBAN** | ❌ Aucun | ✅ Généré automatiquement |
| **Email client** | ❌ Aucun | ✅ Vérification + Confirmation |
| **Email admin** | ❌ Aucun | ✅ Notification nouvelle inscription |
| **Documents** | ❌ Aucun | ✅ Pièce d'identité requise |
| **Menu admin** | Plat (10 items) | Organisé (6 groupes) |
| **Ressources** | 9 ressources | 13 ressources |

---

## 🔒 CONFORMITÉ RÉGLEMENTAIRE SUISSE

**Lois applicables** :
- **LBA** (Loi sur le blanchiment d'argent)
- **FINMA** (Autorité de surveillance des marchés financiers)
- **LPD** (Loi sur la protection des données)

**Exigences** :
- ✅ Identification formelle du client (KYC)
- ✅ Vérification de la pièce d'identité
- ✅ Déclaration de l'ayant droit économique
- ✅ Traçabilité des opérations
- ✅ Conservation des documents (10 ans)

---

**Prochaine étape** : Implémentation du nouveau système d'inscription
