@extends('layouts.default')

@section('content')

    <?php

    // print_r(file_exists(public_path().'/assets/activity-images'.'/'.'638740b37298f9umAI8GUdHac1 (1).png'));

    // exit;
    ?>
    <div class="row dashboard_col" id="dashboard">

        <div class="col-md-12 dashboard_Sec">

            <h1>Dashboard</h1>

            <p>Hey <strong>{{ Auth::user() !== null ? Auth::user()->name : '' }}</strong>, welcome to your dashboard.</p>
            @if (Session::has('status'))

                @if (Session::get('status'))
                    <script>
                        var msg = "{{ Session::get('msg') }}";
                        ShowToast(msg, 'success');
                    </script>
                @else
                    <script>
                        var msg = "{{ Session::get('msg') }}";
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
                            <span>{{ $year_hours }}</span>

                            Hours Logged <br> This Year

                        </p>

                    </div>

                </div>

                <div class="col-lg-3 col-md-12 teck-third-colum">

                    <div class="icon-box">

                        <img src="{{ asset('assets/images/2.png') }}" class="img-box" alt="">

                        <p>
                            <span>{{ $total_altogether_hours }}</span>

                            Hours logged <br> Altogether

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
                            <h4>Your upcoming activities <span class="circle-green">{{ count($upcoming_activites) }}</span>
                            </h4>
                            <p class="col-12-descrapction">Below is a list of the upcoming activities you are scheduled to
                                attend within the next 30 days.</p>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <div class="teck-btn-view-activites justify-content-end">
                                <a href="{{ route('my-activities') }}"><img
                                        src="{{ asset('assets/images/All-Activities.png') }}"
                                        class="view-activites-icon">View all my activities</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="teck-table">
                        <table class="rwd-table table" @if ($upcoming_activites->count() > 0) id="datatables" @endif>

                            <thead>
                                <tr>
                                    <th class="th-heading">Activity</th>
                                    <th class="th-heading">Date / Time</th>
                                    <th class="th-heading-brief">Crew Notes</th>
                                    <th class="th-heading">Duration</th>
                                    <th class="th-heading">Crew Needed</th>
                                    <th class="th-heading">Crew</th>
                                    <th class="th-heading">Status</th>
                                    <th class="th-heading">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($upcoming_activites as $trip )


                                    <tr class="">

                                        <td width="250">

                                            <div class="table-div">

                                                <?php
                                        $boat = \App\Models\ActivityItem::where(['activityname' => $trip->boatname])->first();

                                        // print_r($boat->activitypicture);
                                        // exit;
                                        if (!empty($boat) && isset($boat->activityname) && file_exists(public_path() . '/assets/activity-images' . '/' . $boat->activitypicture)) {
                                            $backgroundColor =  ($boat->rgbcolor) ? $boat->rgbcolor : "#38e25d";
                                        ?>

                                                <img src="{{ asset('assets/activity-images') . '/' . $boat->activitypicture }}"
                                                    class="img-fluid" alt="142122"
                                                    style="box-shadow:0 0 0 4px {{ $backgroundColor }}">
                                                <?php
                                        } else {
                                        ?>

                                                <img src="./assets/images/Picture-01.png" class="img-fluid" alt="">

                                                <?php
                                        }

                                        ?>

                                                <p> <b>{{ $trip->boatname }}</b> <br>{{ $trip->destination }}<br>
                                                    #{{ $trip->id }}
                                                </p>

                                            </div>

                                        <td>{{ date('d-M-Y', strtotime($trip->departuredate)) }}<br>at
                                            {{ date('g:i A', strtotime($trip->departuretime)) }}
                                        </td>
                                        <td width="300" style="padding-right:30px">{!! $trip->crewnotes !!}</td>
                                        <td>
                                            @php
                                                $durationfinal = 0;
                                                $duration = !empty($trip->duration) ? $trip->duration : 0;
                                                // dd($duration);
                                                if ($duration != 0) {
                                                    $duration_val = explode(':', $duration);
                                                    $clock = intVal($duration_val[0]);

                                                    $minutes = $duration_val[1] / 10;
                                                    // dd($clock, $minutes);
                                                    $durationfinal = $clock . '.' . (int) $minutes;
                                                }
                                            @endphp
                                            {{ $durationfinal }} hours</td>
                                        <td>{{ $trip->crewneeded }} Members</td>

                                        <td width="250">
                                            <?php
                                            $i = 0;
                                            $initials = Session::get('initials');

                                            $crewlead = "!!";
                                            $counter = 0;

                                            $members = \App\Models\Tripcrew::where(['tripnumber' => $trip->id])
                                                ->where(function ($query) {
                                                    $query->where('confirmed', '=', 'Y')->orWhere('available', '=', 'Y');
                                                })
                                                ->orderBy('confirmed', 'desc') // confirmed members first
                                                ->orderBy('crewlead', 'desc') // confirmed members first
                                                ->get();

                                            $check_crewcount = 0;

                                            $confirmed_members = [];
                                            $available_members = [];

                                            if (!empty($members)) {
                                                foreach ($members as $index => $m) {
                                                    // echo $crewlead."<br>";

                                                    $member = \App\Models\Crew::where(['initials' => $m->crewcode])->first();
                                                    $color = $m->confirmed == 'Y' ? '#2ecc71' : '#f39c12'; // color based on confirmed status

                                                    if ($member && $m->isskipper != 'Y' && $m->isskipper == '') {
                                                        if($m->confirmed == "Y") {

                                                            if(($m->crewlead == 'Y') || $counter !=1) {
                                                                $crewlead = "crewlead";
                                                                $counter = 1;
                                                            } else {
                                                                $crewlead = "";
                                                            }
                                                        } else {
                                                            $crewlead = "";
                                                        }

                                                        if ($m->confirmed == 'Y') {
                                                            $confirmed_members[] = "<span class='{{ $crewlead }}' style='color:" . $color . "'>" . $m->crewcode . '</span>';
                                                        } elseif ($m->available == 'Y') {
                                                            $available_members[] = "<span style='color:" . $color . "'>" . $m->crewcode . '</span>';
                                                        }
                                                    }
                                                }

                                                if (!empty($confirmed_members)) {
                                                    echo implode(', ', $confirmed_members);
                                                }

                                                if (!empty($available_members)) {
                                                    if (!empty($confirmed_members)) {
                                                        echo ', ';
                                                    }

                                                    echo implode(', ', $available_members);
                                                }
                                            }
                                            ?>
                                        </td>





                                        @php
                                            $isReady = null;
                                        @endphp

                                        @if ($trip->archived == 'Y')
                                            @php
                                                $isReady = 'completed';
                                            @endphp

                                            <td width="180" data-th="Net Amount">
                                                <span class="active-btn"><img
                                                        src="{{ asset('assets/images/Activity-Ready-Button.png') }}"
                                                        class="img-fluid" alt=""> Completed</span>
                                            </td>
                                        @else
                                            @if ($check_crewcount >= $trip->crewneeded ? 'teck-danger' : '')
                                                <td width="180" data-th="Net Amount">
                                                    <span class="active-btn"><img
                                                            src="{{ asset('assets/images/Activity-Ready-Button.png') }}"
                                                            class="img-fluid" alt=""> Activity Ready</span>
                                                </td>
                                                @php
                                                    $isReady = 'Ready';
                                                @endphp
                                            @else
                                                @php
                                                    $isReady = 'Needed';
                                                @endphp
                                                <td width="180" data-th="Net Amount" class="crew_btn">
                                                    <span class="active-btn-2"><img
                                                            src="{{ asset('assets/images/Button-Crew-Needed.png') }}"
                                                            class="alrt-image" alt=""> Crew Needed</span>
                                                </td>
                                            @endif
                                        @endif
                                        <td class="action">

                                            <div class="dropdown">
                                                <button class="btn" type="button" id="BtnAction" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                    <!-- <a class="dropdown-item" href="{{ route('all-activities-edit', [$trip->id, $isReady]) }}">1Edit</a>
                                                     <a class="dropdown-item" href="#">Delete</a> -->

                                                    @if (Session::get('role') != 'crewmember')
                                                        <a class="dropdown-item"
                                                            href="{{ route('all-activities-view', [$trip->id, $isReady]) }}">View
                                                            Activity</a>

                                                        <a class="dropdown-item"
                                                            href="{{ route('all-activities-edit', [$trip->id, $isReady]) }}">Edit
                                                            Activity</a>
                                                        @if ($trip->archived == null || $trip->archived == '')
                                                            <a class="dropdown-item" href="#"
                                                                onclick="DeleteActivity('{{ $trip->id }}')">Delete
                                                                Activity</a>
                                                            {{-- @else --}}
                                                            {{-- <a class="dropdown-item" href="#">Not Editable</a> --}}
                                                        @endif

                                                        {{-- <a class="dropdown-item" href="{{ route('all-activities-edit', [$trip->id,$isReady]) }}">Edit Activity</a> --}}
                                                    @else
                                                        <a class="dropdown-item"
                                                            href="{{ route('all-activities-view', [$trip->id, $isReady]) }}">View
                                                            Activity</a>

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
                                                        <a class="dropdown-item"
                                                            href="<?php echo $route; ?>"><?php echo $isAvailable; ?></a>
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


    function ShowWarningAlert(msg, id) {

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
                console.log('deleteID');
                window.location.href = "{{ URL::to('all-activites-delete') }}/" + id;
                // Swal.fire(
                //     'Deleted!',
                //     'Your file has been deleted.',
                //     'success'
                // )
            }
            return result.isConfirmed
        });


    }

    function DeleteActivity(id) {

        if (ShowWarningAlert('Do You Want Delete ?', id)) {
            // window.location.href = "{{ URL::to('all-activites-delete') }}/" + id;
        }

    }


    // function DeleteActivity(id) {

    //     if (ShowWarningAlert('Do You Want Delete ?')) {
    //         window.location.href = "{{ URL::to('dashboard-activites-delete') }}/" + id;
    //     }

    // }
</script>
