@extends('layouts.default')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">


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
            <div class="col-xl-8 col-lg-12 teck-acticites">

            </div>
            <div class="col-xl-4 col-lg-12">
                <div class="teck-btn justify-content-end" id="teck-btn-pag-3">
                     <a href="/all-activities/" class="btn btn-primary"><img src="{{ asset('assets/images/go_back.png') }}" class="img-fluid" style="width:20px;"> Go Back</a>
                </div>
            </div>



    <div class="col-md-12 activies_table">

        <div class="row activity_col">
            <div class="col-md-12">
                <div class="col-md-12 dashboard-heading-desc dashboard-heading-container">
                   <div class="row">
                      <div class="col-lg-12">
                        <h1>All Activities - Edit an existing activity</h1>
                        <p class="col-12-descrapction">To update an activities details, please edit the required fields and press the "Update Activity" button.</p>
                 </div>
            </div>

         </div>

            <div class="col-md-12 dashboard-heading-desc">
                <div class="row">
                    <div class="col-lg-8 col-md-12 upcoming_activities">
                        <h4>Activity Information</h4>
                        <p class="col-12-descrapction">These details will be visible throughout the Activity Manager
                            system.</p>

                    </div>
                    <div class="col-lg-4 col-md-12 ready">
                        <label>ACTIVITY STATUS</label>
                        <div class="" style="max-width: 190px;">
                        @php

                            use Illuminate\Validation\Rules\Unique;
                            @endphp

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


                    @php
                        $archivedisabled = ($activity->archived == "Y") ? "disabled" : "";
                    @endphp

                    {{ $archivedisabled }}

                    <input type="hidden" name="id" class="form-control" required id="" value="{{ $activity->id }}">

                    <div class="form-row">
                        <div class="form-group col-xl-2 col-lg-6">
                            <label for="ActivityNumber">ACTIVITY NUMBER</label>
                            <input type="text" name="tripnumber" class="form-control" required id="ActivityNumber" value="{{ $activity->id }}" disabled>

                            @if($errors->any())
                            <p style="color:Red">{{$errors->first('tripnumber')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-xl-4 col-lg-6">
                            <label for="ActivityItem">SELECT ACTIVITY ITEM</label>

                            <select id="ActivityItem" name="boatname" class="form-control" required {{ $archivedisabled }}>


                                <option value="">__SELECT__</option>
                                <?php


                                $boats = \App\Models\ActivityItem::all();

                                if (!empty($boats)) {

                                    foreach ($boats as $b) {
                                ?>
                                        <option data-id="{{ $b->activitycapacity }}" value="{{$b->activityname}}" {{ $b->activityname == $activity->boatname  ? 'selected' : '' }}>{{$b->activityname}}</option>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <option value="">No Activity Found</option>
                                <?php
                                }

                                ?>

                            </select>
                            @if($errors->any())
                            <p style="color:Red">{{$errors->first('boatname')}}</p>
                            @endif

                        </div>
                        <div class="form-group col-xl-2 col-lg-12">
                            <label for="ActivityDate">ACTIVITY DATE</label>
                            <input type="date" name="departuredate" class="form-control"  {{ $archivedisabled }} required id="ActivityDate" value="{{ $activity->departuredate }}">

                            @if($errors->any())
                            <p style="color:Red">{{$errors->first('departuredate')}}</p>
                            @endif

                        </div>
                         <div class="form-group col-xl-2 col-lg-6">
                            <label for="ActivityTime">ACTIVITY TIME</label>
                            <input type="time" name="departuretime" class="form-control" {{ $archivedisabled }} required id="ActivityTime" value="{{ $activity->departuretime }}">

                            @if($errors->any())
                            <p style="color:Red">{{$errors->first('departuretime')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-xl-2 col-lg-6">
                            <label for="ActivityDuration">ACTIVITY DURATION</label>
                            <input type="text" name="duration" class="form-control" required {{ $archivedisabled }} id="ActivityDuration" placeholder="Enter duration in decimal hours (2.5) rather than 2:30" value="{{ $activity->duration }}">

                            @if($errors->any())
                            <p style="color:Red">{{$errors->first('duration')}}</p>
                            @endif
                        </div>
                    </div>



                    <div class="form-row">

                        <div class="form-group col-xl-8 col-lg-12">
                            <label for="BriefDescription">BRIEF DESCRIPTION</label>
                            <input type="text" name="destination" class="form-control" required {{ $archivedisabled }} id="BriefDescription" value="{{ $activity->destination }}">

                            @if($errors->any())
                            <p style="color:Red">{{$errors->first('destination')}}</p>
                            @endif
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="col-lg-12 col-md-12 upcoming_activities">
                            <h4>Crew Information</h4>
                            <p class="col-12-descrapction">This information is regarding the crew of this activity.</p>
                        </div>
                        <div class="form-group col-xl-2 col-lg-12">
                            <label for="NumberCrewNeeded">NUMBER OF CREW NEEDED</label>
                            <input type="hidden" name="archived" value="{{ $activity->archived }}">
                            <input type="number" name="crewneeded" min="1" class="form-control" {{ $archivedisabled }} onchange="checkNumberCrewNeeded(this)" oldval="{{ $activity->crewneeded }}"  required id="NumberCrewNeeded" value="{{ $activity->crewneeded }}">
                            <div class="crew-exceed alert alert-danger d-none"></div>

                            @if($errors->any())
                            <p style="color:Red">{{$errors->first('crewneeded')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-xl-2 col-lg-13">
                            <label for="TripCost">TRIP COST(£)</label>
                            <input type="number" name="tripcost" class="form-control"  id="TripCost" value="{{ $activity->cost }}">

                            @if($errors->any())
                            <p style="color:Red">{{$errors->first('tripcost')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-xl-2 col-lg-14">
                            <label for="BalanceDue">BALANCE DUE(£)</label>
                            <input type="number" name="tripbalance" class="form-control"  id="BalanceDue" value="{{ $activity->balance }}">

                            @if($errors->any())
                            <p style="color:Red">{{$errors->first('tripbalance')}}</p>
                            @endif

                        </div>
                        <div class="form-group col-xl-2 col-lg-15">
                            <label for="PassengerCout">PASSENGER COUNT</label>
                            <input type="number" name="passengers" class="form-control"  id="PassengerCout" value="{{ $activity->passengers }}">

                            @if($errors->any())
                            <p style="color:Red">{{$errors->first('passengers')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="NotesCrew">NOTES FOR CREW</label>
                            <textarea class="form-control" id="NotesCrew" rows="5" name="NotesCrew">{{ $activity->crewnotes}}</textarea>

                            @if($errors->any())
                                <p style="color:Red">{{$errors->first('NotesCrew')}}</p>
                                @endif
                        </div>
                    </div>


                    <br>
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
                    <div id="confirm_msg" class="alert alert-danger d-none mt-4"></div>

                    <div class="teck-btn mt-4">
                        <button type="submit" class="btn btn-primary"> <img src="{{ asset('assets/images/save.svg') }}" class="img-fluid"> Update Activity</button>
                    </div>
            </div>


            </form>


        </div>


    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>


$(document).ready(function(){
    var connected_sortable = '{{ $activity->archived }}';
    console.log(connected_sortable);
    setTimeout(() => {
        if (connected_sortable != 'Y'){
            $( init );
        }
    }, 2000);


})


function init() {
    $(".droppable-area11, .droppable-area22, .droppable-area33").sortable({
        connectWith: ".connected-sortable",
        stack: '.connected-sortable',
        revert: true,
        stop: function(){
            // console.log($(this).text().trim());
            var targetname = $(this).closest('.connected-sortable').attr('target')
            // console.log(targetname);

            return dropconfirmedcheck($(this));
            // return false;
        },
        update: function(){
            // console.log("Updated");
            updateafterdrop($(this));

        }
    }).disableSelection();
}

function updateafterdrop(value){
    var targetname = value.closest('.connected-sortable').attr('target');

    value.find('input[type=hidden]').attr('name', targetname+"[]");


    if(targetname == "confirmed") {
        $("#div2 li").removeClass('crewlead')
        $("#div2 li.draggable-item:first").addClass('crewlead')
    }
    // console.log(value.closest('.connected-sortable').attr('target'))
}





    // function allowDrop(ev, th) {
    //     ev.preventDefault();

    // }

    // function drag(ev, th) {
    //     ev.dataTransfer.setData("text", ev.target.id);

    // }

    // function drop(ev, th) {
    //     ev.preventDefault();


    //     var original_crewcount = `{{ $activity->crewneeded }}`;

    //     var NumberCrewNeeded = $("#NumberCrewNeeded").val();

    //     // console.log(NumberCrewNeeded, crewcount);

    //     var crewcount = (original_crewcount == NumberCrewNeeded) ? original_crewcount : NumberCrewNeeded;


    //     console.log('drag drop');
    //     var data = ev.dataTransfer.getData("text");

    //     // get Current drop target to identify if this is confirmed it should restrict dropping
    //     var targetval = th.getAttribute('target');
    //     // console.log(data);



    //     var confirm_count = 0;
    //     $('#div2').find('input[type="text"]').each(function() {

    //         confirm_count += 1;
    //         // alert("Filled Value=" + $(this).val());

    //     });
    //     // alert("Total Input Count=" + $('#container').find('input[type="text"]').length + "//Filled Inputs Count=" + count);
    //     console.log(confirm_count , crewcount);
    //     if (confirm_count >= crewcount && targetval == 'confirmed') {
    //         $("#confirm_msg").removeClass('d-none');

    //         document.getElementById('confirm_msg').innerHTML='Limit Reached Of '+crewcount;
    //         document.getElementById('div2').setAttribute('ondrop', ' ')

    //     } else {
    //         $("#confirm_msg").addClass('d-none');

    //         document.getElementById('div2').setAttribute('ondrop', 'drop(event,this)')
    //         document.getElementById('confirm_msg').innerHTML='';

    //         ev.target.appendChild(document.getElementById(data));
    //         document.getElementById(data).setAttribute('name', th.getAttribute('content'));
    //     }
    // }


    function dropconfirmedcheck(checkval) {


        var original_crewcount = `{{ $activity->crewneeded }}`;

        var NumberCrewNeeded = $("#NumberCrewNeeded").val();

        // console.log(NumberCrewNeeded, crewcount);

        var crewcount = (original_crewcount == NumberCrewNeeded) ? parseInt(original_crewcount) : parseInt(NumberCrewNeeded);

        // get Current drop target to identify if this is confirmed it should restrict dropping

        var targetval = checkval.closest('.connected-sortable').attr('target');

        // checkval.closest('.connected-sortable li').removeClass('test');

        checkval.closest('.connected-sortable li:first').addClass('test');

        var confirm_count = 0;

        $(".droppable-area11 li, .droppable-area22 li").removeClass('crewlead');

        if(targetval == "confirmed") {
            $("#div2 li").removeClass('crewlead')
            $("#div2 li.draggable-item:first").addClass('crewlead')
        }

        $('#div2').find('input[type="hidden"]').each(function() {

            confirm_count += 1;
            // alert("Filled Value=" + $(this).val());

        });
        // alert("Total Input Count=" + $('#container').find('input[type="text"]').length + "//Filled Inputs Count=" + count);
        if (confirm_count > crewcount) {
            console.log(confirm_count , crewcount);
            $("#confirm_msg").removeClass('d-none');

            $('#confirm_msg').html('Limit Reached Of '+crewcount);
            return false;

        } else {
            $("#confirm_msg").addClass('d-none');

            $('#confirm_msg').html('');

        }
    }


    function checkNumberCrewNeeded(id){
        var crewneeded = parseInt($(id).val());
        var activity_seelcted_val = parseInt($('#ActivityItem').find('option:selected').attr('data-id'));
        var activity_seelcted_name = $('#ActivityItem').find('option:selected').text();

        var confirm_count = 0;
        $('#div2').find('input[type="hidden"]').each(function() {

            confirm_count += 1;
            // alert("Filled Value=" + $(this).val());

        });


        if(crewneeded > activity_seelcted_val || crewneeded < confirm_count){
            $(".crew-exceed").removeClass('d-none').html('Crew Members not allowed more then '+activity_seelcted_val+ " for activity type "+activity_seelcted_name+" and less then current Confirmed crew members");
            $(id).val($(id).attr('oldval'));
            // alert("exceeded-"+activity_seelcted_val+"--"+ crewneeded)
        } else {
            $(".crew-exceed").html('').addClass('d-none');
            // alert("fine-"+activity_seelcted_val+"--"+ crewneeded)

        }

    }

</script>
@stop
