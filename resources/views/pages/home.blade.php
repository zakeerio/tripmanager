@extends('layouts.default')

@section('content')

<?php

// print_r(file_exists(public_path().'/assets/activity-images'.'/'.'638740b37298f9umAI8GUdHac1 (1).png'));

// exit;

?>
<div class="row dashboard_col" id="dashboard">

    <div class="col-md-12 dashboard_Sec">

        <h1>Dashboard</h1>

        <p>Hey <strong>{{ (Auth::user() !== null) ? Auth::user()->name : '' }}</strong>, welcome to your dashboard.</p>
        @if (Session::has('status'))

        @if(Session::get('status'))
        <script>
            var msg = "{{Session::get('msg')}}";
            ShowToast(msg, 'success');
        </script>
        @else
        <script>
            var msg = "{{Session::get('msg')}}";
            ShowToast(msg, 'error');
        </script>
        @endif

        @endif

    </div>
    <div class="col-lg-12 row-2">

        <div class="row">

            <div class="col-lg-3 col-md-12 teck-first-colum">

                <div class="icon-box">

                    <img src="{{ asset('assets/images/1.png') }}" class="img-box" alt="">

                    <p>
                        <span>{{ $current_month_crews->count() }}</span>
                        Activities <br> This Month

                    </p>

                </div>

            </div>

            <div class="col-lg-3 col-md-12 teck-second-colum">

                <div class="icon-box">

                    <img src="{{ asset('assets/images/2.png') }}" class="img-box" alt="">

                    <p>
                        <span>{{ $month_hours }}</span>

                        Hours Logged <br> This Month

                    </p>

                </div>

            </div>

            <div class="col-lg-3 col-md-12 teck-third-colum">

                <div class="icon-box">

                    <img src="{{ asset('assets/images/3.png') }}" class="img-box" alt="">

                    <p>
                        <span>{{$year_hours}}</span>

                        Hours Logged <br> This Year

                    </p>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-12 activies_table">

        <div class="row activity_col">

            <div class="col-md-12 dashboard-heading-desc">
                <div class="row">
                    <div class="col-lg-8 col-md-12 upcoming_activities">
                        <h4>Your upcoming activities <span class="circle-green">{{count($upcoming_activites)}}</span></h4>
                        <p class="col-12-descrapction">Below is a list of the upcoming activities you are scheduled to attend within the next 30 days.</p>
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <div class="teck-btn-view-activites justify-content-end">
                            <a href="{{ route('my-activities') }}"><img src="{{ asset('assets/images/All-Activities.png') }}" class="view-activites-icon">View all my activities</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="teck-table">
                    <table class="rwd-table table" @if ($upcoming_activites->count() > 0 ) id="datatables" @endif >

                        <thead>
                            <tr>
                                <th class="th-heading">Activity</th>
                                <th class="th-heading">Activity Date</th>
                                <th class="th-heading-brief">Brief</th>
                                <th class="th-heading">Duration</th>
                                <th class="th-heading">Crew Needed</th>
                                <th class="th-heading">Crew</th>
                                <th class="th-heading">Status</th>
                                <th class="th-heading">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($upcoming_activites as $trip )

                            <?php

                            // $confirme_crew = DB::table('tripcrews')
                            //     ->where('tripnumber', $trip->id)
                            //     // ->where('confirmed', 'Y')
                            //     // ->where('available', 'Y')
                            //     ->get()->count();



                            ?>

                            <tr class="">

                                <td width="300">

                                    <div class="table-div">

                                        <?php
                                        $boat = \App\Models\ActivityItem::where(['activityname' => $trip->boatname])->first();

                                        // print_r($boat->activitypicture);
                                        // exit;
                                        if (!empty($boat) && isset($boat->activityname) && file_exists(public_path() . '/assets/activity-images' . '/' . $boat->activitypicture)) {
                                            $backgroundColor =  ($boat->rgbcolor) ? $boat->rgbcolor : "#38e25d";
                                        ?>

                                            <img src="{{asset('assets/activity-images').'/'.$boat->activitypicture}}" class="img-fluid" alt="142122" style="box-shadow:0 0 0 4px {{ $backgroundColor }}">
                                        <?php
                                        } else {
                                        ?>

                                            <img src="./assets/images/Picture-01.png" class="img-fluid" alt="">

                                        <?php
                                        }

                                        ?>

                                        <p> <b>{{$trip->boatname}}</b> <br>
                                            #{{$trip->id}}
                                        </p>

                                    </div>

                                <td>{{$trip->departuredate}}</td>
                                <td width="300">{!! $trip->crewnotes !!}</td>
                                <td>
                                    @php
                                        $durationfinal = 0;
                                        $duration = (!empty($trip->duration)) ? $trip->duration : 0;
                                        // dd($duration);
                                        if($duration != 0){
                                            $duration_val = explode(':', $duration);
                                            $clock = intVal($duration_val[0]);

                                            $minutes = ($duration_val[1] / 10);
                                            // dd($clock, $minutes);
                                            $durationfinal = $clock.".".$minutes;
                                        }
                                    @endphp
                                    {{ $durationfinal }} hours</td>
                                <td>{{ $trip->crewneeded }} Crew Members</td>

                                <td width="250">
                                    <?php

                                    $i = 0;
                                    $initials = Session::get('initials');

                                    $members = \App\Models\Tripcrew::where(['tripnumber' => $trip->id, 'confirmed' => 'Y'])->get();

                                    $check_crewcount = 0;


                                    if (!empty($members)) {

                                        foreach ($members as $m) {

                                            // echo $m->isskipper . ",11";
                                            $member = \App\Models\Crew::where(['initials' => $m->crewcode])->first();

                                            if($member && $m->isskipper != 'Y' && $m->isskipper == '') {
                                                $check_crewcount++;

                                                echo $m->crewcode . ",";
                                            }
                                            $i++;
                                    ?>

                                    <?php
                                        }
                                    }
                                    ?>

                                </td>


                                <td width="200">


                                    <?php

                                    $isReady = NULL;
                                    // $confirme_crew = DB::table('tripcrews')
                                    // ->join('crews', 'crews.initials', 'tripcrews.crewcode')
                                    // ->where('tripnumber', $trip->id)
                                    // ->where('confirmed', 'Y')
                                    // // ->where('available', 'Y')
                                    // ->get()->count();

                                    if ($check_crewcount >= $trip->crewneeded) {
                                        $isReady = 'Ready';
                                    ?>
                                        <span class="active-btn">
                                            <img src="{{ asset('assets/images/Activity-Ready-Button.png') }}" class="img-fluid" alt=""> Activity Ready</span>

                                    <?php


                                    } else {
                                        $isReady = 'Needed';
                                    ?>

                                        <span class="active-btn-2"><img src="{{ asset('assets/images/Button-Crew-Needed.png') }}" class="alrt-image" alt=""> Crew Needed</span>

                                    <?php
                                    }

                                    ?>
                                </td>
                                <td class="action">

                                    <div class="dropdown">
                                        <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="BtnAction">
                                            <!-- <a class="dropdown-item" href="{{ route('all-activities-edit', [$trip->id,$isReady]) }}">1Edit</a>
                                                 <a class="dropdown-item" href="#">Delete</a> -->

                                            @if(Session::get('role') !='crewmember')
                                                <a class="dropdown-item" href="{{ route('all-activities-view', [$trip->id,$isReady]) }}">View Activity</a>
                                                <a class="dropdown-item" href="{{ route('all-activities-edit', [$trip->id,$isReady]) }}">Edit Activity</a>
                                                <a class="dropdown-item" href="#" onclick="DeleteActivity('{{$trip->id}}')">Delete Activity</a>
                                            @else
                                                <a class="dropdown-item" href="{{ route('all-activities-view', [$trip->id,$isReady]) }}">View Activity</a>

                                                <?php


                                                $initials = Session::get('initials');
                                                $check = \App\Models\Tripcrew::where(['crewcode' => $initials, 'tripnumber' => $trip->id])->first();

                                                if (!empty($check)) {

                                                    if ($check->available == 'Y' || $check->confirmed == 'Y') {
                                                        $isAvailable = "I'm not Available";
                                                        $route = route('all-activities-available-unavailable', $trip->id);
                                                    } else {
                                                        $isAvailable = "I'm available";
                                                        $route = route('all-activities-available-unavailable', $trip->id);
                                                    }
                                                } else {
                                                    $isAvailable = "I'm available";
                                                    $route = route('all-activities-available-unavailable', $trip->id);
                                                }

                                                ?>
                                                {{-- <a class="dropdown-item" href="<?php echo $route ?>"><?php echo $isAvailable ?></a> --}}
                                            @endif
                                        </div>
                                    </div>

                                </td>

                            </tr>

                            @empty
                            <tr>
                                <td colspan="9">No items found!</td>
                            </tr>
                            @endforelse
                            {{-- <tr>



                                    "id" => 1006
                                    "departuredate" => "2009-05-24"
                                    "departuretime" => "10:00:00"
                                    "crewnotes" => "Public trips every 30 minutes approx 20-25 mins ticket only 10.00-17.00"
                                    "boatname" => "Seth Ellis"
                                    "destination" => ""
                                    "duration" => "00:30:00"
                                    "archived" => "Y"
                                    "crewneeded" => 0
                                    "cost" => null
                                    "balance" => null
                                    "sent_notice" => ""
                                    "passengers" => 0
                                    "created_at" => null
                                    "updated_at" => null



                                    <td>
                                        <div class="table-div">
                                            <img src="{{ asset('assets/images/Picture-01.png') }}" class="img-fluid"
                            alt="">
                            <p> <b> Hugh Henshall</b> <br> #7083 </p>
                </div>
                </td>
                <td>Tue 26th July '22 <br> 09:00 AM</td>
                <td>Tuesday Bacon Cob Cruise</td>
                <td>8 hours</td>
                <td>6 Crew Members</td>
                <td>ADL, CH, KW1,<br>
                    PLE, AB, JKL</td>
                <td data-th="Net Amount">
                    <span class="active-btn"><img src="{{ asset('assets/images/Activity-Ready-Button.png') }}" class="img-fluid" alt=""> Activity Ready</span>
                </td>

                <td class="action">

                    <div class="dropdown">
                        <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="BtnAction">
                            <a class="dropdown-item" href="{{ route('all-activities-edit', 2) }}">Edit</a>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>

                </td>

                </tr> --}}

                {{-- <tr class="teck-danger">
                                    <td>
                                        <div class="table-div">
                                            <img src="{{ asset('assets/images/Picture-02.png') }}" class="img-fluid"
                alt="">
                <p> <b> Seth Ellis </b> <br> #7084
            </div>
            </td>
            <td>Wed 27th July '22 <br> 09:15 AM</td>
            <td>Drakehouse 2 hour cruises</td>
            <td>7.5 hours</td>
            <td>4 Crew Members</td>
            <td data-th="Net Amount">ADL, CH,</td>
            <td data-th="Net Amount" class="crew_btn">
                <span class="active-btn-2"><img src="{{ asset('assets/images/Button-Crew-Needed.png') }}" class="alrt-image" alt=""> Crew Needed</span>
            </td>

            <td class="action">

                <div class="dropdown">
                    <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="BtnAction">
                        <a class="dropdown-item" href="{{ route('all-activities-edit', 2) }}">Edit</a>
                        <a class="dropdown-item" href="#">Delete</a>
                    </div>
                </div>

            </td>
            </tr>
            <tr>
                <td>
                    <div class="table-div">
                        <img src="{{ asset('assets/images/Picture-02.png') }}" class="img-fluid" alt="">
                        <p> <b> Henshall </b> <br> #7083 </p>
                    </div>
                </td>
                <td>Tue 26th July '22 <br> 09:00 AM</td>
                <td>Tuesday Bacon Cob Cruise</td>
                <td>8 hours</td>
                <td>6 Crew Members</td>
                <td data-th="Net Amount">ADL, CH, KW1,<br> PLE, AB, JKL</td>
                <td data-th="Net Amount">
                    <span class="active-btn"><img src="{{ asset('assets/images/Activity-Ready-Button.png') }}" class="img-fluid" alt=""> Activity Ready</span>
                </td>

                <td class="action">

                    <div class="dropdown">
                        <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="BtnAction">
                            <a class="dropdown-item" href="{{ route('all-activities-edit', 2) }}">Edit</a>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>

                </td>
            </tr> --}}
            </tbody>
            </table>


            {{-- <table class="rwd-table">

                            <tbody>

                                <tr>

                                    <th>Activity</th>

                                    <th>Activity Date</th>

                                    <th>Brief</th>

                                    <th>Duration</th>

                                    <th>Crew Needed</th>

                                    <th>Crew</th>

                                    <th>Status</th>

                                </tr>

                                <tr>



                                    <td data-th="Supplier Code">

                                        <div class="table-div">

                                            <img src="{{ asset('assets/images/Picture-01.png') }}" class="img-fluid"
            alt="">

            <p><b>Hugh Henshall </b><br> #7083 </p>

        </div>

        </td>

        <td data-th="Supplier Name">

            <p>

                Tue 26th July '22 <br> 09:00 AM

            </p>

        </td>

        <td data-th="Invoice Number">

            Tuesday Bacon Cob Cruise

        </td>

        <td data-th="Invoice Date">

            8 hours

        </td>

        <td data-th="Due Date">

            6 Crew Members

        </td>

        <td data-th="Net Amount">

            <p>ADL, CH, KW1,

                PLE, AB, JKL</p>

        </td>

        <td data-th="Net Amount">

            <span class="active-btn"><img src="{{ asset('assets/images/Activity-Ready-Button.png') }}" class="img-fluid" alt=""> Activity Ready</span>

        </td>
        <td class="action">
            <div class="dropdown">
                <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="BtnAction">
                    <a class="dropdown-item" href="{{ route('all-activities-edit', 3) }}">Edit</a>
                    <a class="dropdown-item" href="#">Delete</a>
                </div>
            </div>
        </td>
        </tr>

        <tr class="teck-danger">

            <td data-th="Supplier Code">

                <div class="table-div">

                    <img src="{{ asset('assets/images/Picture-02.png') }}" class="img-fluid" alt="">

                    <p><b>Seth Ellis</b><br> #7084 </p>

                </div>

            </td>

            <td data-th="Supplier Name">

                <p>

                    Wed 27th July '22 <br> 09:15 AM

                </p>

            </td>

            <td data-th="Invoice Number">

                Drakehouse 2 hour cruises

            </td>

            <td data-th="Invoice Date">

                7.5 hours

            </td>

            <td data-th="Due Date">

                4 Crew Members

            </td>

            <td data-th="Net Amount">

                <p>ADL, CH,</p>

            </td>

            <td data-th="Net Amount" class="crew_btn">

                <span class="active-btn-2"><img src="{{ asset('assets/images/Button-Crew-Needed.png') }}" class="img-fluid" alt=""> Crew Needed</span>

            </td>
            <td class="action">

                <div class="dropdown">
                    <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="BtnAction">
                        <a class="dropdown-item" href="{{ route('all-activities-edit', 3) }}">Edit</a>
                        <a class="dropdown-item" href="#">Delete</a>
                    </div>
                </div>

            </td>

        </tr>

        <tr>

            <td data-th="Supplier Code">

                <div class="table-div">

                    <img src="{{ asset('assets/images/Picture-02.png') }}" class="img-fluid" alt="">

                    <p><b>Hugh Henshall</b><br> #7083 </p>

                </div>

            </td>

            <td data-th="Supplier Name">

                <p>

                    Tue 26th July '22 <br> 09:00 AM

                </p>

            </td>

            <td data-th="Invoice Number">

                Tuesday Bacon Cob Cruise

            </td>

            <td data-th="Invoice Date">

                8 hours

            </td>

            <td data-th="Due Date">

                6 Crew Members

            </td>

            <td data-th="Net Amount">

                <p>ADL, CH, KW1,

                    PLE, AB, JKL</p>

            </td>

            <td data-th="Net Amount">

                <span class="active-btn"><img src="{{ asset('assets/images/Activity-Ready-Button.png') }}" class="img-fluid" alt=""> Activity Ready</span>

            </td>
            <td class="action">

                <div class="dropdown">
                    <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="BtnAction">
                        <a class="dropdown-item" href="{{ route('all-activities-edit', 3) }}">Edit</a>
                        <a class="dropdown-item" href="#">Delete</a>
                    </div>
                </div>

            </td>

        </tr>

        </tbody>
        </table> --}}
    </div>

    @if ($upcoming_activites->hasPages())

    <div class="row btm-row">
        {{ $upcoming_activites->links('pagination::bootstrap-4') }}

    </div>

    @endif


</div>

</div>

</div>

</div>

@stop

<script>
    function ShowWarningAlert(msg) {


        Swal.fire({
            title: 'Are you sure?',
            text: msg,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }

            return result.isConfirmed
        });


    }

    function ShowToast(msg, type) {


        if (type == 'error') {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'error',
                title: msg
            })

        } else if (type == 'success') {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: msg
            })
        }
    }

    function DeleteActivity(id) {

        if (ShowWarningAlert('Do You Want Delete ?')) {
            window.location.href = "{{URL::to('dashboard-activites-delete')}}/" + id;
        }

    }
</script>
