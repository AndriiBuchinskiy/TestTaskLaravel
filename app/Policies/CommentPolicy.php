<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;
    public function create(User $user): bool
    {

        return $user->role->permissions->contains('name', 'comment.create');
    }

    public function delete(User $user, Comment $comment): bool
    {
        if($user->role->permissions->contains('name', 'comment.delete')=== false)
        {
            return false;
        }
        return $user->id === $comment->user_id;
    }

    public function update(User $user, Comment $comment): bool
    {

        if($user->role->permissions->contains('name', 'comment.update')=== false)
        {
            return false;
        }
        return $user->id === $comment->user_id;
    }
/*
    public function viewAny(User $user): bool
    {
        
    }

    public function view(User $user, Comment $comment): bool
    {

    }
    public function restore(User $user, Comment $comment): bool
    {
    }

    public function forceDelete(User $user, Comment $comment): bool
    {
    }
  */
}
