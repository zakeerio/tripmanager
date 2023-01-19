@extends('layouts.default')

@section('content')

<div class="row dashboard_col" id="crew-members-create">

    <div class="col-md-12 dashboard_Sec">

        <h1>Crew Members - Create a new member</h1>
        <p class="sub-pages-text">Please fill out the information below to create a new crew memb.</p>
        <div class="teck-btn justify-content-start">

            <a href="{{ route('crew-members') }}" class="btn btn-primary"><img src="{{ asset('assets/images/go_back.png') }}" class="img-fluid" style="width:20px;"> Go Back</a>
        </div>
        @if(Session::get('status'))

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
                        <h4>Member Information</h4>
                        <p class="col-12-descrapction">These details will be editable by the crew member once logged into
                            their account.</p>
                    </div>
                </div>
            </div>


            <div class="col-md-12">

                <form class="teck-form" action="{{ route("savecrew")}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">

                        <div class="form-group col-xl-8 col-lg-12">
                            <div class="form-row">
                                <div class="form-group col-xl-4 col-lg-6">
                                    <label for="Name">NAME</label>
                                    <input type="text" class="form-control" id="Name" name="name" value="{{ old('name') }}" required>
                                </div>

                                <div class="form-group col-xl-4 col-lg-6">
                                    <label for="email">EMAIL ADDRESS</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                    <b> <span id="email_msg"></span></b>
                                </div>


                                <div class="form-group col-xl-4 col-lg-6">
                                    <label for="PrimaryNumber">PRIMARY NUMBER</label>
                                    <input type="text" class="form-control" id="PrimaryNumber" name="mobile" value="{{ old('mobile') }}" required>
                                </div>


                                <div class="form-group col-xl-4 col-lg-6">
                                    <label for="SecondaryNumber">SECONDARY NUMBER</label>
                                    <input type="text" class="form-control" name="secondarynumber" value="{{ old('secondarynumber') }}" id="SecondaryNumber">
                                </div>

                                <div class="form-group col-xl-4 col-lg-12">
                                    <label for="ActivityPreference">ACTIVITY PREFERENCE</label>

                                    <select id="ActivityPreference" name="boatpreference" class="form-control" required>
                                        <option>Please Select...</option>
                                        <?php

                                        $initials = Session::get('initials');


                                        $boats = \App\Models\ActivityItem::all();


                                        if (!empty($boats)) {

                                            foreach ($boats as $b) {
                                        ?>
                                                <option value="{{$b->activityname}}" {{ isset(old('boatpreference') && old('boatpreference') == $b->activityname) ? 'selected' : '' }} >{{$b->activityname}}</option>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">No Activity Found</option>
                                        <?php
                                        }

                                        ?>

                                    </select>

                                </div>


                                <div class="col-lg-12 col-md-12 upcoming_activities">
                                    <h4>System Information</h4>
                                    <p class="col-12-descrapction">This information is not editable by the crew member
                                        and they will not be able to update it themselves.</p>

                                    <b> <span id="crew_code_msg"></span></b>
                                </div>


                                <div class="form-group col-xl-8 col-lg-12">
                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="Initials">INITIALS</label>
                                            <input type="text" class="form-control" id="initials" name="initials" value="{{ old('initials') }}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Username">USERNAME</label>
                                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                                            <b> <span id="username_msg"></span></b>
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label for="AccountRole">ACCOUNT ROLE</label>
                                            <select id="AccountRole" name="role_id" class="form-control">
                                                <option selected>Please Select...</option>
                                                @php
                                                $roles = \App\Models\Role::get();
                                                @endphp
                                                @forelse ($roles as $role)
                                                <option value="{{$b->activityname}}" >{{$b->activityname}}</option>

                                                                                                                                                                                                                                    <option value="{{ $role->id }}" {{ isset(old('role_id') && old('role_id') == $role->id) ? 'selected' : '' }} >
                                                    {{ $role->name }}
                                                </option>

                                                @empty
                                                @endforelse
                                            </select>
                                        </div>



                                        <div class="form-group col-md-6">
                                            <label for="CctMembershipNumber">CCT MEMBERSHIP NUMBER</label>
                                            <input type="number" class="form-control" id="CctMembershipNumber" name="memnumber" value="{{ old('memnumber') }}">
                                        </div>


                                    </div>
                                </div>
                                <div class="form-group col-xl-4 col-lg-12">
                                    <div class="form-group col-md-12">
                                        <div><label>ADDITIONAL</label></div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" placeholder="First Aid" id="FirstAid" name="firstaid" value="{{ old('firstaid') }}">
                                            <label class="form-check-label" for="FirstAid">First Aid</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" placeholder="CBA" id="CBA" name="cba" value="{{ old('cba') }}">
                                            <label class="form-check-label" for="CBA">CBA</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" placeholder="RYA" id="RYA" name="rya" value="{{ old('rya') }}">
                                            <label class="form-check-label" for="RYA">RYA</label>
                                        </div>


                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" placeohlder="IWA" id="IWA" name="iwa" value="{{ old('iwa') }}">
                                            <label class="form-check-label" for="IWA">IWA</label>
                                        </div>
                                        {{-- <div class="form-check">
                                            <input class="form-check-input" id="Keyholder" type="checkbox" placeholder="Key Holder" name="keyholder" value="{{ old('keyholder') }}">
                                            <label class="form-check-label" for="Keyholder">Key Holder</label>
                                        </div> --}}
                                        <div class="form-check">
                                            <input class="form-check-input" id="Skipper" type="checkbox" placeholder="Skipper" name="skipper" value="{{ old('skipper') }}">
                                            <label class="form-check-label" for="Skipper">Skipper</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="optin" value="{{ old('optin') }}" id="optin">
                                            <label for="optin">Opted in for Details</label>
                                        </div>


                                    </div>
                                </div>

                                <div class="form-group col-xl-8 col-lg-12">
                                    <div class="form-row">

                                        {{-- <div class="form-group col-md-6">
                                            <label for="privilege">Privilege</label>
                                            <input type="number" class="form-control" name="privilege" value="{{ old('privilege') }}" id="privilege" required>
                                        </div> --}}

                                        <div class="form-group col-md-6">
                                            <label for="KeyHolder">Key Holder</label>
                                            <input class="form-control" type="text" id="KeyHolder" name="keyholder" value="{{ old('keyholder') }}" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="traveltime">Travel Time</label>
                                            <input type="number" class="form-control" name="traveltime" value="{{ old('traveltime') }}" id="traveltime" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="traveltime">First aid expiry</label>
                                            <input type="date" class="form-control" name="faexpire" value="{{ old('faexpire') }}" id="faexpire" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 upcoming_activities">
                                    <h4>Account Password</h4>
                                    <p class="col-12-descrapction">Please set a temporary password for the crew member.
                                        They can update this once logged in.</p>
                                </div>



                                <div class="form-group col-xl-8 col-lg-12">
                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="TypeNewPassword">TYPE NEW PASSWORD</label>
                                            <input type="password" class="form-control" autocomplete="off" name="password" value="{{ old('password') }}" id="TypeNewPassword" placeholder="********" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="ReTypePassword">RE TYPE PASSWORD</label>
                                            <input type="password" class="form-control" id="ReTypePassword" autocomplete="off" name="confirmpassword" value="{{ old('confirmpassword') }}" required>
                                        </div>

                                    </div>
                                </div>

                            </div>



                        </div>

                        <div class="form-group col-xl-4 col-lg-12">
                            <div class="profile-picture">
                                <label>PROFILE PICTURE</label>
                                <img src="{{ asset('assets/images/profile-picture.png') }}" style="width: 220px; height: 220px;" class="img-fluid preview"/>

                                <div class="teck-btn bg-white upload-btn">
                                    <input type="file" name="profileImage" value="{{ old('profileImage') }}" accept="image/*"  onchange="previewFile(this)" />

                                    <a href="#!"><img src="{{ asset('assets/images/camera.svg') }}" class="btn-icon-2" alt=""> Update Image </a>
                                </div>
                            </div>
                        </div>


                    </div>


                    {{-- @can('create', \App\Models\User::class)
                            TEST HERE
                        @endcan --}}



                    <div class="teck-btn">
                        <button type="submit" class="btn btn-primary">
                            <img src="{{ asset('assets/images/save.svg') }}" class="img-fluid"> Create User </button>
                    </div>
                </form>

            </div>

        </div>

    </div>

</div>

@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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

    $(document).on('keyup', '#initials', function(e) {

        //  alert();

        if ($(this).val() != "") {

            e.preventDefault();
            e.stopImmediatePropagation();
            e.stopPropagation();

            const settings = {
                "async": true,
                "crossDomain": true,
                "url": '{{route("/validate-crewcode")}}',
                "data": {
                    crewcode: $(this).val()
                },
                'dataType': 'json',
                "method": "GET",
            };

            $.ajax(settings).done(function(response) {
                // alert(response.msg)
                // $('#crew_code_msg')
                if (response.status) {
                    var msg = "<span id='crew_code_msg'><span class='active-btn-ready'><img src='{{asset('assets/images/Activity-Ready-Button.png')}}' class='img-fluid' alt=''> " + response.msg + "</span></span>";
                    $('#crew_code_msg').css('color', 'green');

                } else {
                    $('#crew_code_msg').css('color', 'red');
                    var msg = response.msg;
                }

                $('#crew_code_msg').html(msg);
                // LoadProductGird()
            });

            $.ajax(settings).fail(function(jqXHR, textStatus, errorThrown) {
                // alert(errorThrown);
            });
        } else {
            $('#crew_code_msg').empty();
        }
    });


    $(document).on('keyup', '#email', function(e) {

        //  alert();

        if ($(this).val() != "") {

            e.preventDefault();
            e.stopImmediatePropagation();
            e.stopPropagation();

            const settings = {
                "async": true,
                "crossDomain": true,
                "url": '{{route("/validate-email")}}',
                "data": {
                    email: $(this).val()
                },
                'dataType': 'json',
                "method": "GET",
            };

            $.ajax(settings).done(function(response) {
                // alert(response.msg)
                // $('#crew_code_msg')
                if (response.status) {
                    var msg = "<span class='active-btn-ready'><img src='{{asset('assets/images/Activity-Ready-Button.png')}}' class='img-fluid' alt=''> " + response.msg + "</span>";
                    $('#email_msg').css('color', 'green');

                } else {
                    $('#email_msg').css('color', 'red');
                    var msg = response.msg;
                }

                $('#email_msg').html(msg);
                // LoadProductGird()
            });

            $.ajax(settings).fail(function(jqXHR, textStatus, errorThrown) {
                // alert(errorThrown);
            });
        } else {
            $('#crew_code_msg').empty();
        }
    });



    $(document).on('keyup', '#username', function(e) {

        //  alert();

        if ($(this).val() != "") {

            e.preventDefault();
            e.stopImmediatePropagation();
            e.stopPropagation();

            const settings = {
                "async": true,
                "crossDomain": true,
                "url": '{{route("/validate-username")}}',
                "data": {
                    username: $(this).val()
                },
                'dataType': 'json',
                "method": "GET",
            };

            $.ajax(settings).done(function(response) {
                // alert(response.msg)
                // $('#crew_code_msg')
                if (response.status) {
                    var msg = "<span class='active-btn-ready'><img src='{{asset('assets/images/Activity-Ready-Button.png')}}' class='img-fluid' alt=''> " + response.msg + "</span>";
                    $('#username_msg').css('color', 'green');

                } else {
                    $('#username_msg').css('color', 'red');
                    var msg = response.msg;
                }

                $('#username_msg').html(msg);
                // LoadProductGird()
            });

            $.ajax(settings).fail(function(jqXHR, textStatus, errorThrown) {
                // alert(errorThrown);
            });
        } else {
            $('#username_msg').empty();
        }
    });

    function previewFile(input) {
        var file = $("input[type=file]").get(0).files[0];

        if (file) {
            var reader = new FileReader();

            reader.onload = function() {
                $(".preview").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    }
</script>
