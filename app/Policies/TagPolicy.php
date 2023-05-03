<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->role->permissions->contains('name', 'tags.access');
    }

/*
    public function create(User $user): bool
    {
    }

    public function update(User $user, Tag $tag): bool
    {
    }

    public function delete(User $user, Tag $tag): bool
    {
    }

*/
}
