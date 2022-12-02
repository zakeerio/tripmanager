<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use DB;
use App\Models\User;
use App\Models\Role;
use App\Models\Trip;
use App\Models\Crew;
use Session;
use Illuminate\Support\Facades\Hash;

class ActivityController extends Controller
{
    //

    protected $check1;
    protected $check2;
    protected $check3;
    protected $tripnumber;

    public function index()
    {

        $pagetitle = "All Activities";
        $trips = Trip::paginate(250);

       // dd($trips);
        return view('pages/all-activities')->with("trips", $trips)->with('tripcrews')->with('pagetitle', $pagetitle);
    }


    public function Access()
    {

        if (Session::get('role') == 'crewmember') {

            return true;
        }
    }
    public function dashboard(request $request)
    {

        // UPDATE old password into new laravel password

        $upcoming_activites = DB::table('trips')
            ->join('tripcrews', 'trips.id', '=', 'tripcrews.tripnumber')
            ->where('tripcrews.crewcode', '=', SESSION::get('initials'))
            ->where('tripcrews.confirmed', '=', 'Y')
            ->where('trips.departuredate', '>=', date('Y-m-d'))
            ->orderBy('departuredate')
            ->select('trips.*')->get();

            
        if (!empty($upcoming_activites)) {
            $upcoming_activites = $upcoming_activites;
        } else {
            $upcoming_activites = [];
        }

       
        // dd(count($upcoming_activites));

        updateuseroldpasswordtonew($request);

        $pagetitle = "Dashboard";

        $datefrom = date('Y-m-01');
        $dateto = date('Y-m-31');

        $month_logins = DB::table('login_history')->whereBetween('created_at', [date('Y-m-01'), date('Y-m-31')])->where('user_id', Session::get('user_id'))->select(DB::raw('COUNT(created_at) as logins'))->get();

        // dd($month_logins[0]->logins);

        if (isset($month_logins[0]->logins)) {
            $month_logins = $month_logins[0]->logins;
        } else {
            $month_logins = 0;
        }

        $year_logins = DB::table('login_history')->whereBetween('created_at', [date('Y-01-01'), date('Y-12-30')])->where('user_id', Session::get('user_id'))->select(DB::raw('COUNT(created_at) as logins'))->get();

        //dd($year_logins);

        if (isset($year_logins[0]->logins)) {
            $year_logins = $year_logins[0]->logins;
        } else {
            $year_logins = 0;
        }

        $current_month_crews = Trip::whereBetween('departuredate', [$datefrom, $dateto])->get();

        $trips = Trip::limit(3)->get();
        // dd($trips);


        // $current_month_crews1 = DB::table('trips')->whereBetween('departuredate', [$datefrom, $dateto])->selectRaw('SELECT time(sum(TIMEDIFF( duration, duration )))')->get();
        // dd($current_month_crews);

        return view('pages/home')->with('pagetitle', $pagetitle)->with('current_month_crews', $current_month_crews)->with("trips", $trips)->with('tripcrews')->with('month_logins', $month_logins)->with('year_logins', $year_logins)->with('upcoming_activites', $upcoming_activites);
    }


    public function add(Request $request)
    {
        // dd($request->all());


        try {

            DB::transaction(function () use ($request) {

                $this->tripnumber = DB::table('trips')->insertGetId([

                    'boatname'                 => $request->boatname,
                    'departuredate'            => $request->departuredate,
                    'departuretime'            => $request->departuretime,
                    'duration'                 => $request->duration,
                    'destination'              => $request->destination,
                    'crewneeded'               => $request->crewneeded,
                    'crewnotes'                => $request->crewnotes,
                    'balance'                  => $request->tripbalance,
                    'cost'                     => $request->tripcost,
                    'passengers'               => $request->passengers,
                    'sent_notice'              => 'Y'
                ]);


                if (!empty($request->unavailable)) {

                    for ($i = 0; $i < count($request->unavailable); $i++) {

                        // echo $request->skipper[$i];
                        if (isset($request->unavailable[$i])) {
                            $trim = $request->unavailable[$i];
                            $initials = explode(':', $trim);
                            $crewcode = $initials[0];

                            $this->check1 = DB::table('tripcrews')->insert([
                                'recordnumber'              => rand(10, 10000),
                                'tripnumber'                => $this->tripnumber,
                                'crewcode'                  => $crewcode,
                                'isskipper'                 => 'Y'
                            ]);
                        }
                    }
                }

                // dd($check1);
                if (!empty($request->available)) {

                    for ($i = 0; $i < count($request->available); $i++) {
                        if (isset($request->available[$i])) {
                            $trim = $request->available[$i];
                            $initials = explode(':', $trim);
                            $crewcode = $initials[0];
                            $this->check2 =   DB::table('tripcrews')->insert([
                                'recordnumber'              => rand(10, 10000),
                                'tripnumber'                => $this->tripnumber,
                                'crewcode'                  => $crewcode,
                                'available'                 => 'Y'
                            ]);
                        }
                    }
                }



                if (!empty($request->confiremd)) {

                    for ($i = 0; $i < count($request->confiremd); $i++) {
                        if (isset($request->confiremd[$i])) {
                            $trim = $request->confiremd[$i];
                            $initials = explode(':', $trim);
                            $crewcode = $initials[0];
                            $this->check3 = DB::table('tripcrews')->insert([
                                'recordnumber'              => rand(10, 10000),
                                'tripnumber'                => $this->tripnumber,
                                'crewcode'                  => $crewcode,
                                'confirmed'                 => 'Y'
                            ]);
                        }
                    }
                }
            });

            if (isset($this->tripnumber) && $this->check1 && $this->check2 && $this->check3) {
                //dd($request->all());
                return redirect('/all-activities-create')->with(['status' => true, 'msg' => 'Success! Activity Created']);
            } else {
                dd($request->all());
                return redirect('/all-activities-create')->with(['status' => false, 'msg' => 'Error! Activity Failed']);
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function view($id,$status)
    {
      
        $pagetitle = "Edit Activity";
        $activity = Trip::findOrFail($id);
        // dd($activity);
        if ($activity) {
            return view('pages/all-activities-view')->with("activity", $activity)->with('tripcrews')->with('pagetitle', $pagetitle)->with('status',$status);
        } else {
            abort(403);
        }
    }

    public function edit($id,$status)
    {

        if ($this->Access()) {
            return redirect('/dashboard')->with(['status' => false, 'msg' => 'Access Denied !']);
        }

        $pagetitle = "Edit Activity";
        $activity = Trip::findOrFail($id);
        // sdd($activity);
        if ($activity) {
            return view('pages/all-activities-edit')->with("activity", $activity)->with('tripcrews')->with('pagetitle', $pagetitle)->with('status',$status);
        } else {
            abort(403);
        }
    }

    public function update(Request $request)
    {
        // dd($request->all());
        
        if ($this->Access()) {

            return redirect('/dashboard')->with(['status' => false, 'msg' => 'Access Denied !']);
        }
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

        if ($this->Access()) {
            return redirect('/dashboard')->with(['status' => false, 'msg' => 'Access Denied !']);
        }

        $delete = Trip::whereId($id)->delete();

        if ($delete) {
            return redirect('/all-activities')->with(['status' => true, 'msg' => 'Success! Activity Deleted']);
        } else {
            return redirect('/all-activities')->with(['status' => false, 'msg' => 'Error! Activity Delete Failed']);
        }
    }

    public function myactivities()
    {

        //dd(Session::get('initials'));
        $pagetitle = "My Activities";

        // $trips = Trip::paginate(50);

        $trips = DB::table('trips')
            ->join('tripcrews', 'tripnumber', '=', 'trips.id')
            ->select('tripcrews.*', 'trips.*')
            ->where('crewcode', '=', Session::get('initials'))
            ->where('available', '=', 'Y')
            ->paginate(50);

        // dd($trips);


        // $res=Crew::where(['initials' => 'JY'])->first()->toArray();

        // dd($res['fullname']);

        return view('pages/my-activities')->with("trips", $trips)->with('tripcrews')->with('pagetitle', $pagetitle);
    }


    public function available_unavailable($trip_id)
    {
        $user_id = Session::get('user_id');
        $user_initials =  Session::get('initials');

        //  dd($user_initials);
        $check = DB::table('tripcrews')->where('tripnumber', $trip_id)->where('crewcode', $user_initials)->first();


        if (!empty($check) && $check->available != 'Y') {

            $added = DB::table('tripcrews')->where('tripnumber', $trip_id)->where('crewcode', $user_initials)->update(['available' => 'Y']);
            if ($added) {
                $flag = 'added';
            }
        } else {
            $removed = DB::table('tripcrews')->where('tripnumber', $trip_id)->where('crewcode', $user_initials)->update(['available' => NULL]);

            if ($removed) {
                $flag = 'removed';
            }
        }

        // dd($check);

        if ($flag == 'removed') {
            return redirect('all-activities')->with(['status' => true, 'msg' => 'Success ! Removed Successfully']);
        } else if ($flag == 'added') {
            return redirect('all-activities')->with(['status' => true, 'msg' => 'Success ! Added Successfully']);
        }
    }

    public function rolespermissions()
    {
        dd(Role::all());
        return view('pages/roles-permissions');
    }
}
