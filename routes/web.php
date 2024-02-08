<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|

Notes For Me
MVC - Model View Controller

Controller: Handle Requests
Model: Handle data logic and interactions with database

Laravel Resources Controller
post, delete use store and destroy
*/


Route::get('lang/{lang}', function ($lang) {

    app()->setLocale($lang);
    // save or preserve locale value in the session
    session()->put('locale', $lang);

    return redirect()->route('dashboard');

    //To make sure it got updated, use getLocale
    // app()->getLocale();
})->name('lang');

Route::get('/', [DashboardController::class,'index'])->name('dashboard');

// First argument route name, second argument controller
// ideas/{idea}
///Ignore those three routes
Route::resource('ideas', IdeaController::class)->except(['index', 'create', 'show'])->middleware('auth');

///only creating show route without middleware
Route::resource('ideas', IdeaController::class)->only(['show']);

// ideas/{idea}/comment == ideas.comments
Route::resource('ideas.comments', CommentController::class)->only(['store'])->middleware('auth');

//From user modelS
Route::resource('users', UserController::class)->only('show');

Route::resource('users', UserController::class)->only(['edit', 'update'])->middleware('auth');

Route::get('profile', [UserController::class,'profile'])->middleware('auth')->name('profile');

//Follow Things
Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->middleware('auth')->name('users.follow');

Route::post('users/{user}/unfollow', [FollowerController::class,'unfollow'])->middleware('auth')->name('users.unfollow');

//Like Things
Route::post('ideas/{idea}/like', [IdeaLikeController::class, 'like'])->middleware('auth')->name('ideas.like');

Route::post('ideas/{idea}/unlike', [IdeaLikeController::class,'unlike'])->middleware('auth')->name('ideas.unlike');

//Feed
Route::get('/feed', FeedController::class)->middleware('auth')->name('feed');


Route::get('/terms', function() {
    return view('terms');
})->name('terms');

//Admin Middleware. can is Middleware, admin is name from Gate
Route::get('/admin', [AdminDashboardController::class,'index'])->name('admin.dashboard')->middleware(['auth', 'can:admin']);




///Second Version Old Route Integration
// //prefix
// Route::group(['prefix' => 'ideas/', 'as' => 'ideas.'], function() {

//     Route::get('{idea}', [IdeaController::class,'show'])->name('show');

//     ///Middleware
//     Route::group(['middleware' => ['auth']], function() {

//         Route::post('', [IdeaController::class,'store'])->name('store');

//         Route::get('{idea}/edit', [IdeaController::class,'edit'])->name('edit');

//         Route::put('{idea}', [IdeaController::class,'update'])->name('update');

//         Route::delete('{idea}', [IdeaController::class,'destroy'])->name('destroy');

//         Route::post('{idea}/comment', [CommentController::class,'store'])->name('comments.store');
//     });

// });

///The rest routes are in routes/auth file



///First Version Old Route Integration
// Route::get('/', [DashboardController::class,'index'])->name('dashboard');

// Route::post('/ideas', [IdeaController::class,'store'])->name('ideas.store');

// Route::get('/ideas/{idea}', [IdeaController::class,'show'])->name('ideas.show');

// Route::get('/ideas/{idea}/edit', [IdeaController::class,'edit'])->name('ideas.edit')->middleware('auth');

// Route::put('/ideas/{idea}', [IdeaController::class,'update'])->name('ideas.update')->middleware('auth');

// Route::delete('/ideas/{idea}', [IdeaController::class,'destroy'])->name('ideas.destroy')->middleware('auth');

// Route::post('/ideas/{idea}/comment', [CommentController::class,'store'])->name('ideas.comments.store')->middleware('auth');


///Register
// Route::get('/register', [AuthController::class,'register'])->name('register');

// //Post Request Route for submitting user details
// Route::post('/register', [AuthController::class,'store']);

// //Login
// Route::get('/login', [AuthController::class,'login'])->name('login');

// Route::post('/login', [AuthController::class,'authenticate']);

// Route::post('/logout', [AuthController::class,'logout'])->name('logout');
///Old Route Integration


// In order to create a comment, need
// model (has to be singular)
// controller
// need migration for table
// set up route


