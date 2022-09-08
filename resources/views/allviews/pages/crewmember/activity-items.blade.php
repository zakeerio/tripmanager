@extends('crewlayouts.default')

@section('content')
    <div class="row dashboard_col" id="activity-items">

        <div class="col-md-12 dashboard_Sec">

            <div class="row">

                <div class="col-xl-8 col-lg-12">

                    <h1>Activity Items</h1>

                    <p class="sub-pages-text">This is a list of all the scheduled activities in the Activity Manager system..
                    </p>

                </div>

                <div class="col-xl-4 col-lg-12">

                    <div class="teck-btn justify-content-end">

                        <a href="{{ route('crewmember.activity-items-create') }}"><img
                                src="./assets/images/Activity-Items.png" class="img-fluid">Create new item</a>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-12 activies_table">

            <div class="row activity_col">

                <div class="col-lg-8 col-md-12 upcoming_activities">



                </div>



                <div class="col-md-12">
                    <div class="teck-table">


                        <table class="rwd-table">

                            <tbody>

                                <tr>

                                    <th class="th-heading">Activity Name</th>

                                    <th class="th-heading">Type</th>

                                    <th class="th-heading-brief">Capacity</th>

                                    <th class="th-heading">Min Crew</th>

                                    <th class="th-heading">Info</th>

                                    <th class="th-heading">Info</th>

                                    <th class="th-heading">Info</th>

                                </tr>



                                <tr>

                                    <td>

                                        <div class="table-div">

                                            <img src="./assets/images/Picture-01.png" class="img-fluid" alt="">

                                            <p> <b> Hugh Henshall</b> </p>

                                        </div>

                                    </td>

                                    <td> Boat Trip </td>

                                    <td> 20 People </td>

                                    <td> 5 Crew Members </td>

                                    <td> Lorem ipsum... </td>

                                    <td> Lorem ipsum... </td>

                                    <td> Lorem ipsum... </td>



                                    <td class="action">
                                        <div class="dropdown">
                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                <a class="dropdown-item"
                                                    href="{{ route('crewmember.activity-items-edit') }}">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>




                                <tr>

                                    <td>

                                        <div class="table-div">

                                            <img src="./assets/images/Picture-01.png" class="img-fluid" alt="">

                                            <p> <b> Hugh Henshall</b> </p>

                                        </div>

                                    </td>

                                    <td> Boat Trip </td>

                                    <td> 20 People </td>

                                    <td> 5 Crew Members </td>

                                    <td> Lorem ipsum... </td>

                                    <td> Lorem ipsum... </td>

                                    <td> Lorem ipsum... </td>



                                    <td class="action">
                                        <div class="dropdown">
                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                <a class="dropdown-item"
                                                    href="{{ route('crewmember.activity-items-edit') }}">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>




                                <tr>

                                    <td>

                                        <div class="table-div">

                                            <img src="./assets/images/Picture-01.png" class="img-fluid" alt="">

                                            <p> <b> Hugh Henshall</b> </p>

                                        </div>

                                    </td>

                                    <td> Boat Trip </td>

                                    <td> 20 People </td>

                                    <td> 5 Crew Members </td>

                                    <td> Lorem ipsum... </td>

                                    <td> Lorem ipsum... </td>

                                    <td> Lorem ipsum... </td>



                                    <td class="action">
                                        <div class="dropdown">
                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                <a class="dropdown-item"
                                                    href="{{ route('crewmember.activity-items-edit') }}">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>




                                <tr>

                                    <td>

                                        <div class="table-div">

                                            <img src="./assets/images/Picture-01.png" class="img-fluid" alt="">

                                            <p> <b> Hugh Henshall</b> </p>

                                        </div>

                                    </td>

                                    <td> Boat Trip </td>

                                    <td> 20 People </td>

                                    <td> 5 Crew Members </td>

                                    <td> Lorem ipsum... </td>

                                    <td> Lorem ipsum... </td>

                                    <td> Lorem ipsum... </td>



                                    <td class="action">
                                        <div class="dropdown">
                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                <a class="dropdown-item"
                                                    href="{{ route('crewmember.activity-items-edit') }}">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>




                                <tr>

                                    <td>

                                        <div class="table-div">

                                            <img src="./assets/images/Picture-01.png" class="img-fluid" alt="">

                                            <p> <b> Hugh Henshall</b> </p>

                                        </div>

                                    </td>

                                    <td> Boat Trip </td>

                                    <td> 20 People </td>

                                    <td> 5 Crew Members </td>

                                    <td> Lorem ipsum... </td>

                                    <td> Lorem ipsum... </td>

                                    <td> Lorem ipsum... </td>



                                    <td class="action">
                                        <div class="dropdown">
                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                <a class="dropdown-item"
                                                    href="{{ route('crewmember.activity-items-edit') }}">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>

                            </tbody>

                        </table>
                    </div>

                </div>

            </div>


            <div class="row btm-row">

                <div class="col-md-6 teck-showin-text">Showing <b>1-50</b> of <b>46</b> available activities.</div>

                <div class="col-md-6">

                    <div class="pagination-row">

                        <button class="btn-prev teck-arrow">
                            < </button>

                                <ul class="pagination">

                                    <li class="active"> 1 </li>

                                    <li> 2 </li>

                                    <li> 3 </li>

                                    <li> 4 </li>

                                </ul>

                                <button class="btn-next teck-arrow">></button>

                    </div>

                </div>

            </div>

        </div>

    </div>
@stop
