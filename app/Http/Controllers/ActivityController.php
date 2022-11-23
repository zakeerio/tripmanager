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

    public function index()
    {
        $pagetitle = "All Activities";
        $trips = Trip::paginate(250);
        // dd($trips);
        return view('pages/all-activities')->with("trips", $trips)->with('tripcrews')->with('pagetitle', $pagetitle);
    }

    public function dashboard(request $request)
    {

        // UPDATE old password into new laravel password

        updateuseroldpasswordtonew($request);

        $pagetitle = "Dashboard";

        $datefrom = date('Y-m-01');
        $dateto = date('Y-m-d');
        $current_month_crews = Trip::whereBetween('departuredate', [$datefrom, $dateto])->get();

        $trips = Trip::limit(3)->get();
        // dd($trips);


        // $current_month_crews1 = DB::table('trips')->whereBetween('departuredate', [$datefrom, $dateto])->selectRaw('SELECT time(sum(TIMEDIFF( duration, duration )))')->get();
        // dd($current_month_crews);

        return view('pages/home')->with('pagetitle', $pagetitle)->with('current_month_crews', $current_month_crews)->with("trips", $trips)->with('tripcrews');
    }

    public function edit($id)
    {
        $pagetitle = "Edit Activity";
        $activity = Trip::findOrFail($id);
        // dd($activity);
        if ($activity) {
            return view('pages/all-activities-edit')->with("activity", $activity)->with('tripcrews')->with('pagetitle', $pagetitle);
        } else {
            abort(403);
        }
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $activityArray = [

            'departuredate'  => $request->departuredate,
            'departuretime'  => $request->departuretime,
            'crewnotes'      => $request->NotesCrew,
            'boatname'       => $request->boatname,
            'destination'    => $request->destination,
            'duration'       => $request->duration,
            //'archived'     =>
            'crewneeded'     => $request->crewneeded,
            'cost'           => $request->tripcost,
            'balance'        => $request->tripbalance,
            'passengers'     => $request->passengers

        ];

        $update =  Trip::whereId($request->id)->update($activityArray);

        // dd($update);


        if ($update) {
            $messages[] =  "User Data Updated Successfully";

            return redirect('/all-activities')->with(['status' => true, 'msg' => 'Success ! Activty Updated']);
        } else {
            return redirect('/all-activities')->with(['status' => false, 'msg' => 'Error ! Actity Update Failed']);
        }
    }

    function delete($id)
    {

        $delete = Trip::whereId($id)->delete();

        if ($delete) {
            return redirect('/all-activities')->with(['status' => true, 'msg' => 'Success! Activity Deleted']);
        } else {
            return redirect('/all-activities')->with(['status' => false, 'msg' => 'Error! Activity Delete Failed']);
        }
    }

    public function myactivities()
    {
        $pagetitle = "My Activities";

        $trips = Trip::paginate(50);
        // dd($trips);
        return view('pages/my-activities')->with("trips", $trips)->with('tripcrews')->with('pagetitle', $pagetitle);
    }

    public function rolespermissions()
    {
        dd(Role::all());
        return view('pages/roles-permissions');
    }
}
