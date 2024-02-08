<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(CreateCommentRequest $request, Idea $idea) {

        ///Long Version
        // $comment = new Comment();
        // $comment->idea_id = $idea->id;
        // //store the Id of the current login user whenever create new idea
        // $comment->user_id = auth()->id();
        // $comment->content = request()->get('content');
        // $comment->save();


        ///Old Validation Method
        // $validated = request()->validate([
        //     'content' => 'required|min:3|max:240'
        // ]);

        //New Version using Requests thing
        $validated = $request->validated();

        ///Short Version
        $validated['user_id'] = auth()->id();
        $validated['idea_id'] = $idea->id;

        Comment::create($validated);

        return redirect()->route('ideas.show', $idea->id)->with('success', "Comment posted successfully!");

    }
}
