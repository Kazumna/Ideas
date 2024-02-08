<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index() {

        //getting Gate things from Providers/AuthServiceProvider
        // if (!Gate::allows('admin')) {
        //     abort(403);
        // }

        //short version
        // $this->authorize('admin');

        // Log::info('inside admin dashboard controller');
        return view('admin.dashboard');
    }
}
