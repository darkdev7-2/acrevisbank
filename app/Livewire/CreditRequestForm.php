<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CreditRequest;
use Illuminate\Support\Facades\Mail;

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

    public function nextStep()
    {
        $this->validate();

        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function submit()
    {
        $this->validate();

        // Handle file upload
        $attachmentPath = null;
        if ($this->attachment) {
            $attachmentPath = $this->attachment->store('credit-requests', 'public');
        }

        // Create credit request
        $creditRequest = CreditRequest::create([
            'user_id' => auth()->id(),
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

        // Send email notification (to admin and client)
        // Mail::to('admin@acrevis.ch')->send(new CreditRequestReceived($creditRequest));
        // Mail::to($this->email)->send(new CreditRequestConfirmation($creditRequest));

        session()->flash('message', 'Votre demande de crédit a été envoyée avec succès!');

        // Redirect to confirmation page
        return redirect()->route('credit.confirmation', ['locale' => app()->getLocale()]);
    }

    public function render()
    {
        return view('livewire.credit-request-form');
    }
}
