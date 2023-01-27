@extends('layouts.default')

@section('content')
<div class="row dashboard_col" id="analysis">
    <div class="col-md-12 dashboard_Sec">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <h1>Analysis</h1>
                <p class="sub-pages-text">This is a list all analysis results.</p>
                {{-- <div class="teck-btn justify-content-start">

                    <a href="{{ URL::previous() }}" class="btn btn-primary"><img src="{{ asset('assets/images/go_back.png') }}" class="img-fluid" style="width:20px;"> Go Back</a>
                </div> --}}
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="btn-filter justify-content-end">

                    @php
                        $filtervalname= "";
                        $filterval = (\Request()->has('filter')) ? \Request()->get('filter') : '';
                        if($filterval !=""){
                            if($filterval == 1){
                                $filtervalname = "Admin";
                            } elseif ($filterval == 2) {
                                $filtervalname = "Crewmember";
                            } elseif ($filterval == 3) {
                                $filtervalname = "Developer";
                            }

                            $filter_check = 'filter='.$filterval."&";
                        } else {
                            $filter_check = '';
                        }

                        $yearval = (\Request()->has('year')) ? \Request()->get('year') : '';
                        if($yearval !=""){
                            $year_check = '&year='.$yearval;
                        } else {
                            $year_check = '';
                        }
                    @endphp

                    <div class="teck-btn filterbutton bg-white">
                        <a href="#!"><img src="{{ asset('assets/images/clander icon.png') }}" class="btn-icon-2" alt="">
                            <span>Filter By Year <br></span> </a>

                        <ul class="teck-dropdown">

                            <li><a href="{{ route('analytics') }}">None</a></li>
                            @foreach ($years as $year )
                                {{-- {{ $filter_check }} --}}
                                <li><a href="{{ route('analytics') }}?{{ $filter_check."year=".$year->year }}">{{ $year->year }}</a></li>

                            @endforeach
                        </ul>
                    </div>
                    &nbsp;&nbsp;
                    <div class="teck-btn filterbutton bg-white">
                        <a href="#!"><img src="{{ asset('assets/images/rol icon.png') }}" class="btn-icon-2" alt="">
                            <span>Filter by Role <br> <b> Show all analysis</b></span> </a>

                        <ul class="teck-dropdown">
                            <li><a href="{{ route('analytics') }}">None</a></li>
                            <li><a href="{{ route('analytics') }}?filter=1{{ $year_check }}">Admin</a></li>
                            <li><a href="{{ route('analytics') }}?filter=2{{ $year_check }}">Crewmember</a></li>
                            <li><a href="{{ route('analytics') }}?filter=3{{ $year_check }}">Developer</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12 activies_table">
        <div class="text-bold">{{ ($yearval) ? "Year ".$yearval : '' }} {{ ($filterval) ? " By ".$filtervalname : '' }}</div>
        <div class="row activity_col">
            <div class="col-lg-8 col-md-12 upcoming_activities">

            </div>

            <div class="col-md-12">
                <div class="teck-table">
                    <table class="rwd-table">

                        <thead>

                            <th class="th-heading">Crew</th>
                            <th class="th-heading">Code</th>
                            <th class="th-heading">Jan</th>
                            <th class="th-heading">Feb</th>
                            <th class="th-heading">Mar</th>
                            <th class="th-heading">Apr</th>
                            <th class="th-heading">May</th>
                            <th class="th-heading">June</th>
                            <th class="th-heading">July</th>
                            <th class="th-heading">Aug</th>
                            <th class="th-heading">Sept</th>
                            <th class="th-heading">Oct</th>
                            <th class="th-heading">Nov</th>
                            <th class="th-heading">Dec</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php

                            if (!empty($user)) {

                                foreach ($user as $u) {

                            ?>
                                    <tr>

                                        <td> <?php echo $u['fullname']; ?> </td>
                                        <td> <?php echo $u['crewcode']; ?> </td>
                                        <?php

                                        foreach ($u['year'] as $month_hours) {
                                            if($month_hours !=0){
                                                $badge='badge badge-success';
                                            }else{
                                                $badge='badge badge-warning';
                                            }
                                        ?>
                                            <td> <p class="<?php echo $badge?>"><?php echo $month_hours . " Hours" ?></p> </td>
                                    <?php
                                        }
                                    }

                                    ?>
                                    </tr>
                                <?php
                            }else{
                                ?>
                                <p>No Crew Found</p>
                                <?php
                            }


                               ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@stop
