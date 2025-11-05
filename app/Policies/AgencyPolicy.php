<?php
namespace App\Policies;
use App\Models\User;
use App\Models\Agency;

class AgencyPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view agencies');
    }

    public function view(User $user, Agency $agencies): bool
    {
        return $user->hasPermissionTo('view agencies');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create agencies');
    }

    public function update(User $user, Agency $agencies): bool
    {
        return $user->hasPermissionTo('edit agencies');
    }

    public function delete(User $user, Agency $agencies): bool
    {
        return $user->hasPermissionTo('delete agencies');
    }

    public function restore(User $user, Agency $agencies): bool
    {
        return $user->hasPermissionTo('delete agencies');
    }

    public function forceDelete(User $user, Agency $agencies): bool
    {
        return $user->hasPermissionTo('delete agencies');
    }
}
