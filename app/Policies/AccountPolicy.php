<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Account;

class AccountPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view accounts');
    }

    public function view(User $user, Account $account): bool
    {
        return $user->hasPermissionTo('view accounts');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create accounts');
    }

    public function update(User $user, Account $account): bool
    {
        return $user->hasPermissionTo('edit accounts');
    }

    public function delete(User $user, Account $account): bool
    {
        return $user->hasPermissionTo('delete accounts');
    }
}
