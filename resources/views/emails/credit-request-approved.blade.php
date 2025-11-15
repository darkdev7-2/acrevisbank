@component('mail::message')
# Votre demande de crédit a été approuvée ! 🎉

Bonjour {{ $creditRequest->first_name }} {{ $creditRequest->last_name }},

Nous avons le plaisir de vous informer que votre demande de crédit a été approuvée par notre équipe.

## Détails de votre demande

@component('mail::panel')
**Numéro de référence :** {{ $creditRequest->reference_number }}

**Montant demandé :** {{ number_format($creditRequest->amount, 2) }} {{ $creditRequest->currency }}

**Durée :** {{ $creditRequest->duration_months }} mois

**Objet du crédit :** {{ $creditRequest->purpose }}

**Date d'approbation :** {{ $creditRequest->reviewed_at?->format('d/m/Y à H:i') ?? now()->format('d/m/Y à H:i') }}
@endcomponent

## Prochaines étapes

1. **Signature du contrat** : Un conseiller vous contactera sous 48h pour finaliser votre dossier
2. **Documents à préparer** : Pièce d'identité, justificatif de domicile, bulletins de salaire
3. **Versement des fonds** : Les fonds seront versés sur votre compte après signature

@component('mail::button', ['url' => route('login')])
Accéder à mon espace client
@endcomponent

## Informations importantes

- Taux d'intérêt annuel : À confirmer lors de l'entretien
- Frais de dossier : 0.5% du montant (min. 100 CHF)
- Assurance facultative disponible

@component('mail::panel')
**Besoin d'assistance ?**

Notre équipe crédit est à votre disposition :
- Téléphone : +41 71 xxx xx xx
- Email : credit@acrevisbank.ch
- Horaires : Lundi au vendredi, 8h-18h
@endcomponent

Nous nous réjouissons de vous accompagner dans votre projet !

Cordialement,
**Le service crédit Acrevis Bank**

---

@component('mail::subcopy')
© {{ date('Y') }} Acrevis Bank - Meine Bank fürs Leben

Cette notification concerne la demande de crédit référence {{ $creditRequest->reference_number }} pour {{ $creditRequest->email }}.
@endcomponent
@endcomponent
