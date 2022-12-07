@extends('layouts.default')


<?php


// $test = DB::table('trips')->get();;

// echo $test;
// exit;
?>
@section('content')
<div class="row dashboard_col" id="analysis">
    <div class="col-md-12 dashboard_Sec">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <h1>Analysis</h1>
                <p class="sub-pages-text">This is a list all analysis results.</p>
                <a href="{{ URL::previous() }}" class="btn btn-primary">Go Back</a>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="btn-filter justify-content-end">
                    <div class="teck-btn bg-white">
                        <a href="#!"><img src="{{ asset('assets/images/rol icon.png') }}" class="btn-icon-2" alt="">
                            <span>Filter by Role <br> <b> Show all analysis</b></span> </a>

                        <ul class="teck-dropdown">
                            <li>Item 01</li>
                            <li>Item 02</li>
                            <li>Item 03</li>
                        </ul>
                    </div>
                </div>
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
                                <th class="th-heading">Boat</th>
                                <th class="th-heading-brief">Brief</th>
                                <th class="th-heading">Duration</th>
                                <th class="th-heading">Crew Needed</th>
                                <th class="th-heading">Crew</th>
                                <th></th>

                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($trips as $trip )

                            @php
                            $crewneeded = ($trip->crewneeded == null ) ? 0 : $trip->crewneeded;
                            $tripcrewscount = ($trip->tripcrews->count() <= 0 ) ? '0' : $trip->tripcrews->count();

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
                                        <td>{{$trip->boatname }}</td>

                                        <?php

                                        $month_hours = DB::table('trips')
                                            ->join('tripcrews', 'tripcrews.tripnumber', '=', 'trips.id')
                                            ->select(DB::raw('duration as duration,crewcode'))
                                            ->whereBetween('trips.departuredate', [date('Y-m-01'), date('Y-m-31')])
                                            ->get();

                                        $total_month_hours = 0;

                                        if (!empty($month_hours)) {

                                            foreach ($month_hours as $mh) {

                                                if (isset($mh->duration) && str_contains($mh->duration, ':')) {
                                                    $hours = explode(':', $mh->duration);

                                                    $hours =  ($hours[0]) + ($hours[1] / 60);

                                                    $total_month_hours += ceil($hours);
                                                }
                                            }
                                        } else {
                                            $total_month_hours = 0;
                                        }

                                        ?>
                                        <td width="250">{!! ($trip->crewnotes) !!}</td>

                                        <td>{{ $total_month_hours}} hours</td>
                                        <td>{{ $crewneeded }} Crew Members</td>
                                        <td width="120">
                                            @if($tripcrewscount > 0)
                                            @foreach ($trip->tripcrews as $tripcrewitem )


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

                                        <!-- <td data-th="Net Amount">
                                            <span class="active-btn">
                                                <img src="{{ asset('assets/images/Activity-Ready-Button.png') }}" class="img-fluid" alt=""> Activity Ready</span>
                                        </td> -->
                                        <?php
                                        $isReady = 'Ready';
                                        ?>
                                        @else
                                        <?php
                                        $isReady = 'Needed';
                                        ?>
                                        <!-- <td data-th="Net Amount" class="crew_btn">
                                            <span class="active-btn-2"><img src="{{ asset('assets/images/Button-Crew-Needed.png') }}" class="alrt-image" alt=""> Crew Needed</span>
                                        </td> -->

                                        @endif

                                        <td class="action">

                                            <div class="dropdown">
                                                <!-- <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </button> -->
                                                <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                    <!-- <a class="dropdown-item" href="{{ route('all-activities-view', [$trip->id,$isReady]) }}">View</a> -->
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

                                                    <!-- <a class="dropdown-item" href="<?php echo $route ?>"><?php echo $isAvailable ?></a> -->
                                                    @else

                                                    <!-- <a class="dropdown-item" href="{{ route('all-activities-edit',[$trip->id,$isReady]) }}">Edit</a>
                                                    <a class="dropdown-item" href="#" onclick="DeleteActivity('{{$trip->id}}')">Delete</a> -->
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


<!-- <div class="row btm-row">
    <div class="col-md-6 teck-showin-text">Showing <b>1-50</b> of <b>46</b> available activities.</div>
    <div class="col-md-6">
        <div class="pagination-row">
            <button class="btn-prev teck-arrow">
                < </button>
                    <ul class="pagination">
                        <li class="active"> 1 </li>
                        <li> 2 </li>
                        <li> 3 </li>
                        <li> 4 </li>
                    </ul>
                    <button class="btn-next teck-arrow">></button>
        </div>
    </div>
</div> -->

</div>
</div>
@stop
