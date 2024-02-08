<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaLikeController extends Controller
{
    public function like(Idea $idea) {
        // the person(loggedin user) likes,
        $liker = auth()->user();

        // many to many relationship, get the relationship likes() and call idea id
        $liker->likes()->attach($idea);

        //should use livewire without loading the page
        return redirect()->route('dashboard')->with('success', "Liked successfully!");

    }

    public function unlike(Idea $idea) {
        $liker = auth()->user();

        $liker->likes()->detach($idea);

        return redirect()->route('dashboard')->with('success', "Unliked successfully!");

    }
}
