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
                    $trips = Trip::orderBy('departuredate', 'DESC')->where('archived', "=",  NULL)->where('boatname',$request->filter)->paginate(50);
                } else {
                    $trips = Trip::orderBy('departuredate', 'DESC')->where('boatname',$request->filter)->paginate(50);
                }
            } else {
                if (Session::get('role') == 'crewmember') {

                    $trips = Trip::orderBy('departuredate', 'DESC')->where('archived', "=", NULL)->paginate(50);
                } else {
                    $trips = Trip::orderBy('departuredate', 'DESC')->paginate(50);

                }
            }
        } else {
            if (Session::get('role') == 'crewmember') {

                $trips = Trip::orderBy('departuredate', 'DESC')->where('archived', "=", NULL)->orWhere('archived', "=", '')->paginate(50);
                // $trips = Trip::orderBy('departuredate', 'DESC')->where('archived', "=", NULL)->toSql();
                // dd($trips);


            } else {
                $trips = Trip::orderBy('departuredate', 'DESC')->paginate(50);


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

    public function analytics_view()
    {
        $pagetitle = "Analytics";

        // $trips = Trip::paginate(250);
        // dd($trips);

        // $returnOrderDetails = Order::with('order_items')->whereHas('order_items', function($q) {
        //     $q->where('item_status', 'Return Approved');
        //    })->get();

        // $trips = Crew::with('trip_user')->whereHas('trip_user', function ($q) {
        //     $q->where('available', 'Y');
        // })->get();

        // foreach ($trips as $tp) {

        //     echo $tp->fullname . "<br>";

        //     foreach ($tp->trip_user as $t) {
        //         echo $t->crewcode . "<br>";
        //     }
        // }
        // $trips = Tripcrew::with('trip')->whereHas('trip', function ($q) {
        //     $q->where('available', 'Y');
        //     $q->where('departuredate', '>',  date('Y-01-01'));
        //     $q->where('departuredate', '<',  date('Y-12-31'));
        // })->get();
        // $trips = Crew::with(['trip_user','tripcrews'])->get()->toArray();


        // $date = new DateTime('2000-01-01');
        // $result = $date->format('Y-m-d H:i:s');



        $crew = DB::table('crews')->get();

        $i = 0;
        $user = array();

        foreach ($crew as $cr) {


            $tripcrews = DB::table('tripcrews')->where('crewcode', $cr->initials)->get();

            // if (isset($tripcrews) && $tripcrews[0]->isskipper == 'Y') {
            //     $user[$i]['fullname'] = $cr->fullname;
            //     $user[$i]['crewcode'] = $cr->initials;
            //     $user[$i]['year']['jan'] = 0;
            //     $user[$i]['year']['fab'] = 0;
            //     $user[$i]['year']['march'] = 0;
            //     $user[$i]['year']['april'] = 0;
            //     $user[$i]['year']['may'] = 0;
            //     $user[$i]['year']['june'] = 0;
            //     $user[$i]['year']['june'] = 0;
            //     $user[$i]['year']['july'] = 0;
            //     $user[$i]['year']['augest'] = 0;
            //     $user[$i]['year']['sep'] = 0;
            //     $user[$i]['year']['oct'] = 0;
            //     $user[$i]['year']['nov'] = 0;
            //     $user[$i]['year']['des'] = 0;
            // } else {
            //     if (isset($tripcrews[0]->tripnumber)) {
            //         $trip = DB::table('trips')->where('id', $tripcrews[0]->tripnumber)->get();

            //         $exp = explode('-', $trip[0]->departuredate);
            //         $monthNum  = $exp[1];
            //         $dateObj   = DateTime::createFromFormat('!m', $monthNum);
            //         $monthName = $dateObj->format('F');
            //         // echo  $monthName. "<br>";

            //         if (isset($trip[0]->duration) && str_contains($trip[0]->duration, ':')) {
            //             $hours = explode(':', $trip[0]->duration);
            //             $hours =  ($hours[0]) + ($hours[1] / 60);
            //             $total_month_hours = ceil($hours);
            //         } else {
            //             $total_month_hours = 0;
            //         }


            //         if ($monthName == 'January') {
            //             $jan = $total_month_hours = ceil($hours);
            //         } else {
            //             $jan = 0;
            //         }

            //         if ($monthName == 'February') {
            //             $fab = $total_month_hours = ceil($hours);
            //         } else {
            //             $fab = 0;
            //         }

            //         if ($monthName == 'March') {
            //             $march = $total_month_hours = ceil($hours);
            //         } else {
            //             $march = 0;
            //         }


            //         if ($monthName == 'April') {
            //             $april = $total_month_hours = ceil($hours);
            //         } else {
            //             $april = 0;
            //         }

            //         if ($monthName == 'May') {

            //             $may = $total_month_hours;
            //         } else {
            //             $may = 0;
            //         }

            //         if ($monthName == 'June') {
            //             $june = $total_month_hours = ceil($hours);
            //         } else {
            //             $june = 0;
            //         }

            //         if ($monthName == 'July') {
            //             $july = $total_month_hours = ceil($hours);
            //         } else {
            //             $july = 0;
            //         }


            //         if ($monthName == 'Augest') {
            //             $augest = $total_month_hours = ceil($hours);
            //         } else {
            //             $augest = 0;
            //         }


            //         if ($monthName == 'September') {
            //             $sep = $total_month_hours = ceil($hours);
            //         } else {
            //             $sep = 0;
            //         }


            //         if ($monthName == 'October') {
            //             $oct = $total_month_hours = ceil($hours);
            //         } else {
            //             $oct = 0;
            //         }


            //         if ($monthName == 'November') {
            //             $nov = $total_month_hours = ceil($hours);
            //         } else {
            //             $nov = 0;
            //         }


            //         if ($monthName == 'December') {
            //             $des = $total_month_hours = ceil($hours);
            //         } else {
            //             $des = 0;
            //         }

            //         $user[$i]['fullname'] = $cr->fullname;
            //         $user[$i]['crewcode'] = $cr->initials;
            //         $user[$i]['year']['jan'] = $jan;
            //         $user[$i]['year']['fab'] = $fab;
            //         $user[$i]['year']['march'] = $march;
            //         $user[$i]['year']['april'] = $april;
            //         $user[$i]['year']['may'] = $may;
            //         $user[$i]['year']['june'] = $june;
            //         $user[$i]['year']['june'] = $june;
            //         $user[$i]['year']['july'] = $july;
            //         $user[$i]['year']['augest'] = $augest;
            //         $user[$i]['year']['sep'] = $sep;
            //         $user[$i]['year']['oct'] = $oct;
            //         $user[$i]['year']['nov'] = $nov;
            //         $user[$i]['year']['des'] = $des;
            //     }
            // }
            // $i++;
        }

        // echo "<pre>";
        // print_r($user);
        // dd($user);

        return view('pages/analytics')->with("user", $user)->with('tripcrews')->with("pagetitle", $pagetitle);
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
            ->select('trips.*')->paginate(50);
            // ->select('trips.*')->toSql();




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
            ->where('departuredate' ,'<',date('Y-m-d'))
            ->where('archived' ,'=',"Y")
            ->where('tripcrews.crewcode', Session::get('initials'))
            // ->where('tripcrews.isskipper','!=','Y')

            ->get();

        if (!empty($month_hours)) {

            $total_month_hours = 0;
            foreach ($month_hours as $mh) {

                $duration = (!empty($mh->duration)) ? $mh->duration : 0;
                // dd($duration);
                if($duration != 0){
                    $duration_val = explode(':', $duration);
                    $clock = intVal($duration_val[0]);

                    $minutes = ($duration_val[1] / 10);
                    // dd($clock, $minutes);
                    $total_month_hours += $clock.".".$minutes;
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
            ->where('departuredate' ,'<',date('Y-m-d'))
            ->where('archived' ,'=',"Y")

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

        //dd($request->all());

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

            //   dd($this->tripnumber);

            if (isset($this->tripnumber) && $this->check1 && $this->check2 && $this->check3) {

                return redirect('/all-activities-create')->with(['status' => true, 'msg' => 'Success! Activity Created']);
            } else {
                //dd($request->all());
                return redirect('/all-activities-create')->with(['status' => false, 'msg' => 'Error! Activity Failed']);
            }
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect('/all-activities-create')->with(['status' => false, 'msg' => 'Error! Activity Failed']);
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
            $InNotInArr['    ']="I'm not available";

        }else{
            //$InNotInArr['isAvailable'] = "N/A";
            $InNotInArr['isAvailable'] = "I'm available";
            $InNotInArr['availStatus']="I'm available";

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
                return redirect('/all-activities')->with(['status' => false, 'msg' => 'Error ! Actity Update Failed']);
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            // return redirect('/all-activities')->with(['status' => false, 'msg' => 'Error ! Actity Update Failed']);
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
            ->orderBy('trips.id', 'DESC')
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
            ->orderBy('trips.id', 'DESC')
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

        print_r($check);

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
