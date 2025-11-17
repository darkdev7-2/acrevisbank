<?php

namespace App\Livewire;

use App\Models\User;
use App\Mail\WelcomeEmail;
use App\Mail\NewRegistrationAdminEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithFileUploads;

class MultiStepRegistration extends Component
{
    use WithFileUploads;

    // Step management
    public $currentStep = 1;
    public $totalSteps = 4;

    // Step 1: Personal Information
    public $first_name = '';
    public $last_name = '';
    public $birth_date = '';
    public $birth_place = '';
    public $nationality = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    // Step 2: Contact Information
    public $phone = '';
    public $whatsapp = '';
    public $street = '';
    public $postal_code = '';
    public $city = '';
    public $country = 'Suisse';

    // Step 3: Professional Information
    public $profession = '';
    public $employer = '';
    public $annual_income = '';
    public $funds_source = '';
    public $politically_exposed = false;
    public $tax_residence_country = 'Suisse';
    public $tax_identification_number = '';

    // Step 4: Identity Verification
    public $id_document_type = '';
    public $id_document_number = '';
    public $id_document_expiry = '';
    public $id_document = null; // File upload
    public $terms_accepted = false;
    public $marketing_consent = false;

    protected function getRulesForStep($step)
    {
        $rules = [
            1 => [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'birth_date' => ['required', 'date', 'before:today', 'after:1900-01-01'],
                'birth_place' => ['required', 'string', 'max:255'],
                'nationality' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            ],
            2 => [
                'phone' => ['required', 'string', 'max:50'],
                'street' => ['required', 'string', 'max:255'],
                'postal_code' => ['required', 'string', 'max:10'],
                'city' => ['required', 'string', 'max:100'],
                'country' => ['required', 'string', 'max:100'],
            ],
            3 => [
                'profession' => ['required', 'string', 'max:255'],
                'employer' => ['nullable', 'string', 'max:255'],
                'annual_income' => ['required', 'numeric', 'min:0'],
                'funds_source' => ['required', 'string', 'max:255'],
                'tax_residence_country' => ['required', 'string', 'max:100'],
            ],
            4 => [
                'id_document_type' => ['required', 'in:passport,id_card,residence_permit'],
                'id_document_number' => ['required', 'string', 'max:255'],
                'id_document_expiry' => ['required', 'date', 'after:today'],
                'id_document' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'], // 5MB max
                'terms_accepted' => ['accepted'],
            ],
        ];

        return $rules[$step] ?? [];
    }

    protected $messages = [
        'first_name.required' => 'Le prénom est obligatoire.',
        'last_name.required' => 'Le nom est obligatoire.',
        'birth_date.required' => 'La date de naissance est obligatoire.',
        'birth_date.before' => 'La date de naissance doit être antérieure à aujourd\'hui.',
        'birth_place.required' => 'Le lieu de naissance est obligatoire.',
        'nationality.required' => 'La nationalité est obligatoire.',
        'email.required' => 'L\'email est obligatoire.',
        'email.email' => 'L\'email doit être valide.',
        'email.unique' => 'Cet email est déjà utilisé.',
        'password.required' => 'Le mot de passe est obligatoire.',
        'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        'phone.required' => 'Le numéro de téléphone est obligatoire.',
        'street.required' => 'La rue est obligatoire.',
        'postal_code.required' => 'Le code postal est obligatoire.',
        'city.required' => 'La ville est obligatoire.',
        'country.required' => 'Le pays est obligatoire.',
        'profession.required' => 'La profession est obligatoire.',
        'annual_income.required' => 'Le revenu annuel est obligatoire.',
        'annual_income.numeric' => 'Le revenu annuel doit être un nombre.',
        'funds_source.required' => 'La source des fonds est obligatoire.',
        'id_document_type.required' => 'Le type de document est obligatoire.',
        'id_document_number.required' => 'Le numéro de document est obligatoire.',
        'id_document_expiry.required' => 'La date d\'expiration est obligatoire.',
        'id_document_expiry.after' => 'Le document doit être valide.',
        'id_document.required' => 'Le document d\'identité est obligatoire.',
        'id_document.mimes' => 'Le document doit être au format PDF, JPG, JPEG ou PNG.',
        'id_document.max' => 'Le document ne doit pas dépasser 5MB.',
        'terms_accepted.accepted' => 'Vous devez accepter les conditions générales.',
    ];

    public function mount()
    {
        $this->currentStep = 1;
    }

    public function nextStep()
    {
        $this->validateData();
        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function validateData()
    {
        $this->validate($this->getRulesForStep($this->currentStep), $this->messages);
    }

    public function register()
    {
        // Validate final step
        $this->validateData();

        // Upload document
        $documentPath = $this->id_document->store('identity-documents', 'private');

        // Create user
        $user = User::create([
            'name' => $this->first_name . ' ' . $this->last_name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,
            'street' => $this->street,
            'postal_code' => $this->postal_code,
            'city' => $this->city,
            'country' => $this->country,
            'address' => $this->street . ', ' . $this->postal_code . ' ' . $this->city,
            'birth_date' => $this->birth_date,
            'birth_place' => $this->birth_place,
            'nationality' => $this->nationality,
            'profession' => $this->profession,
            'employer' => $this->employer,
            'annual_income' => $this->annual_income,
            'funds_source' => $this->funds_source,
            'politically_exposed' => $this->politically_exposed,
            'tax_residence_country' => $this->tax_residence_country,
            'tax_identification_number' => $this->tax_identification_number,
            'id_document_type' => $this->id_document_type,
            'id_document_number' => $this->id_document_number,
            'id_document_expiry' => $this->id_document_expiry,
            'id_document_path' => $documentPath,
            'validation_status' => 'pending',
            'is_active' => false, // Inactive until admin validates
            'email_verified_at' => now(), // Pre-verified since they provided email
            'terms_accepted' => true,
            'terms_accepted_at' => now(),
            'marketing_consent' => $this->marketing_consent,
            'marketing_consent_at' => $this->marketing_consent ? now() : null,
            'preferred_language' => app()->getLocale(),
        ]);

        // Assign Customer role
        $user->assignRole('Customer');

        // Send welcome email
        Mail::to($user->email)->send(new WelcomeEmail($user));

        // Send notification to admins
        $admins = User::role('Admin')->get();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new NewRegistrationAdminEmail($user));
        }

        // Redirect to pending validation page
        return redirect()->route('auth.pending-validation');
    }

    public function render()
    {
        return view('livewire.multi-step-registration')->layout('components.layouts.app');
    }
}
