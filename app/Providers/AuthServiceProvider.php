<?php

namespace App\Providers;

//use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicy;
use App\Policies\RolePolicy;
use App\Policies\SubtaskPolicy;
use App\Policies\TagPolicy;
use App\Policies\UserPolicy;
use App\Subtask;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Comment::class => CommentPolicy::class,
        Post::class => PostPolicy::class,
        Role::class => RolePolicy::class,
        Category::class => CategoryPolicy::class,
        Tag::class => TagPolicy::class,
        User::class => UserPolicy::class,
        Subtask::class => SubtaskPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
       $this->registerPolicies();
    }
}
