<?php

use Illuminate\Support\Facades\Route;

// Import Controllers
use App\Http\Controllers\{CrewController, ActivityController, RoleController, ActivityItemController, DocumentCategoryController, DocumentsController, ActivityTypeController};

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

    Route::any('/all-activites-delete/{id}', [ActivityController::class, 'delete'])->name('/all-activites-delete');

    Route::any('/all-activities-available-unavailable/{id}', [ActivityController::class, 'available_unavailable'])->name('all-activities-available-unavailable');


    Route::any('/analytics', [ActivityController::class, 'analytics_view'])->name('analytics');

    Route::any('/analytics-view', [ActivityController::class, 'delete'])->name('analytics-view');

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

    Route::any('/update-crew-account', [CrewController::class, 'update_crew'])->name('update-crew-account');

    Route::any('/delete-crew/{id}', [CrewController::class, 'delete_crew'])->name('delete-crew');
    // Route::get('/delete-crew/{id}', function(){
    //     dd("test");
    // })->name('delete-crew');


    Route::get('/my-account', [CrewController::class, 'myaccount'])->name('my-account');
    Route::post('/update-my-account', [CrewController::class, 'update_my_account'])->name('update-my-account');





    Route::get('/settings', function () {
        return view('pages/settings');
    })->name('settings');

    Route::any('/permissions', [RoleController::class, 'view_roles'])->name('permissions');
    Route::any('/add-role', [RoleController::class, 'add_role'])->name('add-role');




    // Route::get('/activity-items-create', function () {
    //     $pagetitle = "Activity Item Create";

    //     if (Session::has('role') && Session::get('role') == 'crewmember') {
    //         return redirect('/dashboard')->with(['status' => false, 'msg' => 'Access Denied !']);
    //     }

    //     return view('pages/activity-items-create')->with('pagetitle', $pagetitle);
    // })->name('activity-items-create');

    // Route::get('/activity-items-edit', function () {
    //     return view('pages/activity-items-edit');
    // })->name('activity-items-edit');


    Route::any('/activity-items-create', [ActivityItemController::class, 'create'])->name('activity-items-create');

    Route::any('/item-activity-update', [ActivityItemController::class, 'update'])->name('item-activity-update');
    Route::any('/activity-items-edit/{id}', [ActivityItemController::class, 'edit'])->name('activity-items-edit');
    Route::any('/activity-items-delete/{id}', [ActivityItemController::class, 'destroy'])->name('activity-items-delete');
    Route::any('/activity-items', [ActivityItemController::class, 'index'])->name('activity-items');
    Route::any('/item-activity-add', [ActivityItemController::class, 'store'])->name('item-activity-add');






    Route::any('/create-document-category', [DocumentCategoryController::class, 'index'])->name('/create-document-category');
    Route::any('/document-category-delete/{id}', [DocumentCategoryController::class, 'destroy'])->name('document-category-delete');

    Route::any('/create-document-add', [DocumentCategoryController::class, 'store'])->name('/create-document-add');
    Route::any('/create-document-delete/{id}', [DocumentCategoryController::class, 'destroy'])->name('/create-document-delete');
    Route::any('/create-document-edit/{id}', [DocumentCategoryController::class, 'edit'])->name('/create-document-edit');
    Route::any('/create-document-update', [DocumentCategoryController::class, 'update'])->name('/create-document-update');


    Route::get('/documents', [DocumentsController::class, 'index'])->name('/documents');
    Route::any('/documents-save/{id}', [DocumentsController::class, 'store'])->name('/documents-save');
    Route::any('/documents-download/{name}', [DocumentsController::class, 'download'])->name('/documents-download');
    Route::any('/documents-delete/{id}', [DocumentsController::class, 'destroy'])->name('/documents-delete');

    Route::any('/validate-crewcode', [ActivityController::class, 'validate_crewcode'])->name('/validate-crewcode');
    Route::any('/validate-email', [ActivityController::class, 'validate_email'])->name('/validate-email');
    Route::any('/validate-username', [ActivityController::class, 'validate_username'])->name('/validate-username');


    Route::any('/activity-types', [ActivityTypeController::class, 'index'])->name('/activity-types');
    Route::any('/activity-type-add', [ActivityTypeController::class, 'store'])->name('/activity-type-add');
    Route::any('/activity-type-delete/{id}', [ActivityTypeController::class, 'destroy'])->name('/activity-type-delete');
    Route::any('/activity-type-edit/{id}', [ActivityTypeController::class, 'edit'])->name('/activity-type-edit');
    Route::any('/activity-type-update', [ActivityTypeController::class, 'update'])->name('/activity-type-update');

    // Route::get('/permissions', function () {
    //     return view('pages/roles-permissions');
    // })->name('permissions');


});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


 // Clear cache using reoptimized class
 Route::get('/optimize-clear', function() {
    \Artisan::call('optimize:clear');
    return 'All cache cleared';
});
