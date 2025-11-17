@component('mail::message')
# Confirmation de votre demande de crédit

Bonjour {{ $creditRequest->first_name }} {{ $creditRequest->last_name }},

Nous avons bien reçu votre demande de crédit et vous en remercions.

## Récapitulatif de votre demande

**Numéro de référence:** {{ $creditRequest->reference_number }}
**Montant demandé:** {{ number_format($creditRequest->amount, 2, '.', "'") }} {{ $creditRequest->currency }}
**Durée souhaitée:** {{ $creditRequest->duration_months }} mois
**Objet:** {{ $creditRequest->purpose }}

## Prochaines étapes

Votre demande est actuellement **en cours d'examen** par notre équipe.

Un conseiller étudiera votre dossier dans les plus brefs délais et vous contactera:
- Par email: {{ $creditRequest->email }}
@if($creditRequest->preferred_contact_method === 'phone' || $creditRequest->phone)
- Par téléphone: {{ $creditRequest->phone }}
@endif
@if($creditRequest->preferred_contact_method === 'whatsapp' && $creditRequest->whatsapp)
- Par WhatsApp: {{ $creditRequest->whatsapp }}
@endif

### Délai de traitement

Nous nous engageons à vous répondre sous **3 à 5 jours ouvrables**.

### Documents complémentaires

Si des documents supplémentaires sont nécessaires pour l'étude de votre dossier, nous vous en informerons par email.

@component('mail::panel')
**Important:** Conservez votre numéro de référence **{{ $creditRequest->reference_number }}** pour toute correspondance concernant votre demande.
@endcomponent

@component('mail::button', ['url' => config('app.url')])
Accéder à votre espace client
@endcomponent

## Besoin d'aide ?

Si vous avez des questions concernant votre demande, n'hésitez pas à nous contacter:
- Email: support@acrevis.ch
- Téléphone: +41 71 227 27 28

Cordialement,
L'équipe {{ config('app.name') }}
@endcomponent
