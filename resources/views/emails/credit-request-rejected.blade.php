@component('mail::message')
# Réponse à votre demande de crédit

Bonjour {{ $creditRequest->first_name }} {{ $creditRequest->last_name }},

Nous avons étudié attentivement votre demande de crédit et sommes au regret de vous informer que nous ne pouvons y donner une suite favorable pour le moment.

## Détails de votre demande

@component('mail::panel')
**Numéro de référence :** {{ $creditRequest->reference_number }}

**Montant demandé :** {{ number_format($creditRequest->amount, 2) }} {{ $creditRequest->currency }}

**Durée :** {{ $creditRequest->duration_months }} mois

**Date de traitement :** {{ $creditRequest->reviewed_at?->format('d/m/Y à H:i') ?? now()->format('d/m/Y à H:i') }}
@endcomponent

## Pourquoi cette décision ?

@if($creditRequest->admin_notes)
{{ $creditRequest->admin_notes }}
@else
Cette décision a été prise après une analyse approfondie de votre dossier selon nos critères d'attribution de crédit.
@endif

## Que pouvez-vous faire ?

**1. Nouvelle demande**
Vous pouvez déposer une nouvelle demande dans 6 mois. D'ici là, nous vous recommandons de :
- Améliorer votre capacité d'emprunt
- Réduire vos engagements financiers existants
- Constituer une épargne préalable

**2. Rendez-vous conseil**
Nos conseillers peuvent vous aider à optimiser votre situation financière.

@component('mail::button', ['url' => route('contact')])
Prendre rendez-vous
@endcomponent

**3. Autres solutions**
Nous proposons également :
- Prêt personnel avec conditions adaptées
- Crédit revolving
- Solutions d'épargne pour préparer votre projet

@component('mail::panel')
**Besoin d'explications ?**

N'hésitez pas à nous contacter pour plus d'informations :
- Téléphone : +41 71 xxx xx xx
- Email : credit@acrevisbank.ch
- Horaires : Lundi au vendredi, 8h-18h
@endcomponent

Nous restons à votre disposition pour vous accompagner dans vos projets futurs.

Cordialement,
**Le service crédit Acrevis Bank**

---

@component('mail::subcopy')
© {{ date('Y') }} Acrevis Bank - Meine Bank fürs Leben

Cette notification concerne la demande de crédit référence {{ $creditRequest->reference_number }} pour {{ $creditRequest->email }}.
@endcomponent
@endcomponent
