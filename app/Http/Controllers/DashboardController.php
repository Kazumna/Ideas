<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index() {

        ///To Preview email before sending out. This is for testing email without using mailtrap third party
        // return new WelcomeEmail(auth()->user());

        //check if there is a search
        // if there is, check the search with our database


        //Use withCount() in Idea Model

        // $ideas = Idea::orderBy('created_at', 'DESC');

        //Method 1
        // if (request()->has('search')) {
        //      //where content like %test%
        //     // This below code has been moved to Idea model as a scope
        //     // $ideas = $ideas->where('content', 'like' , '%' . request()->get('search','') . '%');

        //     //use scope as a method which is search() and pass in argument.  Same as above code line
        //     $ideas = $ideas->search(request('search', ''));

        // }


        //Method 2
        $ideas = Idea::when(request()->has('search'), function($query) {
            $query->search(request('search', ''));
        })->orderBy('created_at', 'DESC')->paginate(5);


        //Counting number of ideas of each user and display the user with most ideas
        //'ideas' is from Relationship in User model
        //ideas_count coming from RelationshipName/UnderLineCount
        ///This code block has been moved to Under AppService Provider as Global Variable
        // $topUsers = User::withCount('ideas')
        //     ->orderBy('ideas_count', 'DESC')
        //     ->limit(5)->get();

        return view("dashboard", [
            "ideas" => $ideas,
        ]);

    }

}
