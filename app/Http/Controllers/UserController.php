<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     */
    //Using model route binding in Parameter  User $user
    public function show(User $user) {

        //get ideas relationship from user model
        $ideas = $user->ideas()->paginate(5);


        return view('users.show', compact('user', 'ideas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) {

        // Do not need this anymore as the action has been done in UpdateUserRequest
        $this->authorize('update', $user);

        $editing = true;
        $ideas = $user->ideas()->paginate(5);

        return view('users.edit', compact('user', 'editing', 'ideas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user) {

        ///Old Method Validation
        // $validated = request()->validate([
        //     'name' => 'required|min:3|max:40',
        //     'bio' => 'nullable|min:1|max:255',
        //     'image' => 'image',
        // ]);

        //This is from Policies/UserPolicy. Old method. New method has been moved to UpdateUserRequest.
        $this->authorize('update', $user);

        //New Method Validation from Requests/UpdateUserRequest
        $validated = $request->validated();

        if($request->has('image')) {
            //storing inside profile folder, public disk  public/profile/imgName
            //After validation, the img will store locally instead of server
            $imagePath = $request->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;

            // To delete old image
            Storage::disk('public')->delete($user->image ?? '');

        }

        $user->update($validated);

        return redirect()->route('profile')->with('success','profile updated successfully!');

    }


    public function profile() {

        return $this->show(auth()->user());
    }

}
