@extends('layouts.default')

@section('content')


<div class="row dashboard_col" id="my-account">



    <div class="col-md-12 dashboard_Sec">

        <h1>My Account</h1>

        <p class="sub-pages-text">This is your user account area, please make sure your information is up to date.</p>
        <a href="{{ URL::previous() }}" class="btn btn-primary">Go Back</a>
    </div>

    @if (Session::has('success'))
    <div class="alert alert-success col-12 mb-2 mt-3">
        @foreach (Session::get('success') as $msg )

        <li>{{ $msg }}</li>

        @endforeach
    </div>

    @endif

    <div class="col-md-12 activies_table">

        <div class="row activity_col">

            <div class="col-md-12 dashboard-heading-desc">
                <div class="col-lg-12 col-md-12 upcoming_activities">

                    <h4>Your Information</h4>

                    <p class="col-12-descrapction">You can freely ammend the information below to keep your records up to
                        date on our system.</p>

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


            </div>


            @php
            $crewmember = $crew_member;

            @endphp


            <div class="col-md-12">

                <form class="teck-form" action="{{ route('update-my-account') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">

                        <div class="form-group col-md-8">

                            <div class="form-row">

                                <div class="form-group col-xl-4 col-lg-6">

                                    <label for="Name">NAME</label>

                                    <input type="text" class="form-control" id="Name" name="name" value="{{ $crewmember->fullname }}">

                                    <input type="hidden" name="id" value="{{ $crewmember->id }}">
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">


                                </div>



                                <div class="form-group col-xl-4 col-lg-6">

                                    <label for="EmailAddress">EMAIL ADDRESS</label>

                                    <input type="email" class="form-control" id="EmailAddress" name="emailaddress" value="{{ $crewmember->emailaddress }}">

                                </div>

                                <div class="form-group col-xl-4 col-lg-6">

                                    <label for="PrimaryNumber">PRIMARY NUMBER</label>

                                    <input type="text" class="form-control" id="PrimaryNumber" name="primary_no" value="{{ $crewmember->mobile }}">

                                </div>

                                <div class="form-group col-xl-4 col-lg-6">

                                    <label for="SecondaryNumber">SECONDARY NUMBER</label>

                                    <input type="text" class="form-control" name="secondarynumber" id="SecondaryNumber" value="{{ $crewmember->secondarynumber }}">

                                </div>



                                <div class="form-group col-xl-4 col-lg-12">

                                    <label for="ActivityPreference">ACTIVITY PREFERENCE</label>

                                    <select id="ActivityPreference" name="boatpreference" class="form-control">
                                        <option>Please Select...</option>
                                        <?php

                                        $initials = Session::get('initials');


                                        $boats = \App\Models\ActivityItem::all();


                                        if (!empty($boats)) {

                                            foreach ($boats as $b) {
                                        ?>
                                                <option value="{{$b->activityname}}" {{$b->activityname==$crewmember->boatpreference?'Selected':''}}>{{$b->activityname}}</option>
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

                                </div>

                                <div class="form-group col-xl-8 col-lg-12">

                                    <div class="form-row">


                                        <div class="form-group col-md-6">

                                            <label for="Initials">INITIALS</label>

                                            <input type="text" class="form-control" id="Initials" value="{{ $crewmember->initials }}" disabled>

                                        </div>

                                        <div class="form-group col-md-6">

                                            <label for="Username">USERNAME</label>

                                            <input type="text" class="form-control" id="Username" name="username" value="{{ $user->username }}" disabled>


                                        </div>


                                        <div class="form-group col-md-6">

                                            <label for="AccountRole">ACCOUNT ROLE</label>


                                            <input type="text" class="form-control" value="{{Session::get('role') }}" readonly>

                                        </div>



                                        <div class="form-group col-md-6">

                                            <label for="CctMembershipNumber">CCT MEMBERSHIP NUMBER</label>

                                            <input type="number" class="form-control" id="CctMembershipNumber" name="memnumber" value="{{ $crewmember->memnumber }}">


                                        </div>





                                    </div>

                                </div>

                                <div class="form-group col-xl-4 col-lg-12">

                                    <div class="form-group col-md-12">

                                        <div><label>ADDITIONAL</label></div>

                                        <div class="form-check">

                                            <input class="form-check-input" type="checkbox" id="firstaid" name="firstaid" {{ !empty($crewmember->firstaid) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="firstaid">First Aid</label>

                                        </div>

                                        <div class="form-check">

                                            <input class="form-check-input" type="checkbox" id="cba" name="cba" {{ !empty($crewmember->cba) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="cba">CBA</label>

                                        </div>



                                        <div class="form-check">

                                            <input class="form-check-input" type="checkbox" id="rya" name="rya" {{ !empty($crewmember->rya) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="rya">RYA</label>

                                        </div>

                                        <div class="form-check">

                                            <input class="form-check-input" id="keyholder" type="checkbox" name="keyholder" {{ !empty($crewmember->keyholder) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="keyholder">Key Holder</label>

                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="iwa" name="iwa" {{ !empty($crewmember->iwa) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="iwa">IWA</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="skipper" name="skipper" {{ !empty($crewmember->skipper) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="skipper">Skipper</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="optin" name="optin" {{ !empty($crewmember->optin) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="optin">Opted in for
                                                Details</label>
                                        </div>


                                    </div>
                                </div>

                                <div class="form-group col-xl-8 col-lg-12">
                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="privilege">Privilege</label>
                                            <input type="number" class="form-control" name="privilege" id="privilege" value="{{ $crewmember->privilege }}">
                                        </div>



                                        <div class="form-group col-md-6">
                                            <label for="faexpire">First aid expiry</label>
                                            <input type="date" class="form-control" name="faexpire" id="faexpire" value="{{ $crewmember->faexpire }}">
                                        </div>

                                    </div>
                                </div>



                                <div class="col-lg-12 col-md-12 upcoming_activities">

                                    <h4>Account Password</h4>

                                    <p class="col-12-descrapction">Please set a temporary password for the crew member.
                                        They can update this once logged in.</p>

                                    @if($errors->any)
                                    <p style="color:red"> {{ $errors->first('msg') }}</p>
                                    @endif

                                </div>



                                <div class="form-group col-xl-8 col-lg-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">

                                            <label for="OldTypeNewPassword">TYPE OLD PASSWORD</label>

                                            <input type="password" class="form-control" name="old_password" id="OldTypeNewPassword" placeholder="*********">


                                        </div>
                                    </div>
                                    <div class="form-row">


                                        <div class="form-group col-md-6">

                                            <label for="TypeNewPassword">TYPE NEW PASSWORD</label>
                                            <input type="password" class="form-control" name="password" id="TypeNewPassword" placeholder="*********">


                                        </div>



                                        <div class="form-group col-md-6">

                                            <label for="ReTypePassword">RE TYPE PASSWORD </label>

                                            <input type="password" class="form-control" name="confirmpassword" id="ReTypePassword" placeholder="*********">

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <div class="form-group col-md-4">

                            <div class="profile-picture">
                                @if($errors->any)
                                <p style="color:red"> {{ $errors->first('image') }}</p>
                                @endif
                                <label>PROFILE PICTURE</label>


                                <?php

                                if (isset($crewmember->profile) && file_exists(public_path() . '/assets/profile-images' . '/' . $crewmember->profile)) {
                                ?>
                                    <img src="{{ asset('assets/profile-images').'/'.$crewmember->profile}}" class="img-fluid preview" />
                                <?php

                                } else {
                                ?>
                                    <img src="{{ asset('assets/images/profile-picture.png') }}" class="img-fluid preview" />
                                <?php
                                }

                                ?>

                                <div class="teck-btn bg-white upload-btn">

                                    <input type="file" name="profileImage" accept="image/*" onchange="previewFile(this)" />

                                    <a href="#!"><img src="{{ asset('assets/images/camera.svg') }}" class="btn-icon-2" alt=""> Update Image </a>

                                </div>

                            </div>

                        </div>


                    </div>

                    <div class="teck-btn">

                        <button type="submit" class="btn btn-primary"> <img src="{{ asset('assets/images/save.svg') }}" class="img-fluid"> Update User </button>

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


    // mehthod 1    onclick="previewFile(this);"

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
