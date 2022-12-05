@extends('layouts.default')

@section('content')

<div class="row dashboard_col" id="all-activities">
    <div class="col-md-12 dashboard_Sec">
        <div class="row">
            <div class="col-xl-8 col-lg-12 main-heading-desc all-activites-colum">
                <h1>All Activities</h1>
                <p>This is a list of all the scheduled activities in the Activity Manager system..</p>


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
                    <div class="teck-btn justify-content-start bg-white">
                        <a href="#!"><img src="{{ asset('assets/images/Activity-Items.png') }}" class="btn-icon-2" alt="">Filter by activity item </a>

                        <ul class="teck-dropdown">
                            <li>Item 01</li>
                            <li>Item 02</li>
                            <li>Item 03</li>
                        </ul>
                    </div>


                    @if(Session::get('user_type')==3)
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
                        <table class="rwd-table" id="datatables">
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
                                    // $tripcrewscount = ($trip->tripcrews->count() <= 0 ) ? '0' : $trip->tripcrews->count();
                                    $tripcrewscount_arr = DB::table('trips')
                                    ->join('tripcrews', 'trips.id', '=', 'tripcrews.tripnumber')
                                    ->where('tripcrews.crewcode', '=', SESSION::get('initials'))
                                    ->where('tripcrews.confirmed', '=', 'Y')
                                    ->where('trips.departuredate', '>=', date('Y-m-d'))
                                    ->where('trips.id', '=', $trip->id)
                                    ->distinct()
                                    ->select('tripcrews.*')->get();

                                    // dd($upcoming_activitescount->count());
                                    $tripcrewscount = $tripcrewscount_arr->count();

                                    $check_crewcount = ($crewneeded < $tripcrewscount) ? true : false; // echo $check_crewcount."<br>";

                                    @endphp

                                        <tr class="{{ ($check_crewcount == false) ? 'teck-danger' : "" }}">

                                            <td>
                                                <div class="table-div">
                                                    {{-- {{ $crewneeded." ___ ". $tripcrewscount }} --}}
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
                                            <td>{{$trip->departuredate }}</td>
                                            <td width="250px">{!! ($trip->crewnotes) !!}</td>
                                            <td>
                                            @php
                                                $durationhours = 0;
                                                if($trip->duration){
                                                    $durationex = explode(':',$trip->duration);
                                                    $minutes = ($durationex[1] > '00' ) ? $durationex[1]/60  : 0;
                                                    $hours = $minutes+$durationex[0];

                                                    $durationhours = number_format((float)$hours, 2, '.', '');
                                                }
                                            @endphp

                                            {{ $durationhours }} hours</td>
                                            <td>{{ $crewneeded }} Crew Members</td>
                                            <td width="120">
                                                @if($tripcrewscount > 0)
                                                @foreach ($tripcrewscount_arr as $tripcrewitem )


                                                @if($tripcrewitem->available=='Y')
                                                {{ $tripcrewitem->crewcode }},

                                                @endif
                                                {{-- {!! ( ($tripcrewscount % 3 == 0)) ? '<br>' : "" !!} --}}
                                                @endforeach
                                                @else
                                                --
                                                @endif
                                            </td>

                                            <?php

                                            $isReady = NULL;

                                            ?>
                                            @if(($check_crewcount == true) ? 'teck-danger' : "" )

                                            <td data-th="Net Amount">
                                                <span class="active-btn">
                                                    <img src="{{ asset('assets/images/Activity-Ready-Button.png') }}" class="img-fluid" alt=""> Activity Ready</span>
                                            </td>
                                            <?php
                                            $isReady = 'Ready';
                                            ?>
                                            @else
                                            <?php
                                            $isReady = 'Needed';
                                            ?>
                                            <td data-th="Net Amount" class="crew_btn">
                                                <span class="active-btn-2"><img src="{{ asset('assets/images/Button-Crew-Needed.png') }}" class="alrt-image" alt=""> Crew Needed</span>
                                            </td>

                                            @endif

                                            <td class="action">

                                                <div class="dropdown">
                                                    <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                        <a class="dropdown-item" href="{{ route('all-activities-view', [$trip->id]) }}">View Activity</a>
                                                        @if(Session::get('role')=='crewmember')


                                                        <?php

                                                        $initials = Session::get('initials');

                                                        $check = \App\Models\Tripcrew::where(['crewcode' => $initials, 'tripnumber' => $trip->id])->first();

                                                        if (!empty($check)) {

                                                            if ($check->available == 'Y') {
                                                                $isAvailable = "I'm Available";
                                                                $route = route('all-activities-available-unavailable', $trip->id);
                                                            } else {
                                                                $isAvailable = 'Not Available';
                                                                $route = route('all-activities-available-unavailable', $trip->id);
                                                            }
                                                        }


                                                        ?>

                                                        <a class="dropdown-item" href="<?php echo $route ?>"><?php echo $isAvailable ?></a>
                                                        @else

                                                        <a class="dropdown-item" href="{{ route('all-activities-edit',[$trip->id]) }}">Edit</a>
                                                        <a class="dropdown-item" href="#" onclick="DeleteActivity('{{$trip->id}}')">Delete</a>
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
    </div>
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


    function DeleteActivity(id) {

        if (confirm('Do You Want Delete ?')) {
            window.location.href = "{{URL::to('all-activites-delete')}}/" + id;
        }

    }
</script>
