@extends('crewlayouts.default')

@section('content')

    <div class="row dashboard_col" id="all-activities">
        <div class="col-md-12 dashboard_Sec">
            <div class="row">
                <div class="col-xl-8 col-lg-12 main-heading-desc all-activites-colum">
                    <h1>All Activities</h1>
                    <p>This is a list of all the scheduled activities in the Activity Manager system..</p>
                </div>

                <div class="col-xl-4 col-lg-12 teck-btn-pag-2">
                    <div class="btn-filter">
                        <div class="teck-btn justify-content-start bg-white">
                            <a href="#!"><img src="{{ asset('assets/images/Activity-Items.png') }}" class="btn-icon-2"
                                    alt="">Filter by activity item </a>

                            <ul class="teck-dropdown">
                                <li>Item 01</li>
                                <li>Item 02</li>
                                <li>Item 03</li>
                            </ul>
                        </div>

                        <div class="teck-btn justify-content-end">
                            <a href="{{ route('crewmember.all-activities-create') }}"><img
                                    src="{{ asset('assets/images/clander icon.png') }}" class="img-fluid">Create
                                Activity</a>
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
                                        <th class="th-heading">Activity</th>
                                        <th class="th-heading">Activity Date</th>
                                        <th class="th-heading-brief">Brief</th>
                                        <th class="th-heading">Duration</th>
                                        <th class="th-heading">Crew Needed</th>
                                        <th class="th-heading">Crew</th>
                                        <th class="th-heading">Status</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="table-div">
                                                <img src="{{ asset('assets/images/Picture-01.png') }}" class="img-fluid"
                                                    alt="">
                                                <p> <b> Hugh Henshall</b> <br> #7083 </p>
                                            </div>
                                        </td>
                                        <td>Tue 26th July '22 <br> 09:00 AM</td>
                                        <td>Tuesday Bacon Cob Cruise</td>
                                        <td>8 hours</td>
                                        <td>6 Crew Members</td>
                                        <td>ADL, CH, KW1,<br>
                                            PLE, AB, JKL</td>
                                        <td data-th="Net Amount">
                                            <span class="active-btn"><img
                                                    src="{{ asset('assets/images/Activity-Ready-Button.png') }}"
                                                    class="img-fluid" alt=""> Activity Ready</span>
                                        </td>

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
                                                        href="{{ route('crewmember.all-activities-edit', 2) }}">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>

                                        </td>

                                    </tr>

                                    <tr class="teck-danger">
                                        <td>
                                            <div class="table-div">
                                                <img src="{{ asset('assets/images/Picture-02.png') }}" class="img-fluid"
                                                    alt="">
                                                <p> <b> Seth Ellis </b> <br> #7084
                                            </div>
                                        </td>
                                        <td>Wed 27th July '22 <br> 09:15 AM</td>
                                        <td>Drakehouse 2 hour cruises</td>
                                        <td>7.5 hours</td>
                                        <td>4 Crew Members</td>
                                        <td data-th="Net Amount">ADL, CH,</td>
                                        <td data-th="Net Amount" class="crew_btn">
                                            <span class="active-btn-2"><img
                                                    src="{{ asset('assets/images/Button-Crew-Needed.png') }}"
                                                    class="alrt-image" alt=""> Crew Needed</span>
                                        </td>

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
                                                        href="{{ route('crewmember.all-activities-edit', 2) }}">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="table-div">
                                                <img src="{{ asset('assets/images/Picture-02.png') }}" class="img-fluid"
                                                    alt="">
                                                <p> <b> Henshall </b> <br> #7083 </p>
                                            </div>
                                        </td>
                                        <td>Tue 26th July '22 <br> 09:00 AM</td>
                                        <td>Tuesday Bacon Cob Cruise</td>
                                        <td>8 hours</td>
                                        <td>6 Crew Members</td>
                                        <td data-th="Net Amount">ADL, CH, KW1,<br> PLE, AB, JKL</td>
                                        <td data-th="Net Amount">
                                            <span class="active-btn"><img
                                                    src="{{ asset('assets/images/Activity-Ready-Button.png') }}"
                                                    class="img-fluid" alt=""> Activity Ready</span>
                                        </td>

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
                                                        href="{{ route('crewmember.all-activities-edit', 2) }}">Edit</a>
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
    </div>
@stop
