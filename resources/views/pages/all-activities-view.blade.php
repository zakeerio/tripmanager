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
                        <span class="active-btn-ready"><img src="{{ asset('assets/images/Activity-Ready-Button.png') }}" class="img-fluid" alt=""> Activity Ready</span>
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
                            <input type="text" name="tripnumber" class="form-control" id="ActivityNumber" value="{{ $activity->tripnumber }}" readonly>
                        </div>
                        <div class="form-group col-xl-4 col-lg-6">
                            <label for="ActivityItem">SELECT ACTIVITY ITEM</label>

                            <select id="ActivityItem" name="boatname" class="form-control" readonly>
                                <option value="Seth Ellis">Seth Ellis</option>
                                <option value="Python" {{ $activity->boatname == 'Python' ? 'selected' : '' }}>Python
                                </option>
                                <option value="John Varley" {{ $activity->boatname == 'John Varley' ? 'selected' : '' }}>John Varley</option>
                                <option value="Hugh Henshall" {{ $activity->boatname == 'Hugh Henshall' ? 'selected' : '' }}>Hugh Henshall
                                </option>
                                <option value="Canal talks" {{ $activity->boatname == 'Canal talks' ? 'selected' : '' }}>Canal talks</option>
                                <option value="Dawn Rose" {{ $activity->boatname == 'Dawn Rose' ? 'selected' : '' }}>
                                    Dawn Rose</option>
                                <option value="Madeline" {{ $activity->boatname == 'Madeline' ? 'selected' : '' }}>
                                    Madeline</option>
                                <option value="James Brindley" {{ $activity->boatname == 'James Brindley' ? 'selected' : '' }}>James Brindley
                                </option>
                                <option value="Shop" {{ $activity->boatname == 'Shop' ? 'selected' : '' }}>Shop
                                </option>
                            </select>


                        </div>
                        <div class="form-group col-xl-4 col-lg-12">
                            <label for="ActivityDate">ACTIVITY DATE</label>
                            <input type="date" name="departuredate" class="form-control" id="ActivityDate" value="{{ $activity->departuredate }}" readonly>

                        </div>
                    </div>



                    <div class="form-row">
                        <div class="form-group col-xl-4 col-lg-6">
                            <label for="ActivityTime">ACTIVITY TIME</label>
                            <input type="time" name="departuretime" class="form-control" id="ActivityTime" value="{{ $activity->departuretime }}" readonly>
                        </div>
                        <div class="form-group col-xl-4 col-lg-6">
                            <label for="ActivityDuration">ACTIVITY DURATION</label>
                            <input type="number" name="duration" class="form-control" id="ActivityDuration" value="{{ $activity->duration }}" readonly>
                        </div>
                        <div class="form-group col-xl-4 col-lg-12">
                            <label for="BriefDescription">BRIEF DESCRIPTION</label>
                            <input type="text" name="destination" class="form-control" id="BriefDescription" value="{{ $activity->destination }}" readonly>
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="col-lg-12 col-md-12 upcoming_activities">
                            <h4>Crew Information</h4>
                            <p class="col-12-descrapction">This information is regarding the crew of this activity.</p>
                        </div>
                        <div class="form-group col-xl-4 col-lg-12">
                            <label for="NumberCrewNeeded">NUMBER OF CREW NEEDED</label>
                            <input type="text" name="crewneeded" class="form-control" id="NumberCrewNeeded" value="{{ $activity->crewneeded }}" readonly>
                        </div>
                        <div class="form-group col-xl-5 col-lg-13">
                            <label for="TripCost">TRIP COST(£)</label>
                            <input type="number" name="tripcost" class="form-control" id="TripCost" value="{{ $activity->cost }}" readonly>
                        </div>
                        <div class="form-group col-xl-6 col-lg-14">
                            <label for="BalanceDue">BALANCE DUE(£)</label>
                            <input type="number" name="tripbalance" class="form-control" id="BalanceDue" value="{{ $activity->balance }}" readonly>
                        </div>
                        <div class="form-group col-xl-7 col-lg-15">
                            <label for="PassengerCout">PASSENGER COUNT</label>
                            <input type="number" name="passengers" class="form-control" id="PassengerCout" value="{{ $activity->passengers }}" readonly>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="NotesCrew">NOTES FOR CREW</label>
                        <textarea class="form-control" id="NotesCrew" rows="5" name="NotesCrew" readonly>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ornare orci sit amet dui sagittis porttitor. Aliquam suscipit ligula et nisl ullamcorper lacinia. Nunc sagittis vitae lectus sit amet tincidunt. Nullam tristique, orci a consequat vehicula, arcu diam vehicula eros.</textarea>
                    </div>
            </div>
            <br>
            <div class="row">


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

                        $fullname =$crew_name["fullname"];
                        if ($crewmember->confirmed == 'Y') {
                            $confirmed[] = "<input type='text' class='form-control' id=drag" . $crewmember->id . " draggable='true' ondragstart='drag(event)' name='' value='". $crewmember->crewcode ." : ". $fullname ."' disabled>";
                        }

                        if ($crewmember->available == 'Y') {
                            $available[] = "<input type='text' class='form-control' id=drag" . $crewmember->id . " draggable='true' ondragstart='drag(event)' name='' value='". $crewmember->crewcode ." : ". $fullname ."' disabled>";
                        }

                        if ($crewmember->skipper == 'Y') {
                            $available[] = "<input type='text' class='form-control' id=drag" . $crewmember->id . " draggable='true' ondragstart='drag(event)' name=''value='". $crewmember->crewcode ." : ". $fullname ."' disabled>";
                        }
                ?>

                <?php
                    }
                }

                ?>

                <div class="col-sm-4">
                    <label for="NotesCrew" class="label">Confirmed Crew</label>
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
                    <label for="NotesCrew" class="label">Available Crew</label>
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
                    <label for="NotesCrew" class="label">Un Available Crew</label>

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
