<?php

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class IdeaPolicy
{

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Idea $idea): bool
    {
        //edit //update
        //either admin OR user id is the same as the owner of that idea
        // return ($user->is_admin || $user->id === $idea->user_id);

        //short Version
        return ($user->is_admin || $user->is($idea->user));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Idea $idea): bool
    {
        // destroy
        // return ($user->is_admin || $user->id === $idea->user_id);

        //short version
        return ($user->is_admin || $user->is($idea->user));
    }

}
