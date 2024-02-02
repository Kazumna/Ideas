<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{

    public function show(Idea $idea) {

        //Display single idea
        return view('ideas.show', compact('idea'));
    }

    public function store() {

        $validated = request()->validate([
            "content" => "required|min:5|max:240",
        ]);

        //store the Id of the current login user whenever create new idea
        //setting current login user and store in database
        $validated['user_id'] = auth()->id();


        //Long Version
        // $idea = Idea::create(
        //     [
        //     "content"=> request()->get("content", ''),
        // ]);

        //Short Version
        Idea::create($validated);

        // $idea->save();

    return redirect()->route('dashboard')->with('success', 'Idea created Successfully.');
    }

    public function destroy(Idea $idea) {

        //checking if current login user ID is the same as User Id of the Idea
        if (auth()->id() !== $idea->user_id) {
            abort(404);
        }


        //firsOrFail handle deleting id simutaneously
        // Idea::where('id', $id)->firstOrFail()->delete();

        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Idea deleted Successfully.');
    }

    public function edit(Idea $idea) {

         //checking if current login user ID is the same as User Id of the Idea
         if (auth()->id() !== $idea->user_id) {
            abort(404);
        }

        $editing = true;

        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea) {

         //checking if current login user ID is the same as User Id of the Idea
         if (auth()->id() !== $idea->user_id) {
            abort(404);
        }

        $validated = request()->validate([
            "content" => "required|min:5|max:240",
        ]);

        //Short version
        $idea->update($validated);

        //Long version
        // $idea->content = request()->get('content', '');
        // $idea->save();

        return redirect()->route('ideas.show', $idea->id)->with('success', "idea updated successfully.");
    }


}
