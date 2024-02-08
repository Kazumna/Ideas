<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'guest'], function () {

    Route::get('/register', [AuthController::class,'register'])->name('register');

    //Post Request Route for submitting user details
    Route::post('/register', [AuthController::class,'store']);

    //Login
    Route::get('/login', [AuthController::class,'login'])->name('login');

    Route::post('/login', [AuthController::class,'authenticate']);

});

    Route::get('/logout', [AuthController::class,'logout'])->middleware('auth')->name('logout');

    Route::post('/logout', [AuthController::class,'logout'])->middleware('auth')->name('logout');
