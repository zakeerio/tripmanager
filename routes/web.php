<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\ActivityController;
use App\Http\Middleware\Authenticate;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware(['auth'])->group(function () {
    //


    Route::get('/', function () {
        return view('pages/home');
    });




    Route::get('/crew-members', [CrewController::class, 'index'] )->middleware("auth");

    Route::get('/activity-items', function () {
        return view('pages/activity-items');
    });
    Route::get('/activity-items-create', function () {
        return view('pages/activity-items-create');
    });

    Route::get('/activity-items-edit', function () {
        return view('pages/activity-items-edit');
    });

    Route::get('/all-activities', [ActivityController::class, 'index']);

    Route::get('/all-activities-create', function () {
        return view('pages/all-activities-create');
    });

    Route::get('/all-activities-edit/{id}', [ActivityController::class, 'edit']);

    Route::get('/analytics', function () {
        return view('pages/analytics');
    });

    Route::get('/contact', function () {
        return view('pages/contact');
    });


    Route::get('/crew-members-create', function () {
        return view('pages/crew-members-create');
    });


    Route::get('/crew-members-edit/{id}', [CrewController::class, 'edit']);


    Route::get('/my-account', function () {
        return view('pages/my-account');
    });


    Route::get('/my-activities', function () {
        return view('pages/my-activities');
    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

