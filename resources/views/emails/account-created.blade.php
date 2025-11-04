@component('mail::message')
# Félicitations, votre compte Acrevis Bank est activé ! 🎉

Bonjour {{ $account->user->name }},

Nous sommes heureux de vous informer que votre compte bancaire Acrevis Bank a été créé avec succès.

## Informations de votre compte

@component('mail::panel')
**Numéro de compte :** {{ $account->account_number }}

**IBAN :** {{ chunk_split($account->iban, 4, ' ') }}

**Type de compte :** {{ $account->account_type }}

**Devise :** {{ $account->currency }}

**Date d'ouverture :** {{ $account->opened_at->format('d/m/Y') }}
@endcomponent

## Accédez à votre espace client

@component('mail::button', ['url' => route('login')])
Se connecter à mon compte
@endcomponent

## Que pouvez-vous faire maintenant ?

✓ Consulter vos comptes et transactions
✓ Effectuer des virements
✓ Gérer vos bénéficiaires
✓ Télécharger vos relevés
✓ Demander un crédit

## Sécurité

Pour garantir la sécurité de votre compte :
- Ne partagez jamais vos identifiants
- Activez l'authentification à deux facteurs
- Vérifiez régulièrement vos transactions

@component('mail::panel')
**Besoin d'aide ?**

Notre service client est disponible du lundi au vendredi de 8h à 18h.
Téléphone : +41 71 xxx xx xx
Email : support@acrevisbank.ch
@endcomponent

Merci de votre confiance !

Cordialement,
**L'équipe Acrevis Bank**

---

@component('mail::subcopy')
© {{ date('Y') }} Acrevis Bank - Meine Bank fürs Leben

Ce compte a été créé pour l'adresse email {{ $account->user->email }}. Si vous n'êtes pas à l'origine de cette demande, veuillez contacter immédiatement notre service client.
@endcomponent
@endcomponent
