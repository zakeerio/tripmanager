@extends('layouts.default')

@section('content')

<div class="row dashboard_col" id="all-activities">
    <div class="col-md-12 dashboard_Sec">
        <div class="row">
            <div class="col-xl-8 col-lg-12 main-heading-desc all-activites-colum">
                <h1>All Activities</h1>
                <p>This is a list of all the scheduled activities in the Activity Manager system..</p>

                <div class="teck-btn justify-content-start">
                    @php
                        $check_filter = Request::get('filter');

                        $hidecompleted = Request::get('completed');


                        if(empty($hidecompleted)){
                            $hidecompleted_val = "?completed=hide";
                            $filter =  isset($check_filter) ? "&filter=".$check_filter : '';
                            $querystring = $hidecompleted_val.$filter;
                            $hidelabel = "Hide Completed";
                        } else {
                            $filter =  isset($check_filter) ? "?filter=".$check_filter : '';
                            $querystring = $filter;
                            $hidelabel = "Show Completed";

                        }
                    @endphp

                    {{-- Show hide completed button --}}

                    @if(Session::get('role') != 'crewmember')
                        <a href="{{ route('all-activities') }}{{ $querystring }}">{{ $hidelabel }}</a>
                    @endif


                    {{-- <a href="{{ URL::previous() }}" class="btn btn-primary"><img src="{{ asset('assets/images/go_back.png') }}" class="img-fluid" style="width:20px;"> Go Back</a> --}}
                </div>

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

            <div class="col-xl-4 col-lg-12 teck-btn-pag-2">
                <div class="btn-filter">
                    <div class="teck-btn filterbutton justify-content-start bg-white">
                        <a href="#!"><img src="{{ asset('assets/images/Activity-Items.png') }}" class="btn-icon-2" alt="">Filter by activity item </a>

                        @php
                            $check_completed = Request::get('completed');
                            $hidecompleted_cat =  isset($check_completed) ? "&completed=".$check_completed : '';
                            $querystring_cat = $hidecompleted_cat;

                        @endphp

                        <ul class="teck-dropdown">
                            @forelse ($activities_filter as $activity )
                                <li><a href="{{ route('all-activities') }}?filter={{ $activity->activityname }}{{ $querystring_cat }}">{{ $activity->activityname }}</a></li>
                            @empty
                                <li>Not found!</li>
                            @endforelse

                        </ul>
                    </div>


                    @if(Session::get('role') != 'crewmember')
                    <div class="teck-btn justify-content-end">
                        <a href="{{ route('all-activities-create') }}"><img src="{{ asset('assets/images/clander icon.png') }}" class="img-fluid">Create
                            Activity</a>
                    </div>
                    @endif

                </div>
            </div>
        </div>


        <div class="col-md-12 activies_table">
            <div class="row activity_col">
                <div class="col-lg-8 col-md-12 upcoming_activities">

                </div>

                <div class="col-md-12">
                    <div class="teck-table">
                        <table class="rwd-table" >

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

                                @forelse ($trips as $trip )

                                @php
                                $crewneeded = ($trip->crewneeded == null ) ? 0 : $trip->crewneeded;
                                $tripcrewscount = ($trip->tripcrews->count() <= 0 ) ? '0' : $trip->tripcrews->count();

                                    // $check_crewcount = ($crewneeded < $tripcrewscount) ? true : false; // echo $check_crewcount."<br>";

                                    $check_crewcount = 0; // echo $check_crewcount."<br>";


                                            @endphp


                                        <tr class="{{ ($check_crewcount == false) ? 'teck-danger' : "" }}">

                                            <td width="300">
                                                <div class="table-div">
                                                    {{-- {{ $crewneeded." ___ ". $tripcrewscount }} --}}
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
                                            </td>
                                            <td>{{$trip->departuredate }}</td>
                                            <td width="300" style="word-break: break-word;">{!! ($trip->crewnotes) !!}</td>
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
                                                        $durationfinal = $clock.".".(int)$minutes;
                                                    }
                                                @endphp
                                                {{ $durationfinal }} hours</td>
                                            <td>{{ $crewneeded }} Crew Members</td>
                                            <td width="250">
                                                @if($tripcrewscount > 0)
                                                @foreach ($trip->tripcrews as $tripcrewitem )
                                                @php
                                                $crew_name = \App\Models\Crew::where(['initials' => $tripcrewitem->crewcode])->first();
                                                @endphp


                                                @if($crew_name && $tripcrewitem->confirmed=='Y')
                                                    @php
                                                        $check_crewcount++;
                                                    @endphp
                                                    {{ $tripcrewitem->crewcode }},

                                                @endif
                                                {{-- {!! ( ($tripcrewscount % 3 == 0)) ? '<br>' : "" !!} --}}
                                                @endforeach
                                                @else
                                                --
                                                @endif
                                            </td>

                                            @php
                                                $isReady = NULL;
                                            @endphp

                                            @if($trip->archived == "Y")

                                                @php
                                                    $isReady = 'completed';
                                                @endphp

                                                <td width="200" data-th="Net Amount">
                                                    <span class="active-btn"><img src="{{ asset('assets/images/Activity-Ready-Button.png') }}" class="img-fluid" alt=""> Completed</span>
                                                </td>

                                            @else

                                                    @if(($check_crewcount >= $trip->crewneeded ) ? 'teck-danger' : "" )

                                                        <td width="200" data-th="Net Amount">
                                                            <span class="active-btn"><img src="{{ asset('assets/images/Activity-Ready-Button.png') }}" class="img-fluid" alt=""> Activity Ready</span>
                                                        </td>
                                                    @php
                                                    $isReady = 'Ready';
                                                    @endphp
                                                @else
                                                @php
                                                    $isReady = 'Needed';
                                                    @endphp
                                                    <td width="240" data-th="Net Amount" class="crew_btn">
                                                        <span class="active-btn-2"><img src="{{ asset('assets/images/Button-Crew-Needed.png') }}" class="alrt-image" alt=""> Crew Needed</span>
                                                    </td>

                                                @endif

                                            @endif



                                            <td class="action">

                                                <div class="dropdown">
                                                    <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                        <a class="dropdown-item" href="{{ route('all-activities-view', [$trip->id,$isReady]) }}">View Activity</a>
                                                        @if(Session::get('role')=='crewmember')


                                                        <?php

                                                        $initials = Session::get('initials');

                                                        $check = \App\Models\Tripcrew::where(['crewcode' => $initials, 'tripnumber' => $trip->id])->first();

                                                        if (!empty($check)) {

                                                            if ($check->available == 'Y' || $check->confirmed == 'Y') {
                                                                $isAvailable = "I'm not available";
                                                                $route = route('all-activities-available-unavailable', $trip->id);
                                                            } else {
                                                                $isAvailable = "I'm available";
                                                                $route = route('all-activities-available-unavailable', $trip->id);
                                                            }
                                                        }else{
                                                            $isAvailable = "I'm available";
                                                            $route = route('all-activities-available-unavailable', $trip->id);
                                                        }


                                                        ?>

                                                        <a class="dropdown-item" href="<?php echo $route ?>"><?php echo $isAvailable ?></a>
                                                        @else

                                                            @if($trip->archived ==NULL || $trip->archived =="")
                                                                <a class="dropdown-item" href="{{ route('all-activities-edit',[$trip->id,$isReady]) }}">Edit Activity</a>
                                                                <a class="dropdown-item" href="#" onclick="DeleteActivity('{{$trip->id}}')">Delete Activity</a>
                                                            @else
                                                                <a class="dropdown-item" href="#">Not Editable</a>
                                                            @endif

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
                                    </tbody>
                                </table>

                            @if ($trips->hasPages())

                            <div class="row btm-row">
                                {{ $trips->appends(request()->query())->links('pagination::bootstrap-4') }}

                            </div>

                        @endif
            </div>
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


    function ShowWarningAlert(msg,id) {


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
                window.location.href = "{{URL::to('all-activites-delete')}}/" + id;
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
            // window.location.href = "{{URL::to('all-activites-delete')}}/" + id;
        }

    }

    // function DeleteActivity(id) {

    //     if (confirm('Do You Want Delete ?')) {
    //         window.location.href = "{{URL::to('all-activites-delete')}}/" + id;
    //     }

    // }
</script>
