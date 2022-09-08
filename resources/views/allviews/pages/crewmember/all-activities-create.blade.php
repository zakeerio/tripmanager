@extends('crewlayouts.default')

@section('content')
    <div class="row dashboard_col" id="all-activities-create">

        <div class="col-md-12 dashboard_Sec">

            <h1>All Activities - Create</h1>
            <p class="sub-pages-text">Please fill out the information below to create a activity.</p>

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



                    <form class="teck-form">
                        <div class="form-row">
                            <div class="form-group col-xl-4 col-lg-6">
                                <label for="ActivityNumber">ACTIVITY NUMBER</label>
                                <input type="text" name="tripnumber" class="form-control" id="ActivityNumber">
                            </div>
                            <div class="form-group col-xl-4 col-lg-6">
                                <label for="ActivityItem">SELECT ACTIVITY ITEM</label>
                                <select id="ActivityItem" name="boatname" class="form-control">
                                    <option value="Seth Ellis">Seth Ellis</option>
                                    <option value="Python">Python</option>
                                    <option value="John Varley">John Varley</option>
                                    <option value="Hugh Henshall">Hugh Henshall</option>
                                    <option value="Canal talks">Canal talks</option>
                                    <option value="Dawn Rose">Dawn Rose</option>
                                    <option value="Madeline">Madeline</option>
                                    <option value="James Brindley">James Brindley</option>
                                    <option value="Shop">Shop</option>
                                </select>
                            </div>
                            <div class="form-group col-xl-4 col-lg-12">
                                <label for="ActivityDate">ACTIVITY DATE</label>
                                <input type="date" name="departuredate" class="form-control" id="ActivityDate">
                            </div>
                        </div>



                        <div class="form-row">
                            <div class="form-group col-xl-4 col-lg-6">
                                <label for="ActivityTime">ACTIVITY TIME</label>
                                <input type="time" name="departuretime" class="form-control" id="ActivityTime">
                            </div>
                            <div class="form-group col-xl-4 col-lg-6">
                                <label for="ActivityDuration">ACTIVITY DURATION</label>
                                <input type="number" name="duration" class="form-control" id="ActivityDuration">
                            </div>
                            <div class="form-group col-xl-4 col-lg-12">
                                <label for="BriefDescription">BRIEF DESCRIPTION</label>
                                <input type="text" name="destination" class="form-control" id="BriefDescription">
                            </div>
                        </div>



                        <div class="form-row">
                            <div class="col-lg-12 col-md-12 upcoming_activities">
                                <h4>Crew Information</h4>
                                <p class="col-12-descrapction">This information is regarding the crew of this activity.</p>
                            </div>
                            <div class="form-group col-xl-4 col-lg-12">
                                <label for="NumberCrewNeeded">NUMBER OF CREW NEEDED</label>
                                <input type="text" name="crewneeded" class="form-control" id="NumberCrewNeeded">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="NotesCrew">NOTES FOR CREW</label>
                                <textarea class="form-control" id="NotesCrew" name="crewnotes" rows="5"></textarea>
                            </div>
                            <div class="form-group col-xl-5 col-lg-13">
                                <label for="TripCost">TRIP COST(£)</label>
                                <input type="number" name="tripcost" class="form-control" id="TripCost" value="0"
                                    size="6">
                            </div>
                            <div class="form-group col-xl-6 col-lg-14">
                                <label for="BalanceDue">BALANCE DUE (£)</label>
                                <input type="number" name="tripbalance" class="form-control" id="BalanceDue" value="0"
                                    size="6">
                            </div>
                            <div class="form-group col-xl-7 col-lg-15">
                                <label for="PassengerCout">PASSENGER COUNT</label>
                                <input type="number" name="passengers" class="form-control" id="PassengerCout"
                                    value="0" size="3">
                            </div>
                        </div>



                        <div class="form-row form-multi">
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
                            <button type="submit" class="btn btn-primary"> <img
                                    src="{{ asset('assets/images/save.svg') }}" class="img-fluid"> Create
                                Activity</button>
                        </div>
                    </form>


                </div>

            </div>

        </div>

    </div>
@stop
