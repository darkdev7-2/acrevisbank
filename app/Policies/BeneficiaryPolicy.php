<?php
namespace App\Policies;
use App\Models\User;
use App\Models\Beneficiary;

class BeneficiaryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view beneficiaries');
    }

    public function view(User $user, Beneficiary $beneficiaries): bool
    {
        return $user->hasPermissionTo('view beneficiaries');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create beneficiaries');
    }

    public function update(User $user, Beneficiary $beneficiaries): bool
    {
        return $user->hasPermissionTo('edit beneficiaries');
    }

    public function delete(User $user, Beneficiary $beneficiaries): bool
    {
        return $user->hasPermissionTo('delete beneficiaries');
    }

    public function restore(User $user, Beneficiary $beneficiaries): bool
    {
        return $user->hasPermissionTo('delete beneficiaries');
    }

    public function forceDelete(User $user, Beneficiary $beneficiaries): bool
    {
        return $user->hasPermissionTo('delete beneficiaries');
    }
}
