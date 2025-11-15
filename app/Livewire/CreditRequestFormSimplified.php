<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CreditRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CreditRequestFormSimplified extends Component
{
    // Form fields
    public $amount = '';
    public $currency = 'CHF';
    public $duration_months = '';
    public $repayment_date = '';
    public $purpose = '';
    public $contact_person = '';

    protected function rules()
    {
        return [
            'amount' => 'required|numeric|min:1000|max:1000000',
            'currency' => 'required|in:CHF,EUR,USD',
            'duration_months' => 'nullable|integer|min:1|max:360',
            'repayment_date' => 'required|date|after:today',
            'purpose' => 'required|string|max:1000',
            'contact_person' => 'required|string|max:255',
        ];
    }

    protected $messages = [
        'amount.required' => 'Le montant du prêt est obligatoire.',
        'amount.numeric' => 'Le montant doit être un nombre.',
        'amount.min' => 'Le montant minimum est de 1\'000.',
        'amount.max' => 'Le montant maximum est de 1\'000\'000.',
        'currency.required' => 'La devise est obligatoire.',
        'currency.in' => 'La devise doit être CHF, EUR ou USD.',
        'duration_months.integer' => 'La durée doit être un nombre entier.',
        'duration_months.min' => 'La durée minimum est de 1 mois.',
        'duration_months.max' => 'La durée maximum est de 360 mois (30 ans).',
        'repayment_date.required' => 'La date prévue de remboursement est obligatoire.',
        'repayment_date.date' => 'La date de remboursement doit être une date valide.',
        'repayment_date.after' => 'La date de remboursement doit être dans le futur.',
        'purpose.required' => 'Le motif du prêt est obligatoire.',
        'purpose.max' => 'Le motif ne peut pas dépasser 1000 caractères.',
        'contact_person.required' => 'La personne à contacter est obligatoire.',
        'contact_person.max' => 'Le nom de la personne ne peut pas dépasser 255 caractères.',
    ];

    public function mount()
    {
        // Set default currency based on user's country
        $user = Auth::user();
        if ($user && $user->country === 'Suisse') {
            $this->currency = 'CHF';
        } elseif ($user && in_array($user->country, ['France', 'Allemagne', 'Belgique'])) {
            $this->currency = 'EUR';
        }
    }

    public function submit()
    {
        $this->validate();

        $user = Auth::user();

        // Calculate duration in months if repayment_date is provided
        if ($this->repayment_date && !$this->duration_months) {
            $repaymentDate = Carbon::parse($this->repayment_date);
            $this->duration_months = Carbon::now()->diffInMonths($repaymentDate);
        }

        // Generate a unique reference number
        $referenceNumber = 'CR-' . date('Y') . '-' . strtoupper(uniqid());

        // Create credit request with user's info auto-filled
        $creditRequest = CreditRequest::create([
            'user_id' => $user->id,
            'reference_number' => $referenceNumber,

            // Auto-filled from user profile
            'first_name' => $user->first_name ?? $user->name,
            'last_name' => $user->last_name ?? '',
            'email' => $user->email,
            'phone' => $user->phone ?? '',
            'whatsapp' => $user->whatsapp ?? $user->phone ?? '',
            'country' => $user->country ?? '',
            'city' => $user->city ?? '',
            'address' => $user->address ?? '',

            // Optional fields from user profile (with defaults)
            'gender' => $user->gender ?? 'other',
            'birth_date' => $user->birth_date ?? null,
            'nationality' => $user->nationality ?? $user->country ?? '',
            'marital_status' => $user->marital_status ?? 'single',
            'profession' => $user->profession ?? '',

            // Fields filled by the user in the form
            'amount' => $this->amount,
            'currency' => $this->currency,
            'duration_months' => $this->duration_months,
            'purpose' => $this->purpose,

            // Store contact person in other_credit_details field (repurposed)
            'other_credit_details' => 'Personne à contacter: ' . $this->contact_person,
            'has_other_credit' => false,

            // Default status
            'status' => 'pending',
        ]);

        // Flash success message
        session()->flash('success', 'Votre demande de prêt a été soumise avec succès. Référence: ' . $referenceNumber);

        // Redirect to credit requests list
        return redirect()->route('dashboard.credit-requests.index', ['locale' => app()->getLocale()]);
    }

    public function render()
    {
        return view('livewire.credit-request-form-simplified');
    }
}
