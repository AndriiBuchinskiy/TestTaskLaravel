<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->role->permissions->contains('name', 'categories.access');
    }



    public function create(User $user): bool
    {
        return $user->role->permissions->contains('name', 'categories.create');
    }

    public function update(User $user, Category $category): bool
    {
        return $user->role->permissions->contains('name', 'categories.update');
    }

    public function delete(User $user, Category $category): bool
    {
        return $user->role->permissions->contains('name', 'categories.delete');
    }


}
