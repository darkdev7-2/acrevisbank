@component('mail::message')
# Nouveau message de contact

Un nouveau message a été soumis via le formulaire de contact.

## Informations du contact

**Nom:** {{ $submission->name }}
**Email:** {{ $submission->email }}
**Téléphone:** {{ $submission->phone ?? 'Non fourni' }}
**Sujet:** {{ $submission->subject ?? 'Aucun sujet' }}

**Méthode de contact préférée:**
@if($submission->preferred_contact_method === 'email')
📧 Email
@elseif($submission->preferred_contact_method === 'phone')
📞 Téléphone
@elseif($submission->preferred_contact_method === 'whatsapp')
💬 WhatsApp
@else
{{ $submission->preferred_contact_method }}
@endif

## Message

{{ $submission->message }}

---

**Date de soumission:** {{ $submission->created_at->format('d/m/Y H:i') }}
**IP Address:** {{ $submission->ip_address ?? 'Non disponible' }}

@component('mail::button', ['url' => config('app.url') . '/admin/contact-form-submissions/' . $submission->id])
Voir dans l'administration
@endcomponent

Cordialement,
{{ config('app.name') }}
@endcomponent
