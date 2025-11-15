@component('mail::message')
# Bienvenue chez Acrevis Bank, {{ $user->name }} !

Nous avons bien reçu votre demande d'inscription à Acrevis Bank.

## Prochaines étapes

Votre inscription est actuellement en cours de vérification par notre équipe. Ce processus nous permet de garantir la sécurité de tous nos clients.

**Ce que nous vérifions :**
- Vérification de votre identité
- Conformité avec les réglementations bancaires suisses
- Validation de vos informations

**Délai de traitement :** Généralement 1-2 jours ouvrables

## Que se passe-t-il ensuite ?

1. Notre équipe examine votre demande
2. Vous recevrez un email de confirmation une fois votre compte validé
3. Vous pourrez alors accéder à tous nos services bancaires

@component('mail::panel')
**Informations de votre inscription**

Email : {{ $user->email }}
Date d'inscription : {{ now()->format('d/m/Y à H:i') }}
@endcomponent

Si vous avez des questions, n'hésitez pas à nous contacter.

Cordialement,
**L'équipe Acrevis Bank**

---

@component('mail::subcopy')
© {{ date('Y') }} Acrevis Bank - Meine Bank fürs Leben
@endcomponent
@endcomponent
