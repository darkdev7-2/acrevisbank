<?php
namespace App\Policies;
use App\Models\User;
use App\Models\Page;

class PagePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view pages');
    }

    public function view(User $user, Page $pages): bool
    {
        return $user->hasPermissionTo('view pages');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create pages');
    }

    public function update(User $user, Page $pages): bool
    {
        return $user->hasPermissionTo('edit pages');
    }

    public function delete(User $user, Page $pages): bool
    {
        return $user->hasPermissionTo('delete pages');
    }

    public function restore(User $user, Page $pages): bool
    {
        return $user->hasPermissionTo('delete pages');
    }

    public function forceDelete(User $user, Page $pages): bool
    {
        return $user->hasPermissionTo('delete pages');
    }
}
