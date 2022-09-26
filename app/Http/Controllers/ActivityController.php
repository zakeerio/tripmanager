<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use DB;
use App\Models\User;
use App\Models\Role;
use App\Models\Trip;
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

        $datefrom = date('Y-m-01');
        $dateto = date('Y-m-d');

        $current_month_crews = Trip::whereBetween('departuredate', [$datefrom, $dateto])->get();
        // $current_month_crews1 = DB::table('trips')->whereBetween('departuredate', [$datefrom, $dateto])->selectRaw('SELECT time(sum(TIMEDIFF( duration, duration )))')->get();
        // dd($current_month_crews);


        $pagetitle = "Dashboard";

        return view('pages/home')->with('pagetitle')->with('current_month_crews', $current_month_crews);
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
    public function rolespermissions(){
        dd(Role::all());
        return view('pages/roles-permissions');
    }
}
