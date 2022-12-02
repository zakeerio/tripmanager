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

        <h1>Activities - View an existing activity</h1>
        <p>Please amend any details below and click save changes to submit</p>

    </div>

    <div class="col-md-12 activies_table">

        <div class="row activity_col">

            <div class="col-md-12 dashboard-heading-desc">
                <div class="row">
                    <div class="col-lg-8 col-md-12 upcoming_activities">
                        <h4>Activity Information</h4>
                        <p class="col-12-descrapction">These details will be visible throughout the Activity Manager
                            system.</p>
                    </div>
                    <div class="col-lg-4 col-md-12 ready">
                        <lable>ACTIVITY STATUS</lable>
                        <?php

                        if ($status == 'Ready') {
                        ?>
                            <span class="active-btn-ready"><img src="{{ asset('assets/images/Activity-Ready-Button.png') }}" class="img-fluid" alt=""> Activity Read</span>
                        <?php
                        } else {
                        ?>
                           
                            
                               <span class="active-btn-2"><img src="{{ asset('assets/images/Button-Crew-Needed.png') }}" class="img-fluid" alt=""> Crew Needed</span>
                              
                            
                        <?php
                        }

                        ?>
                    </div>
                </div>
            </div>


            <div class="col-md-12">

                {{-- {{ dd($activity->tripcrews) }} --}}

                <form class="teck-form" method="post" action="{{ route('all-activites-update') }}">
                    @csrf

                    <input type="hidden" name="id" class="form-control" id="" value="{{ $activity->id }}">

                    <div class="form-row">
                        <div class="form-group col-xl-4 col-lg-6">
                            <label for="ActivityNumber">ACTIVITY NUMBER</label>
                            <strong>
                                <h5>{{ $activity->id }}</h5>
                            </strong>
                        </div>

                        <div class="form-group col-xl-4 col-lg-6">
                            <label for="ActivityItem">SELECT ACTIVITY ITEM</label>

                            <strong>
                                <h5>{{$activity->boatname}}</h5>
                            </strong>

                        </div>
                        <div class="form-group col-xl-4 col-lg-12">
                            <label for="ActivityDate">ACTIVITY DATE</label>
                            <strong>
                                <h5>{{ $activity->departuredate }}</h5>
                            </strong>

                        </div>
                    </div>



                    <div class="form-row">
                        <div class="form-group col-xl-4 col-lg-6">
                            <label for="ActivityTime">ACTIVITY TIME</label>

                            <strong>
                                <h5>{{$activity->departuretime }}</h5>
                            </strong>
                        </div>
                        <div class="form-group col-xl-4 col-lg-6">
                            <label for="ActivityDuration">ACTIVITY DURATION</label>
                            <strong>
                                <h5>{{ $activity->duration }}</h5>
                            </strong>
                        </div>
                        <div class="form-group col-xl-4 col-lg-12">
                            <label for="BriefDescription">BRIEF DESCRIPTION</label>
                            <strong>
                                <h5>{{ $activity->destination }}</h5>
                            </strong>
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="col-lg-12 col-md-12 upcoming_activities">
                            <h4>Crew Information</h4>
                            <p class="col-12-descrapction">This information is regarding the crew of this activity.</p>
                        </div>
                        <div class="form-group col-xl-4 col-lg-12">
                            <label for="NumberCrewNeeded">NUMBER OF CREW NEEDED</label>
                            <strong>
                                <h5>{{ $activity->crewneeded }}</h5>
                            </strong>
                        </div>
                        <div class="form-group col-xl-5 col-lg-13">
                            <label for="TripCost">TRIP COST(£)</label>
                            <strong>
                                <h5>{{ $activity->cost }}</h5>
                            </strong>
                        </div>
                        <div class="form-group col-xl-6 col-lg-14">
                            <label for="BalanceDue">BALANCE DUE(£)</label>

                            <strong>
                                <h5>{{ $activity->balance }}</h5>
                            </strong>
                        </div>
                        <div class="form-group col-xl-7 col-lg-15">
                            <label for="PassengerCout">PASSENGER COUNT</label>
                            <strong>
                                <h5>{{ $activity->passengers }}</h5>
                            </strong>
                        </div>
                    </div>

                    <div class="form-group col-xl-6 col-lg-14">
                        <label for="NotesCrew">NOTES FOR CREW</label>
                        <p><strong>{{ $activity->crewnotes }}</strong></p>
                    </div>
            </div>
            <br>
            <div class="row col-md-12">


                <?php


                // echo "<pre>";
                // print_r($activity->tripcrews);
                // exit;

                $unavailable = array();
                $confirmed = array();
                $avaiable = array();


                foreach ($activity->tripcrews as $key => $crewmember) {

                    $crew_name = \App\Models\Crew::where(['initials' => $crewmember->crewcode])->first();

                    // if (isset($crew_name['fullname'])) {
                    //     echo "<pre>";
                    //     print_r($crew_name['fullname']);
                    // }

                    // echo "<pre>";
                    // print_r($crew_name['fullname']);

                    if (!empty($crew_name) && isset($crew_name['fullname'])) {
                        //  echo $crew_name[0] . "<br>";

                        $fullname = $crew_name["fullname"];
                        if ($crewmember->confirmed == 'Y') {
                            $confirmed[] = "<input type='text' class='form-control' id=drag" . $crewmember->id . " draggable='true' ondragstart='drag(event)' name='' value='" . $crewmember->crewcode . " : " . $fullname . "' disabled>";
                        }

                        if ($crewmember->available == 'Y') {
                            $available[] = "<input type='text' class='form-control' id=drag" . $crewmember->id . " draggable='true' ondragstart='drag(event)' name='' value='" . $crewmember->crewcode . " : " . $fullname . "' disabled>";
                        }

                        if ($crewmember->isskipper == 'Y') {
                            $unavailable[] = "<input type='text' class='form-control' id=drag" . $crewmember->id . " draggable='true' ondragstart='drag(event)' name=''value='" . $crewmember->crewcode . " : " . $fullname . "' disabled>";
                        }
                ?>

                <?php
                    }
                }

                ?>

                <div class="col-sm-4">
                    <label for="NotesCrew" class="confirm_label">Confirmed Crew</label>
                    <div id="div2" ondrop="drop(event,this)" ondragover="allowDrop(event)" content="confiremd[]">
                        <?php

                        if (!empty($confirmed)) {
                            foreach ($confirmed as $c) {
                                echo $c;
                            }
                        } else {
                            echo "No Confirmed Found";
                        }

                        ?>
                    </div>
                </div>

                <div class="col-sm-4">
                    <label for="NotesCrew" class="available_label">Available Crew</label>
                    <div id="div3" ondrop="drop(event,this)" ondragover="allowDrop(event)" content="available[]">
                        <?php

                        if (!empty($available)) {
                            foreach ($available as $a) {
                                echo $a;
                            }
                        } else {
                            echo "No Available Found";
                        }

                        ?>
                    </div>
                </div>


                <div class="col-sm-4">
                    <label for="NotesCrew" class="unavailable_label">Un Available Crew</label>

                    <div id="div1" ondrop="drop(event,this)" ondragover="allowDrop(event)" content="unavailable[]">
                        <?php

                        if (!empty($unavailable)) {
                            foreach ($unavailable as $ua) {
                                echo $ua;
                            }
                        } else {
                            echo "No UnAvailable Found";
                        }
                        ?>
                    </div>

                </div>


            </div>
            <div class="teck-btn">
                <button type="submit" class="btn btn-primary" style="display: none;"> <img src="{{ asset('assets/images/save.svg') }}" class="img-fluid"> Update Activity</button>
            </div>
            </form>


        </div>

    </div>

</div>

@stop