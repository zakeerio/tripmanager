@extends('layouts.default')

@section('content')

    <div class="row dashboard_col" id="dashboard">

        <div class="col-md-12 dashboard_Sec">

            <h1>Dashboard</h1>

            <p class="D-paragraph">Hey Rod, welcome to your dashboard.</p>

        </div>
        <div class="col-lg-12 row-2">

            <div class="row">

                <div class="col-lg-3 col-md-12 teck-first-colum">

                    <div class="icon-box">

                        <img src="{{ asset('assets/images/1.png') }}" class="img-box" alt="">

                        <p>
                            <span>{{ $current_month_crews->count() }}</span>
                            Activities <br> This Month

                        </p>

                    </div>

                </div>

                <div class="col-lg-3 col-md-12 teck-second-colum">

                    <div class="icon-box">

                        <img src="{{ asset('assets/images/2.png') }}" class="img-box" alt="">

                        <p>
                            <span>86</span>
                            Hours Logged <br> This Month

                        </p>

                    </div>

                </div>

                <div class="col-lg-3 col-md-12 teck-third-colum">

                    <div class="icon-box">

                        <img src="{{ asset('assets/images/3.png') }}" class="img-box" alt="">

                        <p>
                            <span>86</span>
                            Hours Logged <br> This Year

                        </p>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-12 activies_table">

            <div class="row activity_col">

                <div class="col-md-12 dashboard-heading-desc">
                    <div class="row">
                        <div class="col-lg-8 col-md-12 upcoming_activities">
                            <h4>Your upcoming activities <span class="circle-green">3</span></h4>
                            <p class="col-12-descrapction">Below is a list of the upcoming activities you are scheduled to
                                attend within the next 30 days.</p>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <div class="teck-btn-view-activites justify-content-end">
                                <a href="{{ route('my-activities') }}"><img
                                        src="{{ asset('assets/images/All-Activities.png') }}"
                                        class="view-activites-icon">View all my activities</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="teck-table">
                        <table class="rwd-table">

                            <tbody>

                                <tr>

                                    <th>Activity</th>

                                    <th>Activity Date</th>

                                    <th>Brief</th>

                                    <th>Duration</th>

                                    <th>Crew Needed</th>

                                    <th>Crew</th>

                                    <th>Status</th>

                                </tr>

                                <tr>

                                    <td data-th="Supplier Code">

                                        <div class="table-div">

                                            <img src="{{ asset('assets/images/Picture-01.png') }}" class="img-fluid"
                                                alt="">

                                            <p><b>Hugh Henshall </b><br> #7083 </p>

                                        </div>

                                    </td>

                                    <td data-th="Supplier Name">

                                        <p>

                                            Tue 26th July '22 <br> 09:00 AM

                                        </p>

                                    </td>

                                    <td data-th="Invoice Number">

                                        Tuesday Bacon Cob Cruise

                                    </td>

                                    <td data-th="Invoice Date">

                                        8 hours

                                    </td>

                                    <td data-th="Due Date">

                                        6 Crew Members

                                    </td>

                                    <td data-th="Net Amount">

                                        <p>ADL, CH, KW1,

                                            PLE, AB, JKL</p>

                                    </td>

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
                                                    href="{{ route('all-activities-edit', 3) }}">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="teck-danger">

                                    <td data-th="Supplier Code">

                                        <div class="table-div">

                                            <img src="{{ asset('assets/images/Picture-02.png') }}" class="img-fluid"
                                                alt="">

                                            <p><b>Seth Ellis</b><br> #7084 </p>

                                        </div>

                                    </td>

                                    <td data-th="Supplier Name">

                                        <p>

                                            Wed 27th July '22 <br> 09:15 AM

                                        </p>

                                    </td>

                                    <td data-th="Invoice Number">

                                        Drakehouse 2 hour cruises

                                    </td>

                                    <td data-th="Invoice Date">

                                        7.5 hours

                                    </td>

                                    <td data-th="Due Date">

                                        4 Crew Members

                                    </td>

                                    <td data-th="Net Amount">

                                        <p>ADL, CH,</p>

                                    </td>

                                    <td data-th="Net Amount" class="crew_btn">

                                        <span class="active-btn-2"><img
                                                src="{{ asset('assets/images/Button-Crew-Needed.png') }}" class="img-fluid"
                                                alt=""> Crew Needed</span>

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
                                                    href="{{ route('all-activities-edit', 3) }}">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>

                                    </td>

                                </tr>

                                <tr>

                                    <td data-th="Supplier Code">

                                        <div class="table-div">

                                            <img src="{{ asset('assets/images/Picture-02.png') }}" class="img-fluid"
                                                alt="">

                                            <p><b>Hugh Henshall</b><br> #7083 </p>

                                        </div>

                                    </td>

                                    <td data-th="Supplier Name">

                                        <p>

                                            Tue 26th July '22 <br> 09:00 AM

                                        </p>

                                    </td>

                                    <td data-th="Invoice Number">

                                        Tuesday Bacon Cob Cruise

                                    </td>

                                    <td data-th="Invoice Date">

                                        8 hours

                                    </td>

                                    <td data-th="Due Date">

                                        6 Crew Members

                                    </td>

                                    <td data-th="Net Amount">

                                        <p>ADL, CH, KW1,

                                            PLE, AB, JKL</p>

                                    </td>

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
                                                    href="{{ route('all-activities-edit', 3) }}">Edit</a>
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

        </div>

    </div>

@stop
