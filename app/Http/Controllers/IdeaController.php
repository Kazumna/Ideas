<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{

    public function show(Idea $idea) {

        //Display single idea
        return view('ideas.show', compact('idea'));
    }

    public function store(CreateIdeaRequest $request) {

        ///Old Method
        // $validated = request()->validate([
        //     "content" => "required|min:5|max:240",
        // ]);

        //New Method Validation from Requests/CreateIdeaRequest
        $validated = $request->validated();

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
        //means checking if the user is the owner of this idea
        // if (auth()->id() !== $idea->user_id) {
        //     abort(404);
        // }

        //Short version of above. idea.delete is from Gate
        // $this->authorize('idea.delete', $idea);

        //Using Policy Method and pass in model class
        $this->authorize('delete', $idea);


        //firsOrFail handle deleting id simutaneously
        // Idea::where('id', $id)->firstOrFail()->delete();

        $idea->delete();

        return redirect()->route('dashboard')->with('success', 'Idea deleted Successfully.');
    }

    public function edit(Idea $idea) {

         //checking if current login user ID is the same as User Id of the Idea
        //  if (auth()->id() !== $idea->user_id) {
        //     abort(404);
        // }

        //Short version of above. idea.edit is from Gate
        // $this->authorize('idea.edit', $idea);

        //Using Policy Method and pass in model class
        $this->authorize('update', $idea);

        $editing = true;

        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(UpdateIdeaRequest $request, Idea $idea) {

         //checking if current login user ID is the same as User Id of the Idea
        // if (auth()->id() !== $idea->user_id) {
        //     abort(404);
        // }

        //Short version of above. idea.delete is from Gate
        // $this->authorize('idea.edit', $idea);

        //Using Policy Method and pass in model class
        $this->authorize('update', $idea);


        //Old Validation Method
        // $validated = request()->validate([
        //     "content" => "required|min:5|max:240",
        // ]);

        //New Method Validation from Requests/UpdateIdeaRequest
        $validated = $request->validated();

        //Short version
        $idea->update($validated);

        //Long version
        // $idea->content = request()->get('content', '');
        // $idea->save();

        return redirect()->route('ideas.show', $idea->id)->with('success', "idea updated successfully.");
    }


}
