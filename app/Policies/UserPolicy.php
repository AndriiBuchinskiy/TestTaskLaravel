<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->role->permissions->contains('name', 'user.access');
    }
/*
    public function create(User $user): bool
    {
    }

    public function update(User $user, User $model): bool
    {
    }

    public function delete(User $user, User $model): bool
    {
    }
*/

}
