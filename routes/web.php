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

Auth::routes();


Route::group(['middleware'=>'auth'], function () {

    Route::get('/dashboard', [ActivityController::class, 'dashboard'])->name('dashboard');

    // Route::get('/dashboard', function () {
    //     return view('pages/home');
    // })->name('dashboard');

    Route::get('/activity-items', function () {
        return view('pages/activity-items');
    })->name('activity-items');
    Route::get('/activity-items-create', function () {
        return view('pages/activity-items-create');
    })->name('activity-items-create');

    Route::get('/activity-items-edit', function () {
        return view('pages/activity-items-edit');
    })->name('activity-items-edit');

    Route::get('/all-activities', [ActivityController::class, 'index'])->name('all-activities');

    Route::get('/all-activities-create', function () {
        return view('pages/all-activities-create');
    })->name('all-activities-create');

    Route::get('/all-activities-edit/{id}', [ActivityController::class, 'edit'])->name('all-activities-edit');

    Route::get('/analytics', function () {
        return view('pages/analytics');
    })->name('analytics');

    Route::get('/contact', function () {
        return view('pages/contact');
    })->name('contact');


    Route::get('/crew-members', [CrewController::class, 'index'] )->name('crew-members');

    Route::get('/crew-members-create', function () {
        return view('pages/crew-members-create');
    })->name('crew-members-create');

    Route::get('/crew-members-edit/{id}', [CrewController::class, 'edit'])->name('crew-members-edit');


    Route::get('/my-account', [CrewController::class, 'myaccount'] )->name('my-account');
    Route::post('/update-account', [CrewController::class, 'update_crew'] )->name('update-account');


    Route::get('/my-activities', function () {
        return view('pages/my-activities');
    })->name('my-activities');

    Route::get('/documents', function () {
        return view('pages/documents');
    })->name('documents');

    Route::get('/upload-document', function () {
        return view('pages/upload-document');
    })->name('upload-document');


    Route::get('/settings', function () {
        return view('pages/settings');
    })->name('settings');


});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


