@extends('layouts.default')

@section('content')

    <div class="row dashboard_col" id="crew-members-create">

        <div class="col-md-12 dashboard_Sec">

            <h1>Crew Members - Create a new member</h1>
            <p class="sub-pages-text">Please fill out the information below to create a new crew memb.</p>
            <a href="{{ URL::previous() }}" class="btn btn-primary">Go Back</a>

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

                    <form class="teck-form" action="{{ route("savecrew")}}" method="POST">
                        @csrf
                        <div class="form-row">

                            <div class="form-group col-xl-8 col-lg-12">
                                <div class="form-row">
                                    <div class="form-group col-xl-4 col-lg-6">
                                        <label for="Name">NAME</label>
                                        <input type="text" class="form-control" id="Name" name="name">
                                    </div>

                                    <div class="form-group col-xl-4 col-lg-6">
                                        <label for="EmailAddress">EMAIL ADDRESS</label>
                                        <input type="email" class="form-control" id="EmailAddress" name="email">
                                    </div>


                                    <div class="form-group col-xl-4 col-lg-6">
                                        <label for="PrimaryNumber">PRIMARY NUMBER</label>
                                        <input type="number" class="form-control" id="PrimaryNumber" name="mobile">
                                    </div>


                                    <div class="form-group col-xl-4 col-lg-6">
                                        <label for="SecondaryNumber">SECONDARY NUMBER</label>
                                        <input type="number" class="form-control" id="SecondaryNumber">
                                    </div>

                                    <div class="form-group col-xl-4 col-lg-12">
                                        <label for="ActivityPreference">ACTIVITY PREFERENCE</label>
                                        <select id="ActivityPreference" name="boatpreference" class="form-control">
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
                                                <input type="text" class="form-control" id="Initials" name="initials">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Username">USERNAME</label>
                                                <input type="text" class="form-control" id="Username" name="username">
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label for="AccountRole">ACCOUNT ROLE</label>
                                                <select id="AccountRole" name="role_id" class="form-control">
                                                    <option selected>Please Select...</option>
                                                    @php
                                                        $roles = \App\Models\Role::get();
                                                    @endphp
                                                    @forelse ($roles as $role)
                                                        <option value="{{ $role->id }}"
                                                            {{-- {{ isset($crew_member->user) && $crew_member->user->role['id'] == $role->id ? 'selected' : '' }}> --}}
                                                            >
                                                            {{ $role->name }}</option>

                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>



                                            <div class="form-group col-md-6">
                                                <label for="CctMembershipNumber">CCT MEMBERSHIP NUMBER</label>
                                                <input type="number" class="form-control" id="CctMembershipNumber" name="memnumber">
                                            </div>


                                        </div>
                                    </div>
                                    <div class="form-group col-xl-4 col-lg-12">
                                        <div class="form-group col-md-12">
                                            <div><label>ADDITIONAL</label></div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" placeholder="First Aid" name="firstaid">
                                                <label class="form-check-label" for="First Aid">First Aid</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" placeholder="CBA" name="cba">
                                                <label class="form-check-label" for="CBA">CBA</label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" placeholder="RYA" name="rya">
                                                <label class="form-check-label" for="RYA">RYA</label>
                                            </div>


                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" placeohlder="IWA" name="iwa">
                                                <label class="form-check-label" for="IWA">IWA</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" placeholder="Skipper" name="skipper">
                                                <label class="form-check-label" for="Skipper">Skipper</label>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="form-group col-xl-8 col-lg-12">
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label for="privilege">Privilege</label>
                                                <input type="number" class="form-control" name="privilege" id="privilege">
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="optin" id="optin" >
                                                <label for="optin">Opted in for Details</label>
                                            </div>
                                            <div class="form-check">
                                                <label for="KeyHolder">Key Holder</label>
                                                <input class="form-control" type="text" id="KeyHolder" name="keyholder">
                                            </div>



                                            <div class="form-group col-md-6">
                                                <label for="privilege">First aid expiry</label>
                                                <input type="date" class="form-control" name="traveltime" id="privilege">
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
                                                <input type="password" class="form-control" name="password" id="TypeNewPassword" placeholder="********">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="ReTypePassword">RE TYPE PASSWORD</label>
                                                <input type="password" class="form-control" id="ReTypePassword" name="confirmpassword" >
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
                                        <input type="file" name="profileImage" />
                                        <a href="#!"><img src="{{ asset('assets/images/camera.svg') }}"
                                                class="btn-icon-2" alt=""> Update Image </a>
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
