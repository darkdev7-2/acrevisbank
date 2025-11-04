<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Mail\WelcomeEmail;
use App\Mail\NewRegistrationAdminEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Spatie\Permission\Models\Role;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'validation_status' => 'pending', // Account pending admin validation
            'terms_accepted' => true,
            'terms_accepted_at' => now(),
        ]);

        // Assign default Customer role to new users
        $user->assignRole('Customer');

        // Send welcome email to the new user
        Mail::to($user->email)->send(new WelcomeEmail($user));

        // Send notification to all admins
        $admins = User::role('Admin')->get();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new NewRegistrationAdminEmail($user));
        }

        return $user;
    }
}
