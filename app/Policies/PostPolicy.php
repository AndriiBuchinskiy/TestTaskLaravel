<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;


class PostPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function update(User $user, Post $post): bool
    {

        if(!$user->role->permissions->contains('name', 'post.update'))
        {
            return false;
        }
        else return $user->id === $post->user_id;
    }
    /*
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */

    public function view(User $user): bool
    {
       return $user->role->permissions->contains('name', 'post.access');
    }

    /**
     * Determine whether the user can create models.
     */

    public function create(User $user)
    {
        return $user->role->permissions->contains('name', 'post.create');
    }

    /**
     * Determine whether the user can update the model.
     */

    /**
     * Determine whether the user can delete the model.
     */

    public function delete(User $user, Post $post): bool
    {

        if(!$user->role->permissions->contains('name', 'post.delete')){
            return false;
        } else
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    /*
    public function restore(User $user, Post $post): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    /*
    public function forceDelete(User $user, Post $post): bool
    {
        //
    }
    */
}
