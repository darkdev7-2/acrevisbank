@component('mail::message')
# Nouvelle inscription - Action requise

Une nouvelle demande d'inscription a été soumise et nécessite votre validation.

## Informations du client

@component('mail::panel')
**Nom :** {{ $user->name }}

**Email :** {{ $user->email }}

**Date d'inscription :** {{ $user->created_at->format('d/m/Y à H:i') }}

**Rôle assigné :** Customer
@endcomponent

## Action requise

Veuillez examiner cette demande d'inscription et procéder aux étapes suivantes :

1. **Vérifier l'identité** du demandeur
2. **Valider les informations** fournies
3. **Créer le compte bancaire** si tout est conforme
4. **Générer l'IBAN** pour le nouveau compte

@component('mail::button', ['url' => route('filament.admin.pages.dashboard')])
Accéder au panel admin
@endcomponent

## Rappel - Processus de validation

**Conformité LBA (Loi sur le blanchiment d'argent) :**
- Vérification d'identité obligatoire
- Contrôle des documents justificatifs
- Validation de l'adresse

**Conformité FINMA :**
- Vérification des sanctions internationales
- Contrôle anti-blanchiment
- Due diligence client

@component('mail::panel')
**Délai recommandé :** Traiter cette demande dans les 24-48 heures
@endcomponent

## Navigation rapide

Pour traiter cette demande :
1. Connectez-vous au panel admin
2. Accédez à "Gestion Clients" → "Utilisateurs"
3. Recherchez : {{ $user->email }}
4. Validez ou rejetez la demande

---

Cordialement,
**Système Acrevis Bank**

@component('mail::subcopy')
© {{ date('Y') }} Acrevis Bank - Panel d'administration

Cette notification automatique a été envoyée à tous les administrateurs du système.
@endcomponent
@endcomponent
