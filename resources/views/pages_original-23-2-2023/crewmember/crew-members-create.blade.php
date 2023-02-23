@extends('crewlayouts.default')

@section('content')


    <div class="row dashboard_col" id="crew-members-create">

        <div class="col-md-12 dashboard_Sec">

            <h1>Crew Members - Create a new member</h1>
            <p class="sub-pages-text">Please fill out the information below to create a new crew memb.</p>

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

                    <form class="teck-form">
                        <div class="form-row">

                            <div class="form-group col-xl-8 col-lg-12">
                                <div class="form-row">
                                    <div class="form-group col-xl-4 col-lg-6">
                                        <label for="Name">NAME</label>
                                        <input type="text" class="form-control" id="Name">
                                    </div>

                                    <div class="form-group col-xl-4 col-lg-6">
                                        <label for="EmailAddress">EMAIL ADDRESS</label>
                                        <input type="email" class="form-control" id="EmailAddress">
                                    </div>


                                    <div class="form-group col-xl-4 col-lg-6">
                                        <label for="PrimaryNumber">PRIMARY NUMBER</label>
                                        <input type="number" class="form-control" id="PrimaryNumber">
                                    </div>


                                    <div class="form-group col-xl-4 col-lg-6">
                                        <label for="SecondaryNumber">SECONDARY NUMBER</label>
                                        <input type="number" class="form-control" id="SecondaryNumber">
                                    </div>

                                    <div class="form-group col-xl-4 col-lg-12">
                                        <label for="ActivityPreference">ACTIVITY PREFERENCE</label>
                                        <select id="ActivityPreference" class="form-control">
                                            <option selected>Please Select...</option>
                                            <option>...</option>
                                            <option>...</option>
                                            <option>...</option>
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
                                                <input type="text" class="form-control" id="Initials">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Username">USERNAME</label>
                                                <input type="text" class="form-control" id="Username">
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label for="AccountRole">ACCOUNT ROLE</label>
                                                <select id="AccountRole" class="form-control">
                                                    <option selected>Please Select...</option>
                                                    <option>...</option>
                                                    <option>...</option>
                                                    <option>...</option>
                                                </select>
                                            </div>



                                            <div class="form-group col-md-6">
                                                <label for="CctMembershipNumber">CCT MEMBERSHIP NUMBER</label>
                                                <input type="text" class="form-control" id="CctMembershipNumber">
                                            </div>


                                        </div>
                                    </div>
                                    <div class="form-group col-xl-4 col-lg-12">
                                        <div class="form-group col-md-12">
                                            <div><label>ADDITIONAL</label></div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="First Aid">
                                                <label class="form-check-label" for="First Aid">First Aid</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="CBA">
                                                <label class="form-check-label" for="CBA">CBA</label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="RYA">
                                                <label class="form-check-label" for="RYA">RYA</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Key Holder">
                                                <label class="form-check-label" for="Key Holder">Key Holder</label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="IWA">
                                                <label class="form-check-label" for="IWA">IWA</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Skipper">
                                                <label class="form-check-label" for="Skipper">Skipper</label>
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
                                                <input type="password" class="form-control" id="TypeNewPassword">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="ReTypePassword">RE TYPE PASSWORD</label>
                                                <input type="password" class="form-control" id="ReTypePassword">
                                            </div>

                                        </div>
                                    </div>

                                </div>



                            </div>

                            <div class="form-group col-xl-4 col-lg-12">
                                <div class="profile-picture">
                                    <label>PROFILE PICTURE</label>
                                    <img src="{{ asset('assets/images/profile-picture.svg') }}" />

                                    <div class="teck-btn bg-white upload-btn">
                                        <input type="file" />
                                        <a href="#!"><img src="{{ asset('assets/images/camera.svg') }}"
                                                class="btn-icon-2" alt=""> Update Image </a>
                                    </div>
                                </div>
                            </div>


                        </div>


                        @can('create', \App\Models\User::class)
                            TEST HERE
                        @endcan



                        <div class="teck-btn">
                            <button type="submit" class="btn btn-primary"> <img
                                    src="{{ asset('assets/images/save.svg') }}" class="img-fluid"> Create User </button>
                        </div>
                    </form>


                </div>

            </div>

        </div>

    </div>

@stop
