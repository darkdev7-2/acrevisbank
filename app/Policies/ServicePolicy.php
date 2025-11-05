<?php
namespace App\Policies;
use App\Models\User;
use App\Models\Service;

class ServicePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view services');
    }

    public function view(User $user, Service $services): bool
    {
        return $user->hasPermissionTo('view services');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create services');
    }

    public function update(User $user, Service $services): bool
    {
        return $user->hasPermissionTo('edit services');
    }

    public function delete(User $user, Service $services): bool
    {
        return $user->hasPermissionTo('delete services');
    }

    public function restore(User $user, Service $services): bool
    {
        return $user->hasPermissionTo('delete services');
    }

    public function forceDelete(User $user, Service $services): bool
    {
        return $user->hasPermissionTo('delete services');
    }
}
