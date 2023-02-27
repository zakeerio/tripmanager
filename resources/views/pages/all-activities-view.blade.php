@extends('layouts.default')

@section('content')

<style>
    #div1 {
        width: 350px;
        height: 370px !important;
        padding: 10px;
        border: 1px solid #aaaaaa;
        height: 100px;
        overflow: scroll;
        overflow-y: auto;
        background-color: #00b894;
    }

    #div3 {
        width: 350px;
        height: 370px !important;
        padding: 10px;
        border: 1px solid #aaaaaa;
        height: 100px;
        overflow: scroll;
        overflow-y: auto;
        background-color: #f39c12;
    }

    #div2 {
        width: 350px;
        height: 370px !important;
        padding: 10px;
        border: 1px solid #aaaaaa;
        height: 100px;
        overflow: scroll;
        overflow-y: auto;
        background-color: #2ecc71;
    }

    .connected-sortable li.draggable-item {
        cursor: move;
        /* fallback: no `url()` support or images disabled */
        cursor: url(images/grab.cur);
        /* fallback: Internet Explorer */
        cursor: -webkit-grab;
        /* Chrome 1-21, Safari 4+ */
        cursor: -moz-grab;
        /* Firefox 1.5-26 */
        cursor: grab;
        /* W3C standards syntax, should come least */
    }


    .unavailable_label {
        color: #00b894 !important;
    }

    .available_label {
        color: #f39c12 !important;
    }

    .confirm_label {
        color: #2ecc71 !important;
    }
</style>
<div class="row dashboard_col" id="all-activities-edit">

    <div class="col-md-12 dashboard_Sec">
<div class="row">
            <div class="col-xl-8 col-lg-12 teck-activities">

            </div>
            <div class="col-xl-4 col-lg-12">
                <div class="teck-btn justify-content-end" id="teck-btn-pag-3">
                     <a href="/all-activities/" class="btn btn-primary"><img src="{{ asset('assets/images/go_back.png') }}" class="img-fluid" style="width:20px;"> Go Back</a>
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

    <div class="col-md-12 activies_table">

        <div class="row activity_col">
            <div class="col-md-12">
                <div class="col-md-12 dashboard-heading-desc dashboard-heading-container">
                   <div class="row">
                      <div class="col-lg-12">
                        <h1>View Activity</h1>
                        <p class="col-12-descrapction">Please the information for the activity below.</p>
                 </div>
            </div>

         </div>
            <div class="col-md-12 dashboard-heading-desc">
                <div class="row">
                    <div class="col-lg-8 col-md-12 upcoming_activities">
                        <h4>Activity Information</h4>
                        <p class="col-12-descrapction">This information is regarding the details of this activity.</p>
                    </div>
                    <div class="col-lg-4 col-md-12 ready">

                        <label>ACTIVITY STATUS</label>
                        <div class="" style="max-width: 190px;">


                            @if($status == 'completed')
                                <span class="active-btn"><img src="{{ asset('assets/images/Activity-Ready-Button.png') }}" class="img-fluid" alt=""> Completed</span>

                            @elseif($status == 'Ready')

                                <span class="active-btn"><img src="{{ asset('assets/images/Activity-Ready-Button.png') }}" class="img-fluid" alt=""> Activity Ready</span>
                            @else

                                <span class="active-btn-2"><img src="{{ asset('assets/images/Button-Crew-Needed.png') }}" class="img-fluid" alt=""> Crew Needed</span>

                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12">

                {{-- {{ dd($activity->tripcrews) }} --}}

                <form class="teck-form" method="post" action="{{ route('all-activites-update') }}">
                    @csrf

                    <input type="hidden" name="id" class="form-control" id="" value="{{ $activity->id }}">

                    <div class="form-row">
                        <div class="form-group col-xl-2 col-lg-6">
                            <label for="ActivityNumber">ACTIVITY NUMBER:</label>
                                <p>{{ $activity->id }}</p>

                        </div>
                        <div class="form-group col-xl-2 col-lg-6">
                            <label for="ActivityItem">ACTIVITY ITEM:</label>
                                <p>{{$activity->boatname}}</p>
                        </div>
                        <div class="form-group col-xl-2 col-lg-12">
                            <label for="ActivityDate">ACTIVITY DATE:</label>
                                <p>{{ $activity->departuredate }}</p>
                        </div>
                                                <div class="form-group col-xl-2 col-lg-6">
                            <label for="ActivityTime">ACTIVITY TIME:</label>

                                <p>{{$activity->departuretime }}</p>

                        </div>
                        <div class="form-group col-xl-2 col-lg-6">
                            <label for="ActivityDuration">ACTIVITY DURATION:</label>

                                <p>{{ $activity->duration }}</p>

                        </div>
                    </div>



                    <div class="form-row">

                        <div class="form-group col-xl-8 col-lg-12">
                            <label for="BriefDescription">BRIEF DESCRIPTION:</label>

                                <p>{{ $activity->destination }}</p>

                        </div>
                    </div>



                    <div class="form-row">
                        <div class="col-lg-12 col-md-12 upcoming_activities">
                            <h4>Crew Information</h4>
                            <p class="col-12-descrapction">This information is regarding the crew of this activity.</p>
                        </div>
                        <div class="form-group col-xl-3 col-lg-12">
                            <label for="NumberCrewNeeded">NUMBER OF CREW NEEDED:</label>

                                <p>{{ $activity->crewneeded }}</p>

                        </div>
                        <div class="form-group col-xl-2 col-lg-13">
                            <label for="TripCost">TRIP COST(£):</label>

                                <p>£{{ $activity->cost }}</p>

                        </div>
                        <div class="form-group col-xl-2 col-lg-14">
                            <label for="BalanceDue">BALANCE DUE(£):</label>

                                <p>£{{ $activity->balance }}</p>

                        </div>
                        <div class="form-group col-xl-2 col-lg-15">
                            <label for="PassengerCout">PASSENGER COUNT:</label>

                                <p>{{ $activity->passengers }}</p>

                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-xl-6 col-lg-14">
                            <label for="NotesCrew">NOTES FOR CREW:</label>
                            <p>{{ $activity->crewnotes }}</p>
                        </div>
                    </div>

                    {{-- <div class="form-group col-xl-6 col-lg-14">
                        <label for="NotesCrew">Availablity Status</label>
                        <p><strong> {{(!empty($InNotIn['availStatus'])?$InNotIn['availStatus']:'N/A')}}</strong></p>
                    </div> --}}

            </div>
            <br>

            @if(Session::get('role') != 'crewmember')
            <div class="row">

                <?php


                // echo "<pre>";
                // print_r($activity->tripcrews);
                // exit;

                // $unavailable = array();
                $confirmed = array();
                $avaiable = array();

                $available_member = array();
                $crewlead = "";

                $counter = 0;

                foreach ($activity->tripcrews as $key => $crewmember) {
                    // dd($crewmember);

                    // $crew_name = \App\Models\Crew::where(['initials' => $crewmember->crewcode])->first();

                    $crew_name = \App\Models\Crew::join('users','users.id','crews.user_id')
                        ->where(['initials' => $crewmember->crewcode])
                        ->select('crews.*')
                        // ->orderBy('initials', 'ASC')
                        ->first();

                        // print_r($crew_name);

                    if (!empty($crew_name) && isset($crew_name['fullname'])) {
                        //  echo $crew_name[0] . "<br>";

                        $randome_no_1= uniqid();
                        $randome_no_2= uniqid();

                        $fullname = $crew_name["fullname"];
                        if ($crewmember->confirmed == 'Y' && $crewmember->isskipper != 'Y') {
                            if($counter !=1) {
                                $crewlead = "crewlead";
                                $counter = 1;
                            } else {
                                $crewlead = "";
                            }

                            $confirmed[] = "<li class='draggable-item form-control ".$crewlead."'><input type='hidden' name='confirmed[]' value='" . $crewmember->crewcode . " : " . $fullname . "' > ".$crewmember->crewcode . " : " . $fullname." </li>";

                            $available_member[] = $crew_name['initials'];
                        }

                        if ($crewmember->available == 'Y' && $crewmember->isskipper != 'Y') {
                            $available[] = "<li class='draggable-item form-control'><input type='hidden' name='available[]' value='" . $crewmember->crewcode . " : " . $fullname . "' >" . $crewmember->crewcode . " : " . $fullname . "</li>";

                            $available_member[] = $crew_name['initials'];
                        }

                        // if ($crewmember->isskipper == 'Y') {
                        //     $unavailable[] = "<input type='text' class='form-control' id=drag" . $crewmember->id . " draggable='true' ondragstart='drag(event)' name=''value='" . $crewmember->crewcode . " : " . $fullname . "' disabled>";
                        // }
                ?>

                <?php
                    }
                }

                ?>

                @php
                $connected_sortable = ($activity->archived !="Y" || $activity->archived =="" ) ? 'connected-sortable' : "";
                @endphp

                <div class="col-sm-4">
                    <label class="confirm_label">Confirmed Crew</label>
                    <ul id="div2"  class="{{ $connected_sortable }} droppable-area33" target="confirmed" >
                        <?php

                        if (!empty($confirmed)) {
                            foreach ($confirmed as $c) {
                                echo $c;
                            }
                        } else {
                            echo "No Confirmed Found";
                        }

                        ?>

                    </ul>
                </div>

                <div class="col-sm-4">
                    <label class="available_label">Available Crew</label>
                    <ul id="div3"  class="{{ $connected_sortable }} droppable-area22" target="available" >
                        <?php

                        if (!empty($available)) {
                            foreach ($available as $a) {
                                echo $a;
                            }
                        } else {
                            echo "No Available Found";
                        }

                        ?>
                    </ul>
                </div>


                <div class="col-sm-4">
                    <label class="unavailable_label">Un Available Crew</label>


                    <ul id="div1" class="{{ $connected_sortable }} droppable-area11" target="unavailable" >
                        <?php


                        $unavailable = DB::table('crews')
                        ->join('users','users.id','crews.user_id')
                        // ->where('users.role_id', 2)
                        ->whereNotIn('initials', array_unique($available_member))
                        ->select('crews.*')
                        ->orderBy('initials', 'ASC')
                        ->get();
                        // echo "<pre>";
                        // print_r($unavailable);
                        if (!empty($unavailable)) {
                            foreach ($unavailable as $ua) {
                                $randome_no_3= uniqid();
                                echo  "<li class='draggable-item form-control'><input type='hidden' value='" . $ua->initials . " : " . $ua->fullname . "' >" . $ua->initials . " : " . $ua->fullname . "</li>";
                            }
                        } else {
                            echo "No UnAvailable Found";
                        }

                        ?>
                    </ul>
                </div>
            </div>
            @endif
            <div class="teck-btn mt-4 pl-3">
            {{-- @if(Session::get('role') == 'crewmember') --}}
            @if($activity->archived != "Y")

                <div class="teck-btn-view-activites justify-content-end">

                    {{-- <a href="{{$InNotIn['route']}}" class="btn btn-primary">{{(!empty($InNotIn['isAvailable'])?$InNotIn['isAvailable']:'N/A')}}</a> --}}
                    <a href="{{$InNotIn['route']}}" class="btn btn-primary">{{$InNotIn['isAvailable']}}</a>

                </div>
                <br>
            @endif
            {{-- @endif --}}
                {{-- <button type="submit" class="btn btn-primary" > <img src="{{ asset('assets/images/save.svg') }}" class="img-fluid"> Update Activity</button> --}}
            </div>
            </form>


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
