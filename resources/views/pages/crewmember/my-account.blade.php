@extends('crewlayouts.default')

@section('content')




                <div class="row dashboard_col" id="my-account">



                    <div class="col-md-12 dashboard_Sec">



                        <h1>My Account</h1>

                        <p class="sub-pages-text">This is your user account area, please make sure your information is up to date.</p>



                    </div>


                    <div class="col-md-12 activies_table">



                        <div class="row activity_col">



                            <div class="col-md-12 dashboard-heading-desc">

                                <div class="col-lg-12 col-md-12 upcoming_activities">

                                    <h4>Your Information</h4>

                                    <p class="col-12-descrapction">You can freely ammend the information below to keep your records up to date on our system.</p>

                                </div>

                           </div>     

                           
                                @php
                                    $crewmember = $user->crew;
                                @endphp
                



                            <div class="col-md-12">



                            <form class="teck-form" action="{{ route('update-account') }}" method="post">
                                @csrf

                                  <div class="form-row">

                                      

                                        <div class="form-group col-md-8">

                                            <div class="form-row">

                                                <div class="form-group col-xl-4 col-lg-6">

                                                  <label for="Name">NAME</label>

                                                  <input type="text" class="form-control" id="Name" name="name" value="{{ $user->name }}">
                                                  <input type="hidden" name="id" value="{{ $crewmember->id }}">

                                                </div>

                                                

                                                <div class="form-group col-xl-4 col-lg-6">

                                                  <label for="EmailAddress">EMAIL ADDRESS</label>

                                                  <input type="email" class="form-control" id="EmailAddress" name="emailaddress" value="{{ $crewmember->emailaddress }}">

                                                </div>

                                                

                                                

                                                <div class="form-group col-xl-4 col-lg-6">

                                                  <label for="PrimaryNumber">PRIMARY NUMBER</label>

                                                  <input type="number" class="form-control" id="PrimaryNumber" value="07562852305" name="" value="{{ $crewmember->mobile }}">

                                                </div>

                                                

                                                

                                                <div class="form-group col-xl-4 col-lg-6">

                                                  <label for="SecondaryNumber">SECONDARY NUMBER</label>

                                                  <input type="number" class="form-control" name="secondarynumber" id="SecondaryNumber" value="{{ $crewmember->secondarynumber }}">

                                                </div>

                                                

                                                <div class="form-group col-xl-4 col-lg-12">

                                                  <label for="ActivityPreference">ACTIVITY PREFERENCE</label>

                                                  <select id="ActivityPreference" name="boatpreference" class="form-control">

                                                    <option>Please Select...</option>

                                                    <option selected>Seth Ellis</option>

                                                    <option>...</option>

                                                    <option>...</option>

                                                  </select>

                                                </div>

                                                

                                                

                                                <div class="col-lg-12 col-md-12 upcoming_activities">

                                                    <h4>System Information</h4>

                                                    <p class="col-12-descrapction">This information is not editable by the crew member and they will not be able to update it themselves.</p>

                                                </div>

                                                <div class="form-group col-xl-8 col-lg-12">

                                                    <div class="form-row">

                                                        

                                                        <div class="form-group col-md-6">

                                                          <label for="Initials">INITIALS</label>

                                                          <input type="text" class="form-control" id="Initials" value="{{ $crewmember->initials }}">

                                                        </div>

                                                        <div class="form-group col-md-6">

                                                          <label for="Username">USERNAME</label>

                                                          <input type="text" class="form-control" id="Username" value="name="username" value="{{ $user->username }}">

                                                        </div>

                                                        

                                                        

                                                        <div class="form-group col-md-6">

                                                          <label for="AccountRole">ACCOUNT ROLE</label>

                                                          <select id="AccountRole" class="form-control">

                                                            @php
                                                            $roles = \App\Models\Role::get();
                                                            @endphp
                                                            @forelse ($roles as $role )
                                                            <option value="{{ $role->id }}" {{ ($user->role_id == $role->id) ? "selected" : "" }}>{{ $role->role_name }}</option>

                                                            @empty

                                                            @endforelse

                                                          </select>

                                                        </div>

                                                        

                                                        

                                                        

                                                        <div class="form-group col-md-6">

                                                          <label for="CctMembershipNumber">CCT MEMBERSHIP NUMBER</label>

                                                          <input type="number" class="form-control" id="CctMembershipNumber" name="memnumber" value="{{ $crewmember->memnumber }}"
                                                          >

                                                        </div>

                                                        

                                                        

                                                    </div>

                                                </div>

                                                <div class="form-group col-xl-4 col-lg-12">

                                                    <div class="form-group col-md-12">

                                                            <div><label>ADDITIONAL</label></div>

                                                            <div class="form-check">

                                                            <input class="form-check-input" type="checkbox" name="firstaid" {{ !empty($crewmember->firstaid) ? "checked" : '' }}>

                                                                <label class="form-check-label" for="First Aid">First Aid</label>

                                                            </div>

                                                            <div class="form-check">

                                                            <input class="form-check-input" type="checkbox" name="cba" {{ !empty($crewmember->cba) ? "checked" : '' }}>

                                                                <label class="form-check-label" for="CBA">CBA</label>

                                                            </div>

                                                            

                                                            <div class="form-check">

                                                            <input class="form-check-input" type="checkbox" name="rya" {{ !empty($crewmember->rya) ? "checked" : '' }}>

                                                                <label class="form-check-label" for="RYA">RYA</label>

                                                            </div>

                                                            <div class="form-check">

                                                            <input class="form-check-input" type="checkbox" name="keyholder" {{ !empty($crewmember->keyholder) ? "checked" : '' }}>

                                                                <label class="form-check-label" for="Key Holder">Key Holder</label>

                                                            </div>

                                                            

                                                            <div class="form-check">

                                                            <input class="form-check-input" type="checkbox" name="iwa" {{ !empty($crewmember->iwa) ? "checked" : '' }}>

                                                                <label class="form-check-label" for="IWA">IWA</label>

                                                            </div>

                                                            <div class="form-check">

                                                                <input class="form-check-input" type="checkbox" value="Skipper">

                                                                <label class="form-check-label" for="Skipper">Skipper</label>

                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="optin" {{ !empty($crewmember->optin) ? "checked" : '' }}>
                                                                <label class="form-check-label" for="Skipper">Opted in for Details</label>
                                                            </div>
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

                                                    <p class="col-12-descrapction">Please set a temporary password for the crew member. They can update this once logged in.</p>

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

                                      

                                      <div class="form-group col-md-4">

                                        <div class="profile-picture">

                                            <label>PROFILE PICTURE</label>

                                            <img src="{{ asset("assets/images/profile-picture.png") }}" />

                                            

                                            <div class="teck-btn bg-white upload-btn">

                                                <input type="file" name="profileImage"  />

                                                <a href="#!"><img src="{{ asset("assets/images/camera.svg") }}" class="btn-icon-2" alt=""> Update Image </a>

                                            </div>

                                        </div>

                                      </div>

                                      

                                      

                                  </div>

                                  

                                  

                                  

                                    <div class="teck-btn">

                                        <button type="submit" class="btn btn-primary"> <img src="{{ asset("assets/images/save.svg") }}" class="img-fluid"> Create User </button>

                                    </div>

                                </form>

                                



                            </div>



                        </div>



                    </div>



                </div>



            </div>


            @stop
