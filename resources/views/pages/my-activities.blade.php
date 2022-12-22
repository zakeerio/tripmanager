@extends('layouts.default')

@section('content')
<div class="row dashboard_col" id="my-activities">
    <div class="col-md-12 dashboard_Sec">
        <div class="row">
            <div class="col-xl-8 col-lg-12 teck-acticites">
                <h1>My Activities</h1>
                <p>This is a list of all the scheduled activities in the Activity Manager system..</p>


                <div class="teck-btn justify-content-start">

                    <a href="{{ URL::previous() }}" class="btn btn-primary"><img src="{{ asset('assets/images/go_back.png') }}" class="img-fluid" style="width:26px; height:28px"> Go Back</a>
                </div>

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
            @if(Session::get('role') !='crewmember')
            <div class="col-xl-4 col-lg-12">
                <div class="teck-btn justify-content-end" id="teck-btn-pag-3">
                    <a href="{{ route('all-activities-create', auth()->user()->id ) }}"><img src="{{ 'assets/images/clander icon.png' }}" class="img-fluid">Create Activity</a>
                </div>
            </div>
            @endif
        </div>
    </div>


    <div class="col-md-12 activies_table">
        <div class="row activity_col">
            <div class="col-md-12">
                <div class="teck-table">
                    <table class="rwd-table" @if ($trips->count() > 0 ) id="datatables" @endif >
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


                            <?php

                            $confirme_crew = DB::table('tripcrews')
                                ->where('tripnumber', $trip->id)
                                // ->where('confirmed', 'Y')
                                // ->where('available', 'Y')
                                ->get()->count();


                            if (Session::get('role') == 'crewmember' && ($confirme_crew == $trip->crewneeded))
                                continue;

                            ?>

                            <tr class="">

                                <td width="300">

                                    <div class="table-div">

                                        <?php
                                        $boat = \App\Models\ActivityItem::where(['activityname' => $trip->boatname])->first();

                                        // print_r($boat->activitypicture);
                                        // exit;
                                        if (!empty($boat) && isset($boat->activityname) && file_exists(public_path() . '/assets/activity-images' . '/' . $boat->activitypicture)) {
                                        ?>

                                            <img src="{{asset('assets/activity-images').'/'.$boat->activitypicture}}" class="img-fluid" alt="">
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

                                <td>{{$trip->departuredate}}</td>
                                <td width="300">{{$trip->crewnotes }}</td>
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

                                    $members = \App\Models\Tripcrew::where(['tripnumber' => $trip->id])->get();

                                    if (!empty($members)) {

                                        foreach ($members as $m) {
                                            // if ($m->available == 'Y') {
                                                echo $m->crewcode . ",";
                                            // }
                                            $i++;
                                    ?>

                                    <?php
                                        }
                                    }

                                    ?>
                                </td>


                                <td width="250">



                                    <?php
                                    $isReady = NULL;

                                    $isReady = NULL;
                                    $confirme_crew = DB::table('tripcrews')
                                        ->where('tripnumber', $trip->id)
                                         ->where('confirmed', 'Y')
                                        // ->where('available', 'Y')
                                        ->get()->count();

                                    if ($confirme_crew == $trip->crewneeded) {

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

                                            @if(Session::get('role') !='crewmember')
                                            <a class="dropdown-item" href="{{ route('all-activities-view',  [$trip->id,$isReady]) }}">View Activity</a>
                                            <a class="dropdown-item" href="{{ route('all-activities-edit',  [$trip->id,$isReady]) }}">Edit Activity</a>
                                            <a class="dropdown-item" href="#" onclick="DeleteActivity('{{$trip->id}}')">Delete Activity</a>
                                            @else

                                            <a class="dropdown-item" href="{{ route('all-activities-view',[$trip->id,$isReady]) }}">View activity</a>
                                            <?php


                                                $initials = Session::get('initials');
                                                $check = \App\Models\Tripcrew::where(['crewcode' => $initials, 'tripnumber' => $trip->id])->first();

                                                //  dd($check);
                                                if (!empty($check)) {
                                                    // echo $check->available;
                                                if ($check->available == 'Y') {
                                                    $isAvailable = "I'm not available";
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


        </div>
    </div>

    @if ($trips->hasPages())

    <div class="row btm-row">
        {{ $trips->links('pagination::bootstrap-4') }}

    </div>

    @endif

</div>
</div>
@stop

<script>
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

    function DeleteActivity(id) {

        if (ShowWarningAlert('Do You Want Delete ?')) {
            window.location.href = "{{URL::to('all-activites-delete')}}/" + id;
        }

    }
</script>
