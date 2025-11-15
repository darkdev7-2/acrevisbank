<?php
namespace App\Policies;
use App\Models\User;
use App\Models\MediaFile;

class MediaFilePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view media');
    }

    public function view(User $user, MediaFile $media): bool
    {
        return $user->hasPermissionTo('view media');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create media');
    }

    public function update(User $user, MediaFile $media): bool
    {
        return $user->hasPermissionTo('edit media');
    }

    public function delete(User $user, MediaFile $media): bool
    {
        return $user->hasPermissionTo('delete media');
    }

    public function restore(User $user, MediaFile $media): bool
    {
        return $user->hasPermissionTo('delete media');
    }

    public function forceDelete(User $user, MediaFile $media): bool
    {
        return $user->hasPermissionTo('delete media');
    }
}
