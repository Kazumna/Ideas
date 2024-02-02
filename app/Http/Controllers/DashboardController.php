<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index() {
        //check if there is a search
        // if there is, check the search with our database

        $ideas = Idea::orderBy('created_at', 'DESC');

        //where content like %test%
        if(request()->has('search')) {
            $ideas = $ideas->where('content', 'like', '%' . request()->get('search', '') . '%');
        }


        return view("dashboard", [
            "ideas" => $ideas->paginate(5),
        ]);

    }

}
