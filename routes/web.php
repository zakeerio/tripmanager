<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ActivityItemController;
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




Route::group(['middleware' => 'auth'], function () {
    Route::get('/roles', [ActivityController::class, 'rolespermissions'])->name('roles');
    Route::get('/dashboard', [ActivityController::class, 'dashboard'])->name('dashboard');
    Route::get('/', [ActivityController::class, 'dashboard'])->name('dashboard');

    // Route::get('/dashboard', function () {
    //     return view('pages/home');
    // })->name('dashboard');

  

    Route::get('/all-activities', [ActivityController::class, 'index'])->name('all-activities');

    Route::get('/my-activities', [ActivityController::class, 'myactivities'])->name('my-activities');

    Route::get('/all-activities-create', function () {
        $pagetitle = "Create Activity";
        return view('pages/all-activities-create')->with('pagetitle', $pagetitle);
    })->name('all-activities-create');


    Route::post('/all-activites-add', [ActivityController::class, 'add'])->name('all-activites-add');

    Route::get('/all-activities-edit/{id}/{status}', [ActivityController::class, 'edit'])->name('all-activities-edit');

    Route::any('/all-activities-view/{id}/{status}', [ActivityController::class, 'view'])->name('all-activities-view');

    Route::any('/all-activites-update', [ActivityController::class, 'update'])->name('all-activites-update');

    Route::any('/all-activites-delete/{id}', [ActivityController::class, 'delete'])->name('all-activites-delete');

    Route::any('/all-activities-available-unavailable/{id}', [ActivityController::class, 'available_unavailable'])->name('all-activities-available-unavailable');


    Route::get('/analytics', function () {
        $pagetitle = "Analytics";

        return view('pages/analytics')->with('pagetitle', $pagetitle);
    })->name('analytics');

    Route::get('/contact', function () {
        $pagetitle = "Contact";

        return view('pages/contact')->with('pagetitle', $pagetitle);
    })->name('contact');


    Route::get('/crew-members', [CrewController::class, 'index'])->name('crew-members');

    Route::get('/crew-members-create', function () {
        $pagetitle = "Create Crew Member";
        return view('pages/crew-members-create')->with("pagetitle", $pagetitle);
    })->name('crew-members-create');


    Route::post('/crew-member-save', [CrewController::class, 'save_crew'])->name('savecrew');


    Route::get('/crew-members-edit/{id}', [CrewController::class, 'edit'])->name('crew-members-edit');

    Route::any('/update-account', [CrewController::class, 'update_crew'])->name('update-account');

    Route::any('/delete-crew/{id}', [CrewController::class, 'delete_crew'])->name('delete-crew');


    Route::get('/my-account', [CrewController::class, 'myaccount'])->name('my-account');
    Route::post('/update-my-account', [CrewController::class, 'update_my_account'])->name('update-my-account');



    Route::get('/documents', function () {
        return view('pages/documents');
    })->name('documents');

    Route::get('/upload-document', function () {
        return view('pages/upload-document');
    })->name('upload-document');


    Route::get('/settings', function () {
        return view('pages/settings');
    })->name('settings');

    Route::any('/permissions', [RoleController::class, 'view_roles'])->name('permissions');
    Route::any('/add-role', [RoleController::class, 'add_role'])->name('add-role');



  
    Route::get('/activity-items-create', function () {
        $pagetitle = "Activity Item Create";

        if (Session::has('role') && Session::get('role') == 'crewmember') {
            return redirect('/dashboard')->with(['status' => false, 'msg' => 'Access Denied !']);
        }

        return view('pages/activity-items-create')->with('pagetitle', $pagetitle);
        
    })->name('activity-items-create');

    Route::get('/activity-items-edit', function () {
        return view('pages/activity-items-edit');
    })->name('activity-items-edit');


    
    Route::any('/item-activity-update', [ActivityItemController::class, 'update'])->name('item-activity-update');
    Route::any('/activity-items-edit/{id}', [ActivityItemController::class, 'edit'])->name('activity-items-edit');
    Route::any('/activity-items', [ActivityItemController::class, 'index'])->name('activity-items');
    Route::any('/item-activity-add', [ActivityItemController::class, 'store'])->name('item-activity-add');

    // Route::get('/permissions', function () {
    //     return view('pages/roles-permissions');
    // })->name('permissions');


});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
