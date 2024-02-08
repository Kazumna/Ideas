<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Idea;
use App\Models\User;
use App\Policies\IdeaPermissions;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Defining custom name policy file
        // Idea::class => IdeaPermissions::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //Gate is either permission or simple role
        // Gate => Permission | simple Role

        //This is Role
        Gate::define('admin', function(User $user) : bool {
            return (bool) $user->is_admin;
        });


        // //These are Permissions
        // Gate::define('idea.delete', function(User $user, Idea $idea) : bool {
        //     // only the admin OR the owner has ability to delete
        //     return ((bool) $user->is_admin || $user->id === $idea->user_id);
        // });

        // Gate::define('idea.edit', function(User $user, Idea $idea) : bool {
        //      // only the admin OR the owner has ability to edit
        //     return ((bool) $user->is_admin || $user->id === $idea->user_id);
        // });

    }
}
