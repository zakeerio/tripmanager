<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use DB;
use App\Models\User;
use App\Models\Role;
use App\Models\Trip;
use App\Models\Crew;
use App\Models\Tripcrew;
use App\Models\ActivityItem;

use DateTime;
use Session;
use URL;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isEmpty;
class ActivityController extends Controller
{
    //

    protected $check1;
    protected $check2;
    protected $check3;
    protected $tripnumber;


    public function index(Request $request)
    {

        $pagetitle = "All Activities";






        if(isset($request->filter) && $request->filter !="" ){
            $activitycheck = ActivityItem::where('activityname',$request->filter)->count();

            if($activitycheck > 0){
                if (Session::get('role') == 'crewmember') {
                    $trips = Trip::orderBy('departuredate', 'DESC')->where('archived', "=",  NULL)->orWhere('archived', "=",  "")->where('boatname',$request->filter)->paginate(50);
                } else {

                    if(isset($request->completed) && $request->completed == 'hide' ){
                        $trips = Trip::orderBy('departuredate', 'DESC')
                        ->where('archived', "!=",  'Y')
                        ->orWhere('archived', "=",  NULL)
                        ->where('boatname',$request->filter)->paginate(50);
                    } else {
                        $trips = Trip::orderBy('departuredate', 'DESC')->where('boatname',$request->filter)->paginate(50);
                    }
                }
            } else {
                if (Session::get('role') == 'crewmember') {

                    $trips = Trip::orderBy('departuredate', 'DESC')->where('archived', "=", NULL)->orWhere('archived', "=",  "")->paginate(50);
                } else {

                    if(isset($request->completed) && $request->completed == 'hide' ){
                        // $trips = Trip::orderBy('departuredate', 'DESC')->paginate(50);
                        $trips = Trip::orderBy('departuredate', 'DESC')
                        ->w->where('archived', "!=",  'Y')
                        ->orWhere('archived', "=",  NULL)
                        ->paginate(50);
                    } else {
                        $trips = Trip::orderBy('departuredate', 'DESC')->paginate(50);

                    }

                    // $trips = Trip::orderBy('departuredate', 'DESC')->paginate(50);

                }
            }
        } else {
            if (Session::get('role') == 'crewmember') {

                $trips = Trip::orderBy('departuredate', 'DESC')->where('archived', "=", NULL)->orWhere('archived', "=", '')->paginate(50);
                // $trips = Trip::orderBy('departuredate', 'DESC')->where('archived', "=", NULL)->toSql();
                // dd($trips);


            } else {

                if(isset($request->completed) && $request->completed == 'hide' ){
                    // $trips = Trip::orderBy('departuredate', 'DESC')->paginate(50);
                    $trips = Trip::orderBy('departuredate', 'DESC')
                    ->where('archived', "!=",  'Y')
                    ->orWhere('archived', "=",  NULL)
                    ->paginate(50);
                    // ->toSql();
                    // dd($trips);
                } else {
                    $trips = Trip::orderBy('departuredate', 'DESC')->paginate(50);

                }

            }
        }


        $activities_filter = ActivityItem::orderBy('id', 'DESC')->get();

        // dd($trips);
        return view('pages/all-activities')->with("trips", $trips)->with('tripcrews')->with('pagetitle', $pagetitle)->with('activities_filter',$activities_filter);
    }


    public function Access()
    {

        if (Session::get('role') == 'crewmember') {
            return true;
        }
    }

    public function analytics_view(Request $request)
    {
        $crew = DB::table('crews')->get();

        if(isset($request->filter) && $request->filter !="" ){

            $crew = DB::table('crews')
            ->join('users', 'users.id', 'crews.user_id')
            ->where('users.role_id', $request->filter)
            ->select('crews.*')
            ->get();

        }

        try {
            $pagetitle = "Analytics";

            // $crew = DB::table('crews')->get();

            // dd($crew);
            // print_r($crew);
            // exit;
            $i = 0;
            $user = array();

            $jan_hours = 0;
            $fab_hours = 0;
            $march_hours = 0;
            $april_hours = 0;
            $may_hours = 0;
            $june_hours = 0;
            $july_hours = 0;
            $aguest_hours = 0;
            $sept_hours = 0;
            $oct_hours = 0;
            $nov_hours = 0;
            $des_hours = 0;

            foreach ($crew as $cr) {

                //  echo $cr->initials;
                if (isset($cr->initials)) {

                    $tripcrews = DB::table('tripcrews')
                    ->join('trips','trips.id','tripcrews.tripnumber')
                    ->select('tripcrews.*')
                    ->where('crewcode', $cr->initials)
                    ->whereBetween('departuredate',[date('Y-01-01'), date('Y-12-t')])
                    ->get();

                    // dd($tripcrews->count());

                    if ($tripcrews->isNotEmpty()) {
                        foreach ($tripcrews as $ts) {

                            // dd($ts);
                            $trip = DB::table('trips')->where('id', $ts->tripnumber)->get();

                            if(isset($trip[0]->departuredate)) {
                                $exp = explode('-', $trip[0]->departuredate);
                                $monthNum  = $exp[1];
                                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                                $monthName = $dateObj->format('F');
                                // echo  $cr->initials." __ ".$trip[0]->id." -- ".$monthName . "<br>";

                                // echo $trip[0]->departuredate;

                                if (isset($trip[0]->duration) && str_contains($trip[0]->duration, ':')) {
                                $hours = 0;

                                    $duration_val = explode(':', $trip[0]->duration);
                                    $clock = intVal($duration_val[0]);


                                    $minutes = ($duration_val[1] / 10);

                                    $hours = $clock . "." . $minutes;

                                // echo  $cr->initials." __ ".$trip[0]->id." -- ".$monthName ." Hours:  " .$hours."<br>";



                                if ($monthName == 'January') {
                                    $jan_hours += $hours;
                                } else {
                                    $jan_hours += 0;
                                }

                                if ($monthName == 'February') {
                                    $fab_hours += $hours;
                                } else {
                                    $fab_hours += 0;
                                }

                                if ($monthName == 'March') {
                                    $march_hours += $hours;
                                } else {
                                    $march_hours += 0;
                                }


                                if ($monthName == 'April') {
                                    $april_hours += $hours;
                                } else {
                                    $april_hours += 0;
                                }

                                if ($monthName == 'May') {

                                    $may_hours  += $hours;
                                } else {
                                    $june_hours += 0;
                                }

                                if ($monthName == 'June') {
                                    $june_hours += $hours;
                                } else {
                                    $june_hours += 0;
                                }

                                if ($monthName == 'July') {
                                    $july_hours += $hours;
                                    $july_hours = $july_hours;
                                } else {
                                    $july_hours += 0;
                                }


                                if ($monthName == 'August') {
                                    $aguest_hours += $hours;
                                } else {
                                    $aguest_hours += 0;
                                }


                                if ($monthName == 'September') {
                                    $sept_hours += $hours;
                                } else {
                                    $sept_hours += 0;
                                }


                                if ($monthName == 'October') {
                                    $oct_hours += $hours;
                                } else {
                                    $oct_hours += 0;
                                }


                                if ($monthName == 'November') {
                                    $nov_hours  += $hours;
                                } else {
                                    $nov_hours += 0;
                                }

                                if ($monthName == 'December') {
                                    $des_hours += $hours;
                                } else {
                                    $des_hours += 0;
                                }
                            }

                            $user[$i]['fullname'] = $cr->fullname;
                            $user[$i]['crewcode'] = $cr->initials;
                            $user[$i]['year']['jan'] = $jan_hours;
                            $user[$i]['year']['fab'] = $fab_hours;
                            $user[$i]['year']['march'] = $march_hours;
                            $user[$i]['year']['april'] = $april_hours;
                            $user[$i]['year']['may'] = $may_hours;
                            $user[$i]['year']['june'] = $june_hours;
                            $user[$i]['year']['june'] = $june_hours;
                            $user[$i]['year']['july'] = $july_hours;
                            $user[$i]['year']['augest'] = $aguest_hours;
                            $user[$i]['year']['sep'] = $sept_hours;
                            $user[$i]['year']['oct'] = $oct_hours;
                            $user[$i]['year']['nov'] = $nov_hours;
                            $user[$i]['year']['des'] = $des_hours;
                        }

                        }
                    }
                }
                // }
                $i++;
                $jan_hours = 0;
                $fab_hours = 0;
                $march_hours = 0;
                $april_hours = 0;
                $may_hours = 0;
                $june_hours = 0;
                $july_hours = 0;
                $aguest_hours = 0;
                $sept_hours = 0;
                $oct_hours = 0;
                $nov_hours = 0;
                $des_hours = 0;
            } //main_loop

            return view('pages/analytics')->with("user", $user)->with('tripcrews')->with("pagetitle", $pagetitle);

        } catch (\Exception $e) {
            return view('pages/analytics')->with("user", $user)->with('tripcrews')->with("pagetitle", $pagetitle);
            // dd($e->getMessage());
        }
    }

    public function dashboard(request $request)
    {

        // UPDATE old password into new laravel password

        $upcoming_activites = DB::table('trips')
            ->join('tripcrews', 'trips.id', '=', 'tripcrews.tripnumber')
            ->where('tripcrews.crewcode', '=', SESSION::get('initials'))
            // ->where('tripcrews.available', '=', 'Y')
            // ->where('tripcrews.confirmed', '=', 'Y')
            ->where('tripcrews.isskipper', '=', NULL)
            // ->orWhere('tripcrews.skipper', '!=', 'Y')
            // ->orWhere('tripcrews.available', '=', 'Y')
            ->where('trips.departuredate', '>=', date('Y-m-d'))
            ->orderBy('departuredate')
            // ->orderBy('id', 'DESC')
            // ->distinct()
            ->select('trips.*')
            // ->get();
            ->paginate(50);
            // ->select('trips.*')->toSql();
            // dd($upcoming_activites->toArray());



        // dd($upcoming_activites->toArray());
        if (!empty($upcoming_activites)) {
            $upcoming_activites = $upcoming_activites;
        } else {
            $upcoming_activites = [];
        }


        // dd(count($upcoming_activites));

        updateuseroldpasswordtonew($request);

        $pagetitle = "Dashboard";

        $datefrom = date('Y-m-01');
        $dateto = date('Y-m-t');

        // $month_logins = DB::table('login_history')->whereBetween('created_at', [date('Y-m-01'), date('Y-m-31')])->where('user_id', Session::get('user_id'))->select(DB::raw('COUNT(created_at) as logins'))->get();


        $month_hours = DB::table('trips')
            ->join('tripcrews', 'tripcrews.tripnumber', '=', 'trips.id')
            ->select(DB::raw('duration as duration,crewcode'))
            ->whereBetween('trips.departuredate', [date('Y-m-01'), date('Y-m-t')])
            ->where('departuredate', '<', date('Y-m-d'))
            ->where('archived', '=', "Y")
            ->where('tripcrews.crewcode', Session::get('initials'))
            // ->where('tripcrews.isskipper','!=','Y')

            ->get();

        if (!empty($month_hours)) {

            $total_month_hours = 0;
            foreach ($month_hours as $mh) {

                $duration = (!empty($mh->duration)) ? $mh->duration : 0;
                // dd($duration);
                if ($duration != 0) {
                    $duration_val = explode(':', $duration);
                    $clock = intVal($duration_val[0]);

                    $minutes = ($duration_val[1] / 10);
                    // dd($clock, $minutes);
                    $total_month_hours += $clock . "." . $minutes;
                }

                // if (isset($mh->duration) && str_contains($mh->duration, ':')) {
                //     $hours = explode(':', $mh->duration);

                //     $hours =  ($hours[0]) + ($hours[1] / 60);

                //     $total_month_hours += number_format($hours, 0, '.', '');
                // }
            }
        } else {
            $total_month_hours = 0;
        }
        //echo ceil($total_month_hours). ",";
        // dd(str_replace(array('.'),'',$total_month_hours));
        //  $res= DB::table('trips')->limit(2)->get();

        //  foreach($res as $r){

        //     $hours = explode(':',$r->duration);

        //     $hours =  ($hours[0])+($hours[1]/60);

        //     echo ceil($hours).",";

        //  }
        //  dd($res);






        $year_logins = DB::table('trips')
            ->join('tripcrews', 'tripcrews.tripnumber', '=', 'trips.id')
            ->select(DB::raw('tripcrews.isskipper,duration as duration,crewcode'))
            ->whereBetween('trips.departuredate', [date('Y-01-01'), date('Y-12-31')])
            ->where('departuredate', '<', date('Y-m-d'))
            ->where('archived', '=', "Y")

            ->where('tripcrews.crewcode', Session::get('initials'))
            // ->where('tripcrews.isskipper','!=','Y')
            ->get();
            // ->toSql();


        // dd($year_logins->toArray());
        if (!empty($year_logins)) {

            $total_year_hours = 0;
            foreach ($year_logins as $yh) {

                $duration = (!empty($yh->duration)) ? $yh->duration : 0;
                // dd($duration);
                if($duration != 0){
                    $duration_val = explode(':', $duration);
                    $clock = intVal($duration_val[0]);

                    $minutes = ($duration_val[1] / 10);
                    // dd($clock, $minutes);
                    $total_year_hours += $clock.".".$minutes;
                }

                // if (isset($yh->duration) && str_contains($yh->duration, ':')) {
                //     $hours = explode(':', $yh->duration);

                //     $hours =  ($hours[0]) + ($hours[1] * 60);

                //     $total_year_hours += number_format($hours, 2, '.', '');
                // }
            }
        } else {
            $total_year_hours = 0;
        }

        // dd($year_logins);
        // $current_month_crews = Trip::whereBetween('departuredate', [$datefrom, $dateto])->get();
        $current_month_crews = DB::table('trips')
            ->join('tripcrews', 'tripcrews.tripnumber', '=', 'trips.id')
            ->select(DB::raw('duration as duration,crewcode'))
            ->whereBetween('trips.departuredate', [$datefrom, $dateto])
            ->where('tripcrews.crewcode', Session::get('initials'))
            // ->where('tripcrews.isskipper','!=','Y')
            ->where('archived' ,'=',"Y")

            ->get();


        // $current_month_crews1 = DB::table('trips')->whereBetween('departuredate', [$datefrom, $dateto])->selectRaw('SELECT time(sum(TIMEDIFF( duration, duration )))')->get();
        // dd($current_month_crews);

        return view('pages/home')->with('pagetitle', $pagetitle)->with('current_month_crews', $current_month_crews)->with('tripcrews')->with('month_hours', $total_month_hours)->with('year_hours', $total_year_hours)->with('upcoming_activites', $upcoming_activites);
    }


    public function add(Request $request)
    {
        // dd($request->all());

        $this->validate(request(), [
            'boatname'                 => 'required',
            'departuredate'            => 'required',
            'departuretime'            => 'required',
            'duration'                 => 'required',
            'destination'              => 'required',
            'crewneeded'               => 'required',
            'crewnotes'                => 'required',
            'tripbalance'              => 'required',
            'tripcost'                 => 'required',
            'passengers'               => 'required',

        ]);



        if (isset($request->duration) && str_contains($request->duration, '.')) {
            $time = $request->duration;
            $time = explode('.', $time);
            $time = ($time[0]) . ":" . ($time[1] * 6) . ":" . "00";
            // dd($time);
        } else if (isset($request->duration) && str_contains($request->duration, ':')) {
            $time = $request->duration;
        } else {
            return redirect()->back()->withErrors(['duration' => 'Invalid Time Formate']);
        }
        if($request->crewneeded <=0){
            return redirect()->back()->withErrors(['crewneedederror' => 'Crew Need Can Not Be 0']);
        }
        try {

            DB::transaction(function () use ($request, $time) {

                $this->tripnumber = DB::table('trips')->insertGetId([

                    'boatname'                 => $request->boatname,
                    'departuredate'            => $request->departuredate,
                    'departuretime'            => $request->departuretime,
                    'duration'                 => $time,
                    'destination'              => $request->destination,
                    'crewneeded'               => $request->crewneeded,
                    'crewnotes'                => $request->crewnotes,
                    'balance'              => $request->tripbalance,
                    'cost'                 => $request->tripcost,
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

            //   dd($this->tripnumber);

            if (isset($this->tripnumber) && $this->check1 && $this->check2 && $this->check3) {

                return redirect('/all-activities')->with(['status' => true, 'msg' => 'Success! Activity Created']);
            } else {
                //dd($request->all());
                return redirect('/all-activities-create')->with(['status' => false, 'msg' => 'Error! Activity Failed'])->withInput();
            }
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect('/all-activities-create')->with(['status' => false, 'msg' => 'Error! Activity Failed'])->withInput();
        }
    }
    public function view($id, $status)
    {

        $pagetitle = "View Activity";
        $activity = Trip::findOrFail($id);
        // dd($activity);
        // dd($activity);

        $trips=Tripcrew::where('tripnumber',$id)->where('crewcode',Session::get('initials'))->get()->toArray();
        //  dd($trips);
        if($trips && ($trips[0]['available'] == 'Y' || $trips[0]['confirmed'] == 'Y')){
            $InNotInArr['isAvailable'] = "I'm not available";
            $InNotInArr['availStatuswww'] = "I'm not available";

        }else{
            //$InNotInArr['isAvailable'] = "N/A";
            $InNotInArr['isAvailable'] = "I'm available";
            $InNotInArr['availStatus'] = "I'm available";
        }

        $InNotInArr['route'] = route('all-activities-available-unavailable', $id);
       // dd($trips);
       // dd($trips);
        if ($activity) {
            return view('pages/all-activities-view')->with("activity", $activity)->with('tripcrews')->with('pagetitle', $pagetitle)->with('status', $status)->with('InNotIn',$InNotInArr);
        } else {
            abort(403);
        }
    }

    public function edit($id, $status)
    {

        if ($this->Access()) {
            return redirect('/dashboard')->with(['status' => false, 'msg' => 'Access Denied !']);
        }

        $pagetitle = "Edit Activity";
        $activity = Trip::findOrFail($id);
        // sdd($activity);
        if ($activity) {
            return view('pages/all-activities-edit')->with("activity", $activity)->with('tripcrews')->with('pagetitle', $pagetitle)->with('status', $status);
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

        try {

            if (isset($request->duration) && str_contains($request->duration, '.')) {
                $time = $request->duration;
                $time = explode('.', $time);
                $time = ($time[0]) . ":" . ($time[1] * 6) . ":" . "00";
                // dd($time);
            } else if (isset($request->duration) && str_contains($request->duration, ':')) {
                $time = $request->duration;
            }





            $activityArray = [

                'departuredate'  => $request->departuredate,
                'departuretime'  => $request->departuretime,
                'crewnotes'      => $request->NotesCrew,
                'boatname'       => $request->boatname,
                'destination'    => $request->destination,
                'duration'       => $time,
                //'archived'     =>
                'crewneeded'     => $request->crewneeded,
                'cost'           => $request->tripcost,
                'balance'        => $request->tripbalance,
                'passengers'     => $request->passengers

            ];

            $update =  Trip::whereId($request->id)->update($activityArray);



            if (!empty($request->unavailable)) {

                for ($i = 0; $i < count($request->unavailable); $i++) {

                    //  echo $request->unavailable[$i];
                    if (isset($request->unavailable[$i])) {
                        $trim1 = $request->unavailable[$i];
                        $initials1 = explode(':', $trim1);
                        $crewcode = trim($initials1[0]);
                        // echo $crewcode;

                        $check_crew = DB::table('tripcrews')->where('tripnumber', '=', $request->id)
                            ->where('crewcode', '=', $crewcode)->first();
                        if($check_crew){

                            $this->check1 =  DB::table('tripcrews')->where('tripnumber', '=', $request->id)
                            ->where('tripnumber', '=', $request->id)
                            ->where('crewcode', '=', $crewcode)->update([
                                'isskipper'                 => 'Y',
                                'available'                 => NULL,
                                'confirmed'                 => NULL,
                            ]);
                        }
                    }

                }
            }



            //    $d= DB::table('tripcrews')->where('tripnumber', '=', $request->id)->get();
            //    dd($d);
            // dd( $this->check1);

            if (!empty($request->available)) {


                for ($i = 0; $i < count($request->available); $i++) {
                    if (isset($request->available[$i])) {
                        $trim2 = $request->available[$i];
                        $initials2 = explode(':', $trim2);
                        $crewcode2 = trim($initials2[0]);



                        $check_crew = DB::table('tripcrews')->where('tripnumber', '=', $request->id)
                        ->where('crewcode', '=', $crewcode2)->first();
                        if($check_crew){
                            // dd($request->available);

                            $this->check2 =  DB::table('tripcrews')->where('tripnumber', '=', $request->id)
                            ->where('crewcode', '=', $crewcode2)
                            ->update([
                                'available'                 => 'Y',
                                'confirmed'                 => NULL,
                                'isskipper'                 => NULL,

                            ]);
                        } else {
                            // dd($request->available);

                            $userData = [
                                'recordnumber'              => rand(10, 10000),
                                'tripnumber'                => $request->id,
                                'crewcode'                  => $crewcode2,
                                'available'                 => 'Y',
                            ];
                            // dd($userData);
                            // $this->check2 = Tripcrew::create($userData);
                            $this->check2  = DB::table('tripcrews')->insert($userData);


                            // dd($this->check2);


                        }

                    }
                }
            }



            //  dd( $this->check2);
            //  dd($request->confiremd);
            if (!empty($request->confiremd)) {

                // dd($request->confiremd);

                for ($i = 0; $i < count($request->confiremd); $i++) {
                    if (isset($request->confiremd[$i])) {
                        $trim3 = $request->confiremd[$i];
                        $initials3 = explode(':', $trim3);
                        $crewcode3 = trim($initials3[0]);
                        $check_crew = DB::table('tripcrews')->where('tripnumber', '=', $request->id)
                            ->where('crewcode', '=', $crewcode3)->first();
                        if($check_crew){

                            $this->check3 = DB::table('tripcrews')->where('tripnumber', '=', $request->id)
                            ->where('crewcode', '=', $crewcode3)
                            ->update([
                                'confirmed'                 => 'Y',
                                'isskipper'                 => NULL,
                                'available'                 => NULL,
                            ]);
                        } else {

                            $userData = [
                                'recordnumber'              => rand(10, 10000),
                                'tripnumber'                => $request->id,
                                'crewcode'                  => $crewcode3,
                                'confirmed'                 => 'Y',
                            ];
                            // $this->check3 = Tripcrew::create($userData);
                            $this->check3  = DB::table('tripcrews')->insert($userData);

                        }
                    }
                }
            }

            // dd($this->check3);

            if ($update) {
                $messages[] =  "User Data Updated Successfully";

                return redirect('/all-activities')->with(['status' => true, 'msg' => 'Success ! Activty Updated']);
            } else {
                return redirect()->back()->with(['status' => false, 'msg' => 'Error ! Actity Update Failed'])->withInput();
            }
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with(['status' => false, 'msg' => 'Error ! Actity Update Failed'])->withInput();
        }
    }

    function delete($id)
    {

        //  dd($id);

        if ($this->Access()) {
            return redirect('/dashboard')->with(['status' => false, 'msg' => 'Access Denied !']);
        }

        $delete = Trip::whereId($id)->delete();
        if ($delete) {
            return redirect()->back()->with(['status' => true, 'msg' => 'Success! Activity Deleted']);
        } else {
            return redirect()->back()->with(['status' => false, 'msg' => 'Error! Activity Delete Failed']);
        }
    }




    public function dashboard_activites_delete($id)
    {
        if ($this->Access()) {
            return redirect('/dashboard')->with(['status' => false, 'msg' => 'Access Denied !']);
        }

        $delete = Trip::whereId($id)->delete();

        if ($delete) {
            return redirect()->back()->with(['status' => true, 'msg' => 'Success! Activity Deleted']);
        } else {
            return redirect()->back()->with(['status' => false, 'msg' => 'Error! Activity Delete Failed']);
        }
    }

    public function myactivities()
    {

        // dd(Session::get('initials'));


        $pagetitle = "My Activities";

        // $trips = Trip::paginate(50);
        $role = Session::get('role');
        if($role == 'crewmember'){

            $trips = DB::table('trips')
            ->join('tripcrews', 'tripnumber', '=', 'trips.id')
            ->select('tripcrews.*', 'trips.*')
            ->where('crewcode', '=', Session::get('initials'))
            ->where('trips.archived', '!=', 'Y')

            ->where('tripcrews.confirmed', '=', 'Y')
            // ->where('tripcrews.isskipper','!=','Y')
            // ->where('tripcrews.isskipper', '!=', "Y")
            // ->where('confirmed', '=', 'Y')
            // ->groupBy('tripnumber')
            ->orderBy('trips.departuredate', 'DESC')
            ->paginate(50);
            // ->get();
            // ->toSql();

        } else{


            $trips = DB::table('trips')
            ->join('tripcrews', 'tripnumber', '=', 'trips.id')
            ->select('tripcrews.*', 'trips.*')
            ->where('crewcode', '=', Session::get('initials'))

            ->where('tripcrews.confirmed', '=', 'Y')
            // ->where('tripcrews.available', '=', 'Y')
            // ->where('tripcrews.isskipper','!=','Y')
            // ->where('tripcrews.isskipper', '!=', "Y")
            // ->where('confirmed', '=', 'Y')
            // ->groupBy('tripnumber')
            ->orderBy('trips.departuredate', 'DESC')
            ->paginate(50);
            // ->get();
            // ->toSql();
        }


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
        $flag = '';

        // print_r($check);

        if (!empty($check) && $check->available == 'Y') {

            $added = DB::table('tripcrews')->where('tripnumber', $trip_id)->where('crewcode', $user_initials)->update(['available' => NULL, 'isskipper' => 'Y', 'confirmed' => NULL]);
            if ($added) {
                $flag = 'removed';
            }
        } else if (!empty($check) && $check->confirmed == 'Y') {

            $added = DB::table('tripcrews')->where('tripnumber', $trip_id)->where('crewcode', $user_initials)->update(['available' => NULL, 'isskipper' => 'Y', 'confirmed' => NULL]);
            if ($added) {
                $flag = 'removed';
            }
        }
         else {
            $removed = DB::table('tripcrews')->where('tripnumber', $trip_id)->where('crewcode', $user_initials)->update(['available' => 'Y', 'isskipper' => NULL, 'confirmed' => NULL]);

            if ($removed) {
                $flag = 'added';
            }
        }

        if (empty($check)) {
            $tripecrw = DB::table('tripcrews')->insert([
                'recordnumber'              => rand(10, 10000),
                'tripnumber'                => $trip_id,
                'crewcode'                  => $user_initials,
                'available'                 => 'Y'
            ]);
            // $added = DB::table('tripcrews')->where('tripnumber', $trip_id)->where('crewcode', $user_initials)->update(['available' => 'Y']);
            if ($tripecrw) {
                // dd($tripecrw);
                $flag = 'added';
            }
        }

        if ($flag == 'removed') {
            return redirect()->back()->with(['status' => true, 'msg' => 'Success ! You Are Unavailable']);
        } else if ($flag == 'added') {
            return redirect()->back()->with(['status' => true, 'msg' => 'Success ! You Are Available']);
        }
    }

    public function validate_crewcode(Request $request)
    {
        //dd($request->crewcode);
        $crew = Crew::where('initials', $request->crewcode)->get()->toArray();

        if (!empty($crew)) {
            //  dd($crew);
            return response()->json(['status' => false, 'msg' => 'Crew Code Already Exists Try An Other One']);
        } else {
            return response()->json(['status' => true, 'msg' => 'You Can Proceed']);
        }
    }

    public function validate_email(Request $request)
    {
        //dd($request->crewcode);
        $crew = User::where('email', $request->email)->get()->toArray();

        if (!empty($crew)) {
            //  dd($crew);
            return response()->json(['status' => false, 'msg' => 'Email Already Exists']);
        } else {
            return response()->json(['status' => true, 'msg' => 'You Can Proceed']);
        }
    }

    public function validate_username(Request $request)
    {
        //dd($request->crewcode);
        $crew = User::where('username', $request->username)->get()->toArray();

        if (!empty($crew)) {
            //  dd($crew);
            return response()->json(['status' => false, 'msg' => 'Username Already Exists']);
        } else {
            return response()->json(['status' => true, 'msg' => 'You Can Proceed']);
        }
    }
    public function rolespermissions()
    {
        dd(Role::all());
        return view('pages/roles-permissions');
    }
}
