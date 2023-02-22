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

    #div1 input[type=text] {
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

    #div3 input[type=text] {
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

    #div3 input[type=text] {
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

<div class="row dashboard_col" id="all-activities-create">

    <div class="col-md-12 dashboard_Sec">

        <h1>All Activities - Create</h1>
        <p class="sub-pages-text">Please fill out the information below to create a activity.</p>
        <div class="teck-btn justify-content-start">

            <a href="{{ URL::previous() }}" class="btn btn-primary"><img src="{{ asset('assets/images/go_back.png') }}" class="img-fluid" style="width:20px;"> Go Back</a>
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

            <div class="col-md-12 dashboard-heading-desc">
                <div class="row">
                    <div class="col-lg-12 col-md-12 upcoming_activities">
                        <h4>Activity Information</h4>
                        <p class="col-12-descrapction">These details will be visible throughout the Activity Manager
                            system.</p>



                    </div>

                </div>
            </div>


            <div class="col-md-12">

                <form class="teck-form" method="post" action="{{ route('all-activites-add') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-xl-4 col-lg-6">
                            <label for="ActivityNumber">ACTIVITY NUMBER</label>
                            <input type="text" name="tripnumber" class="form-control" id="ActivityNumber" readonly value="0">
                        </div>
                        <div class="form-group col-xl-4 col-lg-6">
                            <label for="ActivityItem">SELECT ACTIVITY ITEM</label>

                            <select id="ActivityItem" name="boatname" class="form-control">
                                <option value="">--SELECT--</option>
                                <?php


                                $boats = \App\Models\ActivityItem::all();

                                if (!empty($boats)) {

                                    foreach ($boats as $b) {
                                ?>
                                        <option data-id="{{ $b->activitycapacity }}" {{ (old('boatname') == $b->activityname) ? 'selected' : '' }}  value="{{$b->activityname}}">{{$b->activityname}}</option>
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
                        <div class="form-group col-xl-4 col-lg-12">
                            <label for="ActivityDate">ACTIVITY DATE</label>

                            <input type="date" name="departuredate" value="{{ old('departuredate') }}" class="form-control" id="ActivityDate" min="<?php echo date('Y-m-d')?>">
                            @if($errors->any())
                            <p style="color:Red">{{$errors->first('departuredate')}}</p>
                            @endif
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="form-group col-xl-4 col-lg-6">
                            <label for="ActivityTime">ACTIVITY TIME</label>

                            <input type="time" name="departuretime" value="{{ old('departuretime') }}" class="form-control" id="ActivityTime">
                            @if($errors->any())
                            <p style="color:Red">{{$errors->first('departuretime')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-xl-4 col-lg-6">
                            <label for="ActivityDuration">ACTIVITY DURATION</label>

                            <input type="text" name="duration" value="{{ old('duration') }}" class="form-control" id="ActivityDuration" placeholder="Enter duration in decimal hours (2.5) rather than 2:30">
                            @if($errors->any())
                            <p style="color:Red">{{$errors->first('duration') ? $errors->first('duration').' ! Enter duration in decimal hours (2.5) rather than 2:30' : ' '}}</p>
                            @endif
                        </div>
                        <div class="form-group col-xl-4 col-lg-12">

                            <label for="BriefDescription">BRIEF DESCRIPTION</label>

                            <input type="text" name="destination" value="{{ old('destination') }}" class="form-control" id="BriefDescription">
                            @if($errors->any())
                            <p style="color:Red">{{ ($errors->first('destination')) ? "Brief Description should not be empty" : '' }}</p>
                            @endif
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="col-lg-12 col-md-12 upcoming_activities">
                            <h4>Crew Information</h4>
                            <p class="col-12-descrapction">This information is regarding the crew of this activity.</p>

                        </div>
                        <div class="form-group col-xl-4 col-lg-12">
                            <label for="NumberCrewNeeded">NUMBER OF CREW NEEDED</label>

                            <input type="number" name="crewneeded" onchange="checkNumberCrewNeeded(this)" value="{{ old('crewneeded') }}" class="form-control" min="1" id="NumberCrewNeeded">
                            <div class="crew-exceed alert alert-danger d-none"></div>
                            @if($errors->any())
                            <p style="color:Red">{{$errors->first('crewneeded') ? $errors->first('crewneeded')." Crew Need Can Not Be 0" : '' }}  </p>
                            @endif
                        </div>

                        <div class="form-group col-md-12">
                            <label for="NotesCrew">NOTES FOR CREW</label>

                            <textarea class="form-control" id="NotesCrew" name="crewnotes" rows="5">{{ old('crewnotes') }}</textarea>
                            @if($errors->any())
                            <p style="color:Red">{{$errors->first('crewnotes')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-xl-5 col-lg-13">
                            <label for="TripCost">TRIP COST(£)</label>

                            <input type="number" min="0" name="tripcost" class="form-control" id="TripCost" value="{{ old('tripcost') }}" size="6">
                            @if($errors->any())
                            <p style="color:Red">{{$errors->first('tripcost')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-xl-6 col-lg-14">
                            <label for="BalanceDue">BALANCE DUE (£)</label>

                            <input type="number" name="tripbalance" value="{{ old('tripbalance') }}" class="form-control" id="BalanceDue" size="6">

                            @if($errors->any())
                            <p style="color:Red">{{$errors->first('tripbalance')}}</p>
                            @endif
                        </div>
                        <div class="form-group col-xl-7 col-lg-15">
                            <label for="PassengerCout">PASSENGER COUNT</label>

                            <input type="number" name="passengers" value="{{ old('passengers') }}" class="form-control" id="PassengerCout" size="3">
                            @if($errors->any())
                            <p style="color:Red">{{$errors->first('passengers')}}</p>
                            @endif
                        </div>
                    </div>





                    <br>
                    <div class="row">

                        <div class="col-sm-4">
                            <label class="confirm_label">Confirmed Crew</label>
                            <div id="div2" ondrop="drop(event,this)" ondragover="allowDrop(event)" target="confirmed" content="confirmed[]">

                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label class="available_label">Available Crew</label>
                            <div id="div3" ondrop="drop(event,this)" ondragover="allowDrop(event)" target="available" content="available[]">

                            </div>
                        </div>


                        <div class="col-sm-4">
                            <label class="unavailable_label">Un Available Crew</label>

                            <div id="div1" ondrop="drop(event,this)" ondragover="allowDrop(event)" target="unavailable" content="unavailable[]">
                                <?php


                                $crews = \App\Models\Crew::orderBy('initials', 'ASC')->get()->toArray();

                                if (!empty($crews)) {

                                    foreach ($crews as $c) {
                                        // print_r($c['id']);
                                        if (isset($c['initials'])) {
                                            //  echo $crew_name[0] . "<br>";
                                            ?>
                                            <input type="text" class="form-control" id="drag<?php echo $c['id'] ?>" draggable="true" ondragstart="drag(event)" name="unavailable[]" value="<?php echo $c['initials'] . ': ' . $c['fullname'] ?>" read_only>
                                            <?php
                                        }
                                    }
                                }

                                ?>
                            </div>

                        </div>


                    </div>
                    <div class="col-md-12">
                        <div id="confirm_msg" class="alert alert-danger d-none mt-4"></div>
                    </div>


                    <div class="teck-btn mt-4">
                        <button type="submit" class="btn btn-primary"> <img src="{{ asset('assets/images/save.svg') }}" class="img-fluid"> Create
                            Activity</button>
                    </div>
                </form>


            </div>

        </div>

    </div>

</div>

@stop

<script>
    // function allowDrop(ev) {
    //     ev.preventDefault();

    // }

    // function drag(ev) {
    //     ev.dataTransfer.setData("text", ev.target.id);
    // }

    // function drop(ev, th) {
    //     ev.preventDefault();
    //     var data = ev.dataTransfer.getData("text");
    //     ev.target.appendChild(document.getElementById(data));
    //     //console.log(data);
    //     document.getElementById(data).setAttribute('name', th.getAttribute('content'))
    // }


    function allowDrop(ev, th) {
        ev.preventDefault();

    }

    function drag(ev, th) {
        ev.dataTransfer.setData("text", ev.target.id);

    }

    function drop(ev, th) {
        ev.preventDefault();
        console.log('drag drop');

        var crewcount = $("#NumberCrewNeeded").val();
        crewcount = (crewcount!= "undefined") ? crewcount : 0;

        var data = ev.dataTransfer.getData("text");

        // get Current drop target to identify if this is confirmed it should restrict dropping
        var targetval = th.getAttribute('target');
        // console.log(data);



        var confirm_count = 0;
        $('#div2').find('input[type="text"]').each(function() {

            confirm_count += 1;
            // alert("Filled Value=" + $(this).val());

        });
        // alert("Total Input Count=" + $('#container').find('input[type="text"]').length + "//Filled Inputs Count=" + count);
        console.log(confirm_count , crewcount);
        if (confirm_count >= crewcount && targetval == 'confirmed') {
            $("#confirm_msg").removeClass('d-none');

            document.getElementById('confirm_msg').innerHTML='Limit Reached Of '+crewcount;
            document.getElementById('div2').setAttribute('ondrop', ' ')

        } else {
            $("#confirm_msg").addClass('d-none');

            document.getElementById('div2').setAttribute('ondrop', 'drop(event,this)')
            document.getElementById('confirm_msg').innerHTML='';

            ev.target.appendChild(document.getElementById(data));
            document.getElementById(data).setAttribute('name', th.getAttribute('content'));
        }
    }


</script>

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

    function checkNumberCrewNeeded(id){
        var crewneeded = parseInt($(id).val());
        var activity_seelcted_val = parseInt($('#ActivityItem').find('option:selected').attr('data-id'));
        // alert(activity_seelcted_val);
        var activity_seelcted_name = $('#ActivityItem').find('option:selected').text();
        if(crewneeded > activity_seelcted_val){
            $(".crew-exceed").removeClass('d-none').html('Crew Members not allowed more then '+activity_seelcted_val+ " for activity type "+activity_seelcted_name)
            // alert("exceeded-"+activity_seelcted_val+"--"+ crewneeded)
        } else {
            $(".crew-exceed").html('').addClass('d-none');
        }

    }
</script>
