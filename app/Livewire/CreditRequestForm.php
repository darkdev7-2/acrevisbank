<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CreditRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class CreditRequestForm extends Component
{
    use WithFileUploads;

    // Step management
    public $currentStep = 1;
    public $totalSteps = 3;

    // Step 1: Personal Information
    public $first_name = '';
    public $last_name = '';
    public $gender = '';
    public $birth_date = '';
    public $nationality = '';
    public $marital_status = '';
    public $profession = '';

    // Step 2: Contact Information
    public $country = 'CH';
    public $city = '';
    public $address = '';
    public $email = '';
    public $phone = '';
    public $whatsapp = '';

    // Step 3: Credit Details
    public $amount = '';
    public $currency = 'CHF';
    public $duration_months = '';
    public $purpose = '';
    public $has_other_credit = false;
    public $other_credit_details = '';
    public $attachment = null;

    protected function rules()
    {
        $rules = [];

        if ($this->currentStep == 1) {
            $rules = [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'gender' => 'nullable|in:M,F,Other',
                'birth_date' => 'nullable|date|before:today',
                'nationality' => 'nullable|string|max:100',
                'marital_status' => 'nullable|in:single,married,divorced,widowed,partnership',
                'profession' => 'nullable|string|max:255',
            ];
        } elseif ($this->currentStep == 2) {
            $rules = [
                'country' => 'required|string|max:100',
                'city' => 'required|string|max:255',
                'address' => 'required|string',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:50',
                'whatsapp' => 'nullable|string|max:50',
            ];
        } elseif ($this->currentStep == 3) {
            $rules = [
                'amount' => 'required|numeric|min:1000|max:1000000',
                'currency' => 'required|in:CHF,EUR,USD',
                'duration_months' => 'required|integer|min:12|max:360',
                'purpose' => 'required|string|max:1000',
                'has_other_credit' => 'boolean',
                'other_credit_details' => 'nullable|string|max:500',
                'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', // 5MB
            ];
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'first_name.required' => 'Le prénom est requis.',
            'last_name.required' => 'Le nom est requis.',
            'country.required' => 'Le pays est requis.',
            'city.required' => 'La ville est requise.',
            'address.required' => 'L\'adresse est requise.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email doit être une adresse valide.',
            'phone.required' => 'Le téléphone est requis.',
            'amount.required' => 'Le montant est requis.',
            'amount.min' => 'Le montant minimum est de 1\'000 CHF.',
            'amount.max' => 'Le montant maximum est de 1\'000\'000 CHF.',
            'duration_months.required' => 'La durée est requise.',
            'duration_months.min' => 'La durée minimum est de 12 mois.',
            'duration_months.max' => 'La durée maximum est de 360 mois.',
            'purpose.required' => 'L\'objet du crédit est requis.',
            'attachment.mimes' => 'Le fichier doit être au format PDF, JPG, JPEG ou PNG.',
            'attachment.max' => 'Le fichier ne doit pas dépasser 5MB.',
        ];
    }

    public function nextStep()
    {
        $this->validate();

        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
            $this->dispatch('step-changed', step: $this->currentStep);
        }
    }

    public function previousStep()
    {
        $this->resetErrorBag();

        if ($this->currentStep > 1) {
            $this->currentStep--;
            $this->dispatch('step-changed', step: $this->currentStep);
        }
    }

    public function submit()
    {
        $this->validate();

        try {
            // Handle file upload
            $attachmentPath = null;
            if ($this->attachment) {
                $attachmentPath = $this->attachment->store('credit-requests', 'public');
            }

            // Generate unique reference number
            $referenceNumber = 'CR-' . strtoupper(uniqid()) . '-' . date('Y');

            // Create credit request
            $creditRequest = CreditRequest::create([
                'user_id' => auth()->id(),
                'reference_number' => $referenceNumber,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'gender' => $this->gender,
                'birth_date' => $this->birth_date,
                'nationality' => $this->nationality,
                'marital_status' => $this->marital_status,
                'profession' => $this->profession,
                'country' => $this->country,
                'city' => $this->city,
                'address' => $this->address,
                'email' => $this->email,
                'phone' => $this->phone,
                'whatsapp' => $this->whatsapp,
                'amount' => $this->amount,
                'currency' => $this->currency,
                'duration_months' => $this->duration_months,
                'purpose' => $this->purpose,
                'has_other_credit' => $this->has_other_credit,
                'other_credit_details' => $this->other_credit_details,
                'attachment_path' => $attachmentPath,
                'status' => 'pending',
            ]);

            // Try to send email notification (conditional)
            $this->sendEmailNotifications($creditRequest);

            session()->flash('message', 'Votre demande de crédit a été envoyée avec succès!');
            session()->flash('reference_number', $referenceNumber);

            // Redirect to confirmation page
            return redirect()->route('credit.confirmation', ['locale' => app()->getLocale()]);

        } catch (Exception $e) {
            Log::error('Credit Request Submission Error: ' . $e->getMessage());
            session()->flash('error', 'Une erreur est survenue lors de l\'envoi de votre demande. Veuillez réessayer.');
            return;
        }
    }

    /**
     * Send email notifications if mail configuration is available
     */
    private function sendEmailNotifications($creditRequest)
    {
        try {
            // Check if mail is configured
            if (config('mail.default') && config('mail.mailers.' . config('mail.default'))) {
                // Try to get admin email from config or env
                $adminEmail = config('mail.admin_email', env('MAIL_ADMIN_EMAIL', 'admin@acrevisbank.ch'));

                // You can create proper Mailable classes later
                // For now, just log that email would be sent
                Log::info('Email notification would be sent to: ' . $adminEmail);
                Log::info('Credit Request Reference: ' . $creditRequest->reference_number);

                // Uncomment when you have proper Mailable classes
                // Mail::to($adminEmail)->send(new CreditRequestReceived($creditRequest));
                // Mail::to($this->email)->send(new CreditRequestConfirmation($creditRequest));
            } else {
                // Mail not configured - just log and continue
                Log::info('Mail not configured. Credit request saved without email notification.');
                Log::info('Credit Request Reference: ' . $creditRequest->reference_number);
            }
        } catch (Exception $e) {
            // If email fails, log it but don't fail the entire request
            Log::warning('Failed to send email notification: ' . $e->getMessage());
            Log::info('Credit request was still saved with reference: ' . $creditRequest->reference_number);
        }
    }

    public function render()
    {
        return view('livewire.credit-request-form');
    }
}
