@extends('layouts.default')

@section('content')

    <div class="row dashboard_col" id="activity-items-edit">
        <div class="col-md-12 dashboard_Sec">

            <h1>Activity Items - Edit existing activity item</h1>

            <p class="sub-pages-text">Please amend any details below and click save changes to submit the updated
                infromation.</p>

        </div>

        <div class="col-md-12 activies_table">

            <div class="row activity_col">

                <div class="col-md-12 dashboard-heading-desc">

                    <div class="row">
                        <div class="col-lg-12 col-md-12 upcoming_activities">
                            <h4>Activity Information</h4>
                            <p class="col-12-descrapction">These details are used within the Activity Manager.</p>
                        </div>
                    </div>

                </div>

                <div class="col-md-12">

                    <form class="teck-form">

                        <div class="form-row">

                            <div class="form-group col-xl-8 col-lg-12">

                                <div class="form-row">

                                    <div class="form-group col-xl-4 col-lg-6">

                                        <label for="ActivityName">ACTIVITY NAME</label>

                                        <input type="text" class="form-control" id="ActivityName" value="Hugh Henshall">

                                    </div>

                                    <div class="form-group col-xl-4 col-lg-6">

                                        <label for="ActivityType">ACTIVITY TYPE</label>

                                        <select id="ActivityType" class="form-control">

                                            <option>Please Select...</option>

                                            <option selected>Boat Trips</option>

                                            <option>...</option>

                                            <option>...</option>

                                        </select>

                                    </div>

                                    <div class="form-group col-xl-4 col-lg-6">

                                        <label for="ActivityCapacity">ACTIVITY CAPACITY</label>

                                        <input type="number" class="form-control" id="ActivityCapacity" value="20">

                                    </div>

                                    <div class="form-group col-xl-4 col-lg-6">

                                        <label for="MinimumCrewRequired">MINIMUM CREW REQUIRED</label>

                                        <input type="number" class="form-control" id="MinimumCrewRequired" value="5">

                                    </div>

                                    <div class="form-group col-xl-4 col-lg-12">

                                        <label for="ColourTag">COLOUR TAG</label>

                                        <select id="ColourTag" class="form-control">

                                            <option>RGB Selector</option>

                                            <option selected>#99ff66</option>

                                            <option>...</option>

                                            <option>...</option>

                                        </select>

                                    </div>

                                </div>

                            </div>



                            <div class="form-group col-xl-4 col-lg-12">

                                <div class="profile-picture">

                                    <label>ACTIVITY PICTURE</label>

                                    <img src="{{ asset('assets/images/activity-picture.png') }}" />

                                    <div class="teck-btn bg-white upload-btn">

                                        <input type="file" />

                                        <a href="#!"><img src="{{ asset('assets/images/camera.svg') }}"
                                                class="btn-icon-2" alt=""> Update Image </a>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <div class="teck-btn">

                            <button type="submit" class="btn btn-primary"> <img src="{{ asset('assets/images/save.svg') }}"
                                    class="img-fluid"> Create Activity </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

@stop
