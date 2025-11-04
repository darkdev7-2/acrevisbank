<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CreditRequest;

class CreditRequestPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view credit requests');
    }

    public function view(User $user, CreditRequest $creditRequest): bool
    {
        return $user->hasPermissionTo('view credit requests');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create credit requests');
    }

    public function update(User $user, CreditRequest $creditRequest): bool
    {
        return $user->hasPermissionTo('edit credit requests');
    }

    public function delete(User $user, CreditRequest $creditRequest): bool
    {
        return $user->hasPermissionTo('delete credit requests');
    }

    public function approve(User $user, CreditRequest $creditRequest): bool
    {
        return $user->hasPermissionTo('approve credit requests');
    }

    public function reject(User $user, CreditRequest $creditRequest): bool
    {
        return $user->hasPermissionTo('reject credit requests');
    }
}
