<?php
namespace App\Policies;
use App\Models\User;
use App\Models\Article;

class ArticlePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view articles');
    }

    public function view(User $user, Article $articles): bool
    {
        return $user->hasPermissionTo('view articles');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create articles');
    }

    public function update(User $user, Article $articles): bool
    {
        return $user->hasPermissionTo('edit articles');
    }

    public function delete(User $user, Article $articles): bool
    {
        return $user->hasPermissionTo('delete articles');
    }

    public function restore(User $user, Article $articles): bool
    {
        return $user->hasPermissionTo('delete articles');
    }

    public function forceDelete(User $user, Article $articles): bool
    {
        return $user->hasPermissionTo('delete articles');
    }
}
