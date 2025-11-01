<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class NewsletterForm extends Component
{
    public $email = '';
    public $successMessage = '';
    public $errorMessage = '';

    protected $rules = [
        'email' => 'required|email|max:255',
    ];

    public function subscribe()
    {
        $this->validate();

        // Check if email already exists
        $exists = DB::table('newsletter_subscribers')
            ->where('email', $this->email)
            ->exists();

        if ($exists) {
            $locale = app()->getLocale();
            $messages = [
                'fr' => 'Cet email est déjà inscrit à notre newsletter.',
                'de' => 'Diese E-Mail ist bereits für unseren Newsletter registriert.',
                'en' => 'This email is already subscribed to our newsletter.',
                'es' => 'Este correo ya está suscrito a nuestro boletín.',
            ];
            $this->errorMessage = $messages[$locale] ?? $messages['en'];
            return;
        }

        // Insert new subscriber
        DB::table('newsletter_subscribers')->insert([
            'email' => $this->email,
            'subscribed_at' => now(),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $locale = app()->getLocale();
        $messages = [
            'fr' => 'Merci pour votre inscription! Vous recevrez bientôt notre newsletter.',
            'de' => 'Vielen Dank für Ihre Anmeldung! Sie erhalten bald unseren Newsletter.',
            'en' => 'Thank you for subscribing! You will receive our newsletter soon.',
            'es' => '¡Gracias por suscribirse! Recibirá nuestro boletín pronto.',
        ];
        $this->successMessage = $messages[$locale] ?? $messages['en'];
        $this->errorMessage = '';
        $this->email = '';

        // Optional: Send confirmation email
        // Mail::to($this->email)->send(new NewsletterSubscriptionConfirmation());
    }

    public function render()
    {
        return view('livewire.newsletter-form');
    }
}
