<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class ActivityController extends Controller
{
    //

    public function index(){
        $activities = Activity::limit(1)->get();
        // dd($activities);
        return view('pages/all-activities')->with("activities", $activities);

    }

    public function dashboard(request $request){

        // UPDATE old password into new laravel password

        updateuseroldpasswordtonew($request);
        $pagetitle = "Dashboard";

        return view('pages/home')->with('pagetitle');
    }

    public function edit($id) {
            $pagetitle = "Edit Activity";
            $activity = Activity::findOrFail($id);
            dd($activity);
            if($activity){
                return view('pages/all-activities-edit')->with("activity",'pagetitle');
            } else {
                abort(403);
            }
    }
}
