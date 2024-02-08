<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{

    //this will be the user we are going to follow User $user
    public function follow(User $user) {
        //follower will be logged in user auth()->user()
        $follower = auth()->user();

        //add new record to Database using "attach" and pass in user model
        $follower->followings()->attach($user);

        return redirect()->route('users.show', $user->id)->with('success', "followed successfully!");

    }

    public function unfollow(User $user) {

        $follower = auth()->user();

        $follower->followings()->detach($user);

        return redirect()->route('users.show', $user->id)->with('success', "unfollowed successfully!");
    }
}
