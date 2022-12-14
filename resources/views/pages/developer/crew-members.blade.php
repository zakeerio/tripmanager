@extends('layouts.default')

@section('content')


    <div class="row dashboard_col" id="crew-members">
        <div class="col-md-12 dashboard_Sec">
            <div class="row">
                <div class="col-xl-7 col-lg-12">
                    <h1>Crew Members</h1>
                    <p class="sub-pages-text">This is a list of all the scheduled activities in the
                        Activity Manager system..</p>
                </div>

                <div class="col-xl-5 col-lg-12">
                    <div class="btn-filter">
                        <div class="teck-btn justify-content-start bg-white">
                            <a href="#!"><img src="{{ asset('assets/images/rol icon.png') }}" class="btn-icon-2"
                                    alt=""> Filter by Role </a>

                            <ul class="teck-dropdown">
                                <li>Item 01</li>
                                <li>Item 02</li>
                                <li>Item 03</li>
                            </ul>
                        </div>



                        <div class="teck-btn justify-content-end">
                            <a href="{{ route('developer.crew-members-create') }}"><img
                                    src="{{ asset('assets/images/user.png') }}" class="img-fluid">Create new user</a>
                        </div>
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

                        <table class="rwd-table" id="datatables">
                            <thead>
                                <tr>
                                    <th class="th-heading">Name</th>
                                    <th class="th-heading">Email</th>
                                    <th class="th-heading-brief">Phone</th>
                                    <th class="th-heading">First Aid</th>
                                    <th class="th-heading">Key Holder</th>
                                    <th class="th-heading">Skipper</th>
                                    <th class="th-heading">RYA</th>
                                    <th class="th-heading">CBA</th>
                                    <th class="th-heading">Role</th>
                                    <th class="th-heading">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($crew_members as $crewmember)
                                    {{-- {{ dd($crewmember) }} --}}

                                    {{-- "id" => 1
                                    "initials" => "DJM"
                                    "firstaid" => ""
                                    "rya" => ""
                                    "cba" => ""
                                    "iwa" => ""
                                    "keyholder" => ""
                                    "skipper" => ""
                                    "mobile" => ""
                                    "privilege" => 2
                                    "username" => "danielmorris"
                                    "optin" => ""
                                    "faexpire" => null
                                    "boatpreference" => ""
                                    "traveltime" => 0
                                    "memnumber" => "1471"
                                    "suspended" => 0 --}}


                                    <tr>
                                        <td>
                                            <div class="table-div">
                                                <img src="{{ asset('assets/images/Chacha.png') }}" class="img-fluid"
                                                    alt="">
                                                <p> <b> {{ $crewmember->fullname }}</b> <br> ({{ $crewmember->initials }})
                                                </p>
                                            </div>
                                        </td>
                                        <td> {{ $crewmember->emailaddress }} </td>
                                        <td> {{ $crewmember->mobile }} </td>
                                        <td> {{ $crewmember->firstaid }} </td>
                                        <td> {{ $crewmember->keyholder }}</td>
                                        <td> {{ $crewmember->skipper }} </td>
                                        <td> {{ $crewmember->rya }} </td>
                                        <td> {{ $crewmember->cba }} </td>
                                        <td> {{ $crewmember->user ? $crewmember->user->role['role_name'] : '(No Role)' }}
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
                                                        href="{{ route('developer.crew-members-edit', $crewmember->id) }}/">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                @endforelse
                                {{-- <tr>
                                    <td>
                                        <div class="table-div">
                                            <img src="{{ asset("assets/images/crew-02.png") }}"  class="img-fluid"
                                                alt="">
                                            <p> <b> Rod Auton</b> <br> (RA) </p>
                                        </div>
                                    </td>
                                    <td> rodauton@example.com </td>
                                    <td> 07562852305 </td>
                                    <td> YES </td>
                                    <td> YES </td>
                                    <td> NO </td>
                                    <td> NO </td>
                                    <td> NO </td>
                                    <td> Crew Member </td>

                                    <td class="action">
                                        <div class="dropdown">
                                            <button class="btn" type="button" id="BtnAction"
                                                data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                <a class="dropdown-item"
                                                    href="{{ route("developer.crew-members-edit") }}">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-div">
                                            <img src="{{ asset("assets/images/Chacha.png") }}"  class="img-fluid"
                                                alt="">
                                            <p> <b> Rod Auton</b> <br> (RA) </p>
                                        </div>
                                    </td>
                                    <td> rodauton@example.com </td>
                                    <td> 07562852305 </td>
                                    <td> YES </td>
                                    <td> YES </td>
                                    <td> NO </td>
                                    <td> NO </td>
                                    <td> NO </td>
                                    <td> Crew Member </td>

                                    <td class="action">
                                        <div class="dropdown">
                                            <button class="btn" type="button" id="BtnAction"
                                                data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                <a class="dropdown-item"
                                                    href="{{ route("developer.crew-members-edit") }}">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-div">
                                            <img src="{{ asset("assets/images/Chacha.png") }}"  class="img-fluid"
                                                alt="">
                                            <p> <b> Rod Auton</b> <br> (RA) </p>
                                        </div>
                                    </td>
                                    <td> rodauton@example.com </td>
                                    <td> 07562852305 </td>
                                    <td> YES </td>
                                    <td> YES </td>
                                    <td> NO </td>
                                    <td> NO </td>
                                    <td> NO </td>
                                    <td> Crew Member </td>

                                    <td class="action">
                                        <div class="dropdown">
                                            <button class="btn" type="button" id="BtnAction"
                                                data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                <a class="dropdown-item"
                                                    href="{{ route("developer.crew-members-edit") }}">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-div">
                                            <img src="{{ asset("assets/images/Chacha.png") }}"  class="img-fluid"
                                                alt="">
                                            <p> <b> Rod Auton</b> <br> (RA) </p>
                                        </div>
                                    </td>
                                    <td> rodauton@example.com </td>
                                    <td> 07562852305 </td>
                                    <td> YES </td>
                                    <td> YES </td>
                                    <td> NO </td>
                                    <td> NO </td>
                                    <td> NO </td>
                                    <td> Crew Member </td>

                                    <td class="action">
                                        <div class="dropdown">
                                            <button class="btn" type="button" id="BtnAction"
                                                data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                <a class="dropdown-item"
                                                    href="{{ route("developer.crew-members-edit") }}">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-div">
                                            <img src="{{ asset("assets/images/Chacha.png") }}"  class="img-fluid"
                                                alt="">
                                            <p> <b> Rod Auton</b> <br> (RA) </p>
                                        </div>
                                    </td>
                                    <td> rodauton@example.com </td>
                                    <td> 07562852305 </td>
                                    <td> YES </td>
                                    <td> YES </td>
                                    <td> NO </td>
                                    <td> NO </td>
                                    <td> NO </td>
                                    <td> Crew Member </td>

                                    <td class="action">
                                        <div class="dropdown">
                                            <button class="btn" type="button" id="BtnAction"
                                                data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                <a class="dropdown-item"
                                                    href="{{ route("developer.crew-members-edit") }}">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-div">
                                            <img src="{{ asset("assets/images/Chacha.png") }}"  class="img-fluid"
                                                alt="">
                                            <p> <b> Rod Auton</b> <br> (RA) </p>
                                        </div>
                                    </td>
                                    <td> rodauton@example.com </td>
                                    <td> 07562852305 </td>
                                    <td> YES </td>
                                    <td> YES </td>
                                    <td> NO </td>
                                    <td> NO </td>
                                    <td> NO </td>
                                    <td> Crew Member </td>

                                    <td class="action">
                                        <div class="dropdown">
                                            <button class="btn" type="button" id="BtnAction"
                                                data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                <a class="dropdown-item"
                                                    href="{{ route("developer.crew-members-edit") }}">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>

                                </tr> --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            {{-- <div class="row btm-row">
                <div class="col-md-6 teck-showin-text">Showing <b>1-50</b> of <b>46</b> available
                    activities.</div>
                <div class="col-md-6">
                    <div class="pagination-row">
                        <button class="btn-prev teck-arrow"> < </button>
                                <ul class="pagination">
                                    <li class="active"> 1 </li>
                                    <li> 2 </li>
                                    <li> 3 </li>
                                    <li> 4 </li>
                                </ul>
                                <button class="btn-next teck-arrow">></button>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>

@stop
