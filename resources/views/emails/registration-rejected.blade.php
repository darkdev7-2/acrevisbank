@component('mail::message')
# Réponse à votre demande d'inscription

Bonjour {{ $user->first_name }} {{ $user->last_name }},

Nous avons examiné attentivement votre demande d'ouverture de compte chez Acrevis Bank.

## Décision

Malheureusement, nous ne sommes pas en mesure de donner une suite favorable à votre demande pour le moment.

@component('mail::panel')
**Raison du refus :**

{{ $rejectionReason }}
@endcomponent

## Que pouvez-vous faire ?

**1. Nouvelle demande**
Vous pouvez soumettre une nouvelle demande après avoir résolu les points mentionnés ci-dessus.

**2. Documents complémentaires**
Si vous pensez disposer de documents supplémentaires qui pourraient appuyer votre demande, n'hésitez pas à nous contacter.

**3. Rendez-vous conseil**
Nos conseillers peuvent vous orienter vers des solutions adaptées à votre situation.

@component('mail::button', ['url' => route('contact')])
Nous contacter
@endcomponent

## Informations importantes

Cette décision a été prise conformément :
- Aux directives de la FINMA (Autorité fédérale de surveillance des marchés financiers)
- Aux obligations LBA (Loi sur le blanchiment d'argent)
- Aux critères d'acceptation de notre établissement

@component('mail::panel')
**Service client**

Pour toute question concernant cette décision :
- Téléphone : +41 71 xxx xx xx
- Email : onboarding@acrevisbank.ch
- Horaires : Lundi au vendredi, 8h-18h
@endcomponent

Nous vous remercions de l'intérêt que vous avez porté à Acrevis Bank.

Cordialement,
**Le service client Acrevis Bank**

---

@component('mail::subcopy')
© {{ date('Y') }} Acrevis Bank - Meine Bank fürs Leben

Cette notification concerne votre demande d'inscription pour l'email {{ $user->email }}.
@endcomponent
@endcomponent
