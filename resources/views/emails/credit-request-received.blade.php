@component('mail::message')
# Nouvelle demande de crédit

Une nouvelle demande de crédit a été soumise et requiert votre attention.

## Informations du demandeur

**Nom complet:** {{ $creditRequest->first_name }} {{ $creditRequest->last_name }}
**Email:** {{ $creditRequest->email }}
**Téléphone:** {{ $creditRequest->phone }}
@if($creditRequest->whatsapp)
**WhatsApp:** {{ $creditRequest->whatsapp }}
@endif

**Profession:** {{ $creditRequest->profession ?? 'Non spécifiée' }}
**Ville:** {{ $creditRequest->city }}, {{ $creditRequest->country }}

## Détails de la demande

**Référence:** {{ $creditRequest->reference_number }}
**Montant demandé:** {{ number_format($creditRequest->amount, 2, '.', "'") }} {{ $creditRequest->currency }}
**Durée:** {{ $creditRequest->duration_months }} mois
**Objet du crédit:** {{ $creditRequest->purpose }}

@if($creditRequest->has_other_credit)
**Autres crédits en cours:** Oui
@if($creditRequest->other_credit_details)
**Détails:** {{ $creditRequest->other_credit_details }}
@endif
@else
**Autres crédits en cours:** Non
@endif

---

**Statut:** {{ $creditRequest->status }}
**Date de soumission:** {{ $creditRequest->created_at->format('d/m/Y H:i') }}

@component('mail::button', ['url' => config('app.url') . '/admin/credit-requests/' . $creditRequest->id])
Traiter la demande
@endcomponent

@if($creditRequest->attachment_path)
**Note:** Le demandeur a joint un document à sa demande. Vous pouvez le consulter dans l'administration.
@endif

Cordialement,
{{ config('app.name') }}
@endcomponent
