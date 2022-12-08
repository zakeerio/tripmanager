@extends('layouts.default')

@section('content')
<div class="row dashboard_col" id="my-activities">
    <div class="col-md-12 dashboard_Sec">
        <div class="row">
            <div class="col-xl-8 col-lg-12 teck-acticites">
                <h1>My Activities</h1>
                <p>This is a list of all the scheduled activities in the Activity Manager system..</p>




                    <a href="{{ URL::previous() }}" class="btn btn-primary">Go Back</a>

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
                                <td>{{ $trip->duration }} hours</td>
                                <td>{{ $trip->crewneeded }}</td>

                                <td width="250">
                                    <?php

                                    $i = 0;
                                    $initials = Session::get('initials');

                                    $members = \App\Models\Tripcrew::where(['tripnumber' => $trip->id])->get();

                                    if (!empty($members)) {

                                        foreach ($members as $m) {
                                            if ($m->available == 'Y') {
                                                echo $m->crewcode . ",";
                                            }
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
                                    if ($trip->crewneeded < $i) {
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
                                            <a class="dropdown-item" href="{{ route('all-activities-view',  [$trip->id,$isReady]) }}">View</a>
                                            <a class="dropdown-item" href="{{ route('all-activities-edit',  [$trip->id,$isReady]) }}">Edit</a>
                                            <a class="dropdown-item" href="#" onclick="DeleteActivity('{{$trip->id}}')">Delete</a>
                                            @else

                                            <a class="dropdown-item" href="{{ route('all-activities-view',[$trip->id,$isReady]) }}">View</a>
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
            <div class="teck-table"> </div>


        </div>
    </div>

    @if ($trips->hasPages())

    <div class="row btm-row">
        {{-- {{ $trips->links() }} --}}

        {{-- <div class="col-md-6 teck-showin-text">Showing <b>1-50</b> of <b>46</b> available activities.</div>

                        <div class="col-md-6">

                            <div class="pagination-row">

                                <button class="btn-prev teck-arrow"><</button>

                                <ul class="pagination">

                                    <li class="active"> 1 </li>

                                    <li> 2 </li>

                                    <li> 3 </li>

                                    <li> 4 </li>

                                </ul>

                                <button class="btn-next teck-arrow">></button>

                            </div>

                        </div> --}}

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

    function DeleteActivity(id) {

        if (confirm('Do You Want Delete ?')) {
            window.location.href = "{{URL::to('all-activites-delete')}}/" + id;
        }

    }
</script>
