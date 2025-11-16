<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactFormSubmission;
use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $subject = '';
    public $message = '';
    public $preferred_contact_method = 'email';

    public $successMessage = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:50',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string|max:2000',
        'preferred_contact_method' => 'required|in:email,phone,whatsapp',
    ];

    public function submit()
    {
        $this->validate();

        // Store contact submission in database
        $submission = ContactFormSubmission::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
            'preferred_contact_method' => $this->preferred_contact_method,
            'status' => 'new',
            'ip_address' => request()->ip(),
        ]);

        // Send email notification to admin
        try {
            $adminEmail = config('mail.admin_email', env('MAIL_ADMIN_EMAIL', 'admin@acrevis.ch'));
            Mail::to($adminEmail)->send(new ContactFormSubmitted($submission));
        } catch (\Exception $e) {
            // Log but don't fail - email is not critical
            \Log::warning('Failed to send contact form notification email: ' . $e->getMessage());
        }

        $locale = app()->getLocale();
        $messages = [
            'fr' => 'Merci pour votre message! Nous vous contacterons bientôt.',
            'de' => 'Vielen Dank für Ihre Nachricht! Wir werden Sie bald kontaktieren.',
            'en' => 'Thank you for your message! We will contact you soon.',
            'es' => '¡Gracias por su mensaje! Le contactaremos pronto.',
        ];
        $this->successMessage = $messages[$locale] ?? $messages['en'];

        // Reset form
        $this->reset(['name', 'email', 'phone', 'subject', 'message', 'preferred_contact_method']);
        $this->preferred_contact_method = 'email';
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
