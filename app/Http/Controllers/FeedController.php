<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //get all ideas from peple u follow
        //getting specific col with pluck (), id of all the users u following
        $followingIDs = auth()->user()->followings()->pluck('user_id');


        //Copied From Dashboard Controller
        //old long version
        // $ideas = Idea::orderBy('created_at', 'DESC');

        //short version
        //get ideas from user that posted
        $ideas = Idea::whereIn('user_id', $followingIDs)->latest();

        if (request()->has('search')) {
            // This below code has been moved to Idea model as a scope
            // $ideas = $ideas->where('content', 'like' , '%' . request()->get('search','') . '%');

            //use scope as a method which is search() and pass in argument.  Same as above code line
            $ideas = $ideas->search(request('search', ''));

        }

        return view('dashboard', [
            'ideas' => $ideas->paginate(5)
        ]);
    }
}
