@extends('layouts.default')

@section('content')


<div class="row dashboard_col" id="crew-members-edit">

    <div class="col-md-12 dashboard_Sec">

        <h1>Crew Members - Update an existing member</h1>
        <p class="sub-pages-text">Please amend any details below and click save changes to submit the updated
            information.</p>

            <div class="teck-btn justify-content-start">

                <a href="{{ route('crew-members') }}" class="btn btn-primary"><img src="{{ asset('assets/images/go_back.png') }}" class="img-fluid" style="width:20px;"> Go Back</a>
            </div>

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
            {{-- <pre>
                "id" => 28
                "initials" => "MK"
                "fullname" => "Margaret Kiddy"
                "emailaddress" => "d.kiddy@sky.com"
                "firstaid" => "Y"
                "rya" => ""
                "cba" => ""
                "iwa" => ""
                "keyholder" => "P"
                "skipper" => ""
                "mobile" => "0788 755 3771"
                "archived" => null
                "pswd" => "dc302fc965f5dd618e731f0c07bc4c10"
                "privilege" => 2
                "username" => "mkiddy"
                "optin" => "Y"
                "faexpire" => "2021-04-13"
                "boatpreference" => "P"
                "traveltime" => 0
                "memnumber" => "1942"
                "lastlogin" => "2019-11-27 19:25:30"
                "suspended" => 0
                "created_at" => null
                "updated_at" => null

                </pre> --}}
            <div class="col-md-12">

                <form class="teck-form" method="POST" action="{{ route('update-crew-account') }}" enctype="multipart/form-data">

                    @csrf

                    <div class="form-row">

                        <div class="form-group col-xl-8 col-lg-12">
                            <div class="form-row">
                                <div class="form-group col-xl-4 col-lg-6">
                                    <label for="Name">NAME</label>
                                    <input type="text" class="form-control" id="Name" name="fullname" value="{{ $crew_member->fullname }}">
                                    <input type="hidden" name="crewid" value="{{ $crew_member->id }}">
                                </div>

                                <div class="form-group col-xl-4 col-lg-6">
                                    <label for="EmailAddress">EMAIL ADDRESS</label>
                                    <input type="email" class="form-control" id="EmailAddress" name="emailaddress" value="{{ $crew_member->emailaddress }}">
                                </div>


                                <div class="form-group col-xl-4 col-lg-6">
                                    <label for="PrimaryNumber">PRIMARY NUMBER</label>
                                    <input type="text" class="form-control" id="PrimaryNumber" name="mobile" value="{{ $crew_member->mobile }}">
                                </div>


                                <div class="form-group col-xl-4 col-lg-6">
                                    <label for="SecondaryNumber">SECONDARY NUMBER</label>
                                    <input type="text" class="form-control" name="secondarynumber" id="SecondaryNumber" value="{{ $crew_member->secondarynumber }}">
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
                                                <option value="{{$b->activityname}}" {{$b->activityname==$crew_member->boatpreference?'Selected':''}}>{{$b->activityname}}</option>
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
                                            <input type="text" class="form-control" id="Initials" name="initials" value="{{ $crew_member->initials }}" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Username">USERNAME</label>
                                            <input type="text" class="form-control" id="Username" name="username" value="{{ $crew_member->username }}" disabled>
                                        </div>


                                        {{-- <div class="form-group col-md-6"> --}}
                                            {{-- <label for="AccountRole">ACCOUNT ROLE</label> --}}

                                            {{-- <input type="text" class="form-control" value="{{Session::get('role') }}" readonly> --}}
                                            {{-- </div> --}}
                                            <?php

                                            $crew_role = \App\Models\User::where(['username'=>$crew_member->username,'email'=>$crew_member->emailaddress])->get();
                                            // dd($crew_role->count());

                                            if($crew_role->count() > 0){
                                                $crew_role_id = $crew_role[0]->role_id;
                                                $userId = $crew_role[0]->id;

                                            } else {
                                                $crew_role_id = "";
                                                $userId = 0;

                                            }

                                            ?>

                                            <input type="hidden" name="user_id" value="{{$userId}}">
                                            <div class="form-group col-md-6">
                                                <label for="AccountRole">ACCOUNT ROLE</label>

                                                <select name="role_id" id="" class="form-control" >
                                                    <option value="">-- Select Role --</option>
                                                    <?php

                                                    $roles = DB::table('roles')->get();
                                                    if ($roles->isNotEmpty()) {
                                                        foreach ($roles as $r) {
                                                            ?>
                                                                <option value="{{$r->id}}" {{($crew_role_id==$r->id?'selected':'')}} @if(Session::get('role')=='crewmember') 'disabled' @endif>{{ucfirst($r->name)}}</option>
                                                            <?php
                                                        }
                                                    }

                                                    ?>
                                                </select>
                                            </div>


                                        <div class="form-group col-md-6">
                                            <label for="CctMembershipNumber">CCT MEMBERSHIP NUMBER</label>
                                            <input type="number" class="form-control" id="CctMembershipNumber" name="memnumber" value="{{ $crew_member->memnumber }}">
                                        </div>


                                    </div>
                                </div>
                                <div class="form-group col-xl-4 col-lg-12">
                                    <div class="form-group col-md-12">
                                        <div><label>ADDITIONAL</label></div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="firstaid" name="firstaid" {{ !empty($crew_member->firstaid) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="firstaid">First Aid</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="cba" name="cba" {{ !empty($crew_member->cba) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="cba">CBA</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="rya" name="rya" {{ !empty($crew_member->rya) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="rya">RYA</label>
                                        </div>


                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="iwa" name="iwa" {{ !empty($crew_member->iwa) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="iwa">IWA</label>
                                        </div>
                                        {{-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="keyholder" name="keyholder" {{ !empty($crew_member->keyholder) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="keyholder">Key Holder</label>
                                        </div> --}}
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="skipper" name="skipper" {{ !empty($crew_member->skipper) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="skipper">Skipper</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="optin" id="optin" {{ !empty($crew_member->optin) ? 'checked' : '' }} value="{{ $crew_member->optin }}">
                                            <label for="optin">Opted in for Details</label>
                                        </div>


                                    </div>
                                </div>

                                <div class="form-group col-xl-8 col-lg-12">
                                    <div class="form-row">

                                        {{-- <div class="form-group col-md-6">
                                            <label for="privilege">Privilege</label>
                                            <input type="number" class="form-control" name="privilege" id="privilege" value="{{ $crew_member->privilege }}">
                                        </div> --}}


                                        <div class="form-check">
                                            <label for="KeyHolder">Key Holder</label>
                                            <input class="form-control" type="text" id="KeyHolder" name="keyholder" value="{{ $crew_member->keyholder }}">
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label for="traveltime">Travel Time</label>
                                            <input type="text" class="form-control" name="traveltime" id="traveltime" value="{{ $crew_member->traveltime }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="privilege">First aid expiry</label>
                                            <input type="date" class="form-control" name="faexpiry" id="privilege" value="{{ $crew_member->faexpire }}">
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
                                            <label for="TypeNewPassword">TYPE NEW PASSWORD</label>
                                            <input type="password" class="form-control" name="password" id="TypeNewPassword" placeholder="*********">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="ReTypePassword">RE TYPE PASSWORD</label>

                                            <input type="password" class="form-control" name="confirmpassword" id="ReTypePassword" placeholder="*********">
                                        </div>

                                    </div>
                                </div>

                            </div>



                        </div>

                        <div class="form-group col-xl-4 col-lg-12">
                            <div class="profile-picture">
                                <label>PROFILE PICTURE</label>

                                @if($errors->any)
                                <p style="color:red"> {{ $errors->first('image') }}</p>
                                @endif

                                <?php
                                if (isset($crew_member->profile) &&  file_exists(public_path() . '/assets/profile-images' . '/' . $crew_member->profile)) {
                                ?>
                                    <img src="{{ asset('assets/profile-images/'.$crew_member->profile) }}" width="190" height="150"  class="preview"/>
                                <?php
                                } else {
                                ?>
                                    <img src="{{ asset('assets/images/profile-picture.png') }}" class="preview" />
                                <?php
                                }

                                ?>

                                <div class="teck-btn bg-white upload-btn">
                                    <input type="file" name="profileImage" accept="image/*"  onchange="previewFile(this)" />
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


<script>
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
