<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;

class ActivityController extends Controller
{
    //

    public function index(){
        $activities = Activity::limit(1)->get();
        // dd($activities);
        return view('pages/all-activities')->with("activities", $activities);

    }

    public function edit($id) {
            $activity = Activity::findOrFail($id);
            // dd($activity);
            if($activity){
                return view('pages/all-activities-edit')->with("activity", $activity);
            } else {
                abort(404);
            }
    }
}
