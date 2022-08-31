@extends('layouts.default')

@section('content')

    <div class="row dashboard_col" id="all-activities-edit">

        <div class="col-md-12 dashboard_Sec">

            <h1>Activities - Edit an existing activity</h1>
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



                    <form class="teck-form">
                        <div class="form-row">
                            <div class="form-group col-xl-4 col-lg-6">
                                <label for="ActivityNumber">ACTIVITY NUMBER</label>
                                <input type="text" name="tripnumber" class="form-control" id="ActivityNumber" value="{{ $activity->tripnumber }}">">
                            </div>
                            <div class="form-group col-xl-4 col-lg-6">
                                <label for="ActivityItem">SELECT ACTIVITY ITEM</label>

                                <select id="ActivityItem" name="boatname" class="form-control">
                                    <option value="Seth Ellis">Seth Ellis</option>
                                     <option value="Python" {{ ($activity->boatname == "Python") ? "selected" : ''; }} >Python</option>
                                     <option value="John Varley" {{ ($activity->boatname == "John Varley") ? "selected" : ''; }}>John Varley</option>
                                     <option value="Hugh Henshall" {{ ($activity->boatname == "Hugh Henshall") ? "selected" : ''; }}>Hugh Henshall</option>
                                     <option value="Canal talks" {{ ($activity->boatname == "Canal talks") ? "selected" : ''; }}>Canal talks</option>
                                     <option value="Dawn Rose" {{ ($activity->boatname == "Dawn Rose") ? "selected" : ''; }}>Dawn Rose</option>
                                     <option value="Madeline" {{ ($activity->boatname == "Madeline") ? "selected" : ''; }}>Madeline</option>
                                     <option value="James Brindley" {{ ($activity->boatname == "James Brindley") ? "selected" : ''; }}>James Brindley</option>
                                     <option value="Shop" {{ ($activity->boatname == "Shop") ? "selected" : ''; }}>Shop</option>
                                </select>


                            </div>
                            <div class="form-group col-xl-4 col-lg-12">
                                <label for="ActivityDate">ACTIVITY DATE</label>
                                 <input type="date" name="departuredate" class="form-control" id="ActivityDate" value="{{ $activity->departuredate }}">

                            </div>
                        </div>



                        <div class="form-row">
                            <div class="form-group col-xl-4 col-lg-6">
                                <label for="ActivityTime">ACTIVITY TIME</label>
                                <input type="time" name="departuretime" class="form-control" id="ActivityTime" value="{{ $activity->departuretime }}">
                            </div>
                            <div class="form-group col-xl-4 col-lg-6">
                                <label for="ActivityDuration">ACTIVITY DURATION</label>
                                <input type="number" name="duration" class="form-control" id="ActivityDuration" value="{{ $activity->duration }}">
                            </div>
                            <div class="form-group col-xl-4 col-lg-12">
                                <label for="BriefDescription">BRIEF DESCRIPTION</label>
                                <input type="text" name="destination" class="form-control" id="BriefDescription" value="{{ $activity->destination }}">
                            </div>
                        </div>



                        <div class="form-row">
                            <div class="col-lg-12 col-md-12 upcoming_activities">
                                <h4>Crew Information</h4>
                                <p class="col-12-descrapction">This information is regarding the crew of this activity.</p>
                            </div>
                            <div class="form-group col-xl-4 col-lg-12">
                                <label for="NumberCrewNeeded">NUMBER OF CREW NEEDED</label>
                                <input type="text" name="crewneeded" class="form-control" id="NumberCrewNeeded" value="{{ $activity->crewneeded }}">
                            </div>
                            <div class="form-group col-xl-5 col-lg-13">
                                <label for="TripCost">TRIP COST(£)</label>
                                <input type="number" name="tripcost" class="form-control" id="TripCost" value="{{ $activity->cost }}">
                            </div>
                            <div class="form-group col-xl-6 col-lg-14">
                                <label for="BalanceDue">BALANCE DUE(£)</label>
                                <input type="number" name="tripbalance" class="form-control" id="BalanceDue" value="{{ $activity->balance }}">
                            </div>
                             <div class="form-group col-xl-7 col-lg-15">
                                <label for="PassengerCout">PASSENGER COUNT</label>
                                <input type="number" name="passengers" class="form-control" id="PassengerCout" value="{{ $activity->passengers }}">
                            </div>
                         </div>

                            <div class="form-group col-md-12">
                                <label for="NotesCrew">NOTES FOR CREW</label>
                                <textarea class="form-control" id="NotesCrew" rows="5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ornare orci sit amet dui sagittis porttitor. Aliquam suscipit ligula et nisl ullamcorper lacinia. Nunc sagittis vitae lectus sit amet tincidunt. Nullam tristique, orci a consequat vehicula, arcu diam vehicula eros.</textarea>
                            </div>
                        </div>



                        <div class="form-row">
                            <div class="form-group col-xl-4 col-lg-12">
                                <label for="ConfirmedCrew">Confirmed Crew</label>
                                <select multiple class="form-control" id="ConfirmedCrew">
                                    <option>No one to show</option>
                                </select>
                            </div>

                            <div class="form-group col-xl-4 col-lg-12">
                                <label for="AvailableCrew">Available Crew</label>
                                <select multiple class="form-control" id="AvailableCrew">
                                    <option>No one to show</option>
                                </select>
                            </div>


                            <div class="form-group col-xl-4 col-lg-12">
                                <label for="UnavailableCrew">Unavailable Crew</label>
                                <select multiple class="form-control" id="UnavailableCrew">
                                    <option>Andy Karen</option>
                                    <option>Karen Gillan</option>
                                    <option>Anderson Smith</option>
                                    <option>William</option>
                                    <option>Hughei Jack</option>
                                    <option>Micheal</option>
                                    <option>Jimmy M.</option>
                                    <option>Francis Ann</option>
                                    <option>Ali Brownes</option>
                                    <option>Karen Gillan</option>
                                </select>
                            </div>

                        </div>

                        <div class="teck-btn">
                            <button type="submit" class="btn btn-primary"> <img src="{{ asset('assets/images/save.svg') }}"
                                    class="img-fluid"> Update Activity</button>
                        </div>
                    </form>


                </div>

            </div>

        </div>

    </div>

@stop
