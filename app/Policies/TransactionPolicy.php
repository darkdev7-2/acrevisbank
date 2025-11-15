<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Transaction;

class TransactionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view transactions');
    }

    public function view(User $user, Transaction $transaction): bool
    {
        return $user->hasPermissionTo('view transactions');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create transactions');
    }

    public function update(User $user, Transaction $transaction): bool
    {
        return $user->hasPermissionTo('edit transactions');
    }

    public function delete(User $user, Transaction $transaction): bool
    {
        return $user->hasPermissionTo('delete transactions');
    }
}
