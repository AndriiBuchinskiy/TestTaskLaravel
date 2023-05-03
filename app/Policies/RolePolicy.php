<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->role->permissions->contains('name', 'roles.access');
    }
/*

    public function create(User $user): bool
    {
    }

    public function update(User $user, Role $role): bool
    {
    }

    public function delete(User $user, Role $role): bool
    {
    }
*/
}
