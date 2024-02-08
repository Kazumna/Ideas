<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        ///To Check if logged in User and View User Id are the
        //The ID of the login user matches the ID of the Model that we want to update
        // return $user->id === $model->id;

        // short version
        return ($user->is_admin || $user->is($model));
    }

}
