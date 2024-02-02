<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Idea $idea) {

        ///Long Version
        $comment = new Comment();
        $comment->idea_id = $idea->id;
        //store the Id of the current login user whenever create new idea
        $comment->user_id = auth()->id();
        $comment->content = request()->get('content');
        $comment->save();

        return redirect()->route('ideas.show', $idea->id)->with('success', "Comment posted successfully!");

    }
}
