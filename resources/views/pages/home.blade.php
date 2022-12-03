@extends('layouts.default')

@section('content')

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
                            <span>{{ $month_logins }}</span>
                            {{-- Logins <br> This Month --}}
                            Hours Logged <br> This Month

                        </p>

                    </div>

                </div>

                <div class="col-lg-3 col-md-12 teck-third-colum">

                    <div class="icon-box">

                        <img src="{{ asset('assets/images/3.png') }}" class="img-box" alt="">

                        <p>
                            <span>{{$year_logins}}</span>
                            {{-- Logins <br> This Year --}}
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
                            <h4>Your upcoming activities <span class="circle-green">{{$upcoming_activites->count()}}</span></h4>
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

                        <table class="rwd-table" id="datatables1">
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

                                    $check_crewcount = ($crewneeded < $tripcrewscount) ? true : false; // echo $check_crewcount."<br>";

                                    @endphp

                                    <tr class="{{ ($check_crewcount == false) ? 'teck-danger' : "" }}">

                                        <td>
                                            <div class="table-div">
                                                {{-- {{ $crewneeded." ___ ". $tripcrewscount }} --}}
                                                <img src="{{ asset('assets/images/Picture-01.png') }}" class="img-fluid" alt="">
                                                <p> <b>{{$trip->boatname}}</b> <br> #{{ $trip->id }} </p>
                                            </div>
                                        </td>
                                        <td>{{ date('D d M Y H:i A', strtotime($trip->departuredate)) }}</td>
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
                                                @foreach ($trip->tripcrews as $tripcrewitem )
                                                    {{ $tripcrewitem->crewcode }},
                                                    {{-- {!! ( ($tripcrewscount % 3 == 0)) ? '<br>' : "" !!} --}}
                                                @endforeach
                                            @else
                                            --
                                            @endif
                                        </td>

                                        @if(($check_crewcount == true) ? 'teck-danger' : "" )

                                            <td data-th="Net Amount">
                                                <span class="active-btn">
                                                    <img src="{{ asset('assets/images/Activity-Ready-Button.png') }}" class="img-fluid" alt=""> Activity Ready</span>
                                            </td>
                                        @else
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

                                                    @if(Session::get('role')=='crewmember')
                                                    <a class="dropdown-item" href="{{ route('all-activities-view', $trip->id) }}">View</a>

                                                    <?php

                                                    $initials = Session::get('initials');

                                                    $check = \App\Models\Tripcrew::where(['crewcode' => $initials, 'tripnumber' => $trip->id])->get();

                                                    if (!empty($check)) {

                                                        foreach ($check as $c) {
                                                            if ($c->available == 'Y') {
                                                                $isAvailable = "I'm Available";
                                                                $route = route('all-activities-available-unavailable', $trip->id);
                                                            } else {
                                                                $isAvailable = 'Not Available';
                                                                $route = route('all-activities-available-unavailable', $trip->id);
                                                            }
                                                        }
                                                    }

                                                    ?>

                                                    <a class="dropdown-item" href="<?php echo $route ?>"><?php echo $isAvailable ?></a>
                                                    @else
                                                    <a class="dropdown-item" href="{{ route('all-activities-view', $trip->id) }}">View</a>
                                                    <a class="dropdown-item" href="{{ route('all-activities-edit', $trip->id) }}">Edit</a>
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
                                        <span class="active-btn"><img
                                                src="{{ asset('assets/images/Activity-Ready-Button.png') }}"
                                                class="img-fluid" alt=""> Activity Ready</span>
                                    </td>

                                    <td class="action">

                                        <div class="dropdown">
                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                <a class="dropdown-item"
                                                    href="{{ route('all-activities-edit', 2) }}">Edit</a>
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
                                        <span class="active-btn-2"><img
                                                src="{{ asset('assets/images/Button-Crew-Needed.png') }}"
                                                class="alrt-image" alt=""> Crew Needed</span>
                                    </td>

                                    <td class="action">

                                        <div class="dropdown">
                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                <a class="dropdown-item"
                                                    href="{{ route('all-activities-edit', 2) }}">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-div">
                                            <img src="{{ asset('assets/images/Picture-02.png') }}" class="img-fluid"
                                                alt="">
                                            <p> <b> Henshall </b> <br> #7083 </p>
                                        </div>
                                    </td>
                                    <td>Tue 26th July '22 <br> 09:00 AM</td>
                                    <td>Tuesday Bacon Cob Cruise</td>
                                    <td>8 hours</td>
                                    <td>6 Crew Members</td>
                                    <td data-th="Net Amount">ADL, CH, KW1,<br> PLE, AB, JKL</td>
                                    <td data-th="Net Amount">
                                        <span class="active-btn"><img
                                                src="{{ asset('assets/images/Activity-Ready-Button.png') }}"
                                                class="img-fluid" alt=""> Activity Ready</span>
                                    </td>

                                    <td class="action">

                                        <div class="dropdown">
                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                <a class="dropdown-item"
                                                    href="{{ route('all-activities-edit', 2) }}">Edit</a>
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

                                        <span class="active-btn"><img
                                                src="{{ asset('assets/images/Activity-Ready-Button.png') }}"
                                                class="img-fluid" alt=""> Activity Ready</span>

                                    </td>
                                    <td class="action">
                                        <div class="dropdown">
                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                <a class="dropdown-item"
                                                    href="{{ route('all-activities-edit', 3) }}">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="teck-danger">

                                    <td data-th="Supplier Code">

                                        <div class="table-div">

                                            <img src="{{ asset('assets/images/Picture-02.png') }}" class="img-fluid"
                                                alt="">

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

                                        <span class="active-btn-2"><img
                                                src="{{ asset('assets/images/Button-Crew-Needed.png') }}" class="img-fluid"
                                                alt=""> Crew Needed</span>

                                    </td>
                                    <td class="action">

                                        <div class="dropdown">
                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                <a class="dropdown-item"
                                                    href="{{ route('all-activities-edit', 3) }}">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>

                                    </td>

                                </tr>

                                <tr>

                                    <td data-th="Supplier Code">

                                        <div class="table-div">

                                            <img src="{{ asset('assets/images/Picture-02.png') }}" class="img-fluid"
                                                alt="">

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

                                        <span class="active-btn"><img
                                                src="{{ asset('assets/images/Activity-Ready-Button.png') }}"
                                                class="img-fluid" alt=""> Activity Ready</span>

                                    </td>
                                    <td class="action">

                                        <div class="dropdown">
                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                <a class="dropdown-item"
                                                    href="{{ route('all-activities-edit', 3) }}">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>

                                    </td>

                                </tr>

                            </tbody>
                        </table> --}}
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
</script>
