@extends('layouts.default')

@section('content')
<div class="row dashboard_col" id="analysis">
    <div class="col-md-12 dashboard_Sec">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <h1>Analysis</h1>
                <p class="sub-pages-text">This is a list all analysis results.</p>
                <a href="{{ URL::previous() }}" class="btn btn-primary">Go Back</a>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="btn-filter justify-content-end">
                    <div class="teck-btn bg-white">
                        <a href="#!"><img src="{{ asset('assets/images/rol icon.png') }}" class="btn-icon-2" alt="">
                            <span>Filter by Role <br> <b> Show all analysis</b></span> </a>

                        <ul class="teck-dropdown">
                            <li>Item 01</li>
                            <li>Item 02</li>
                            <li>Item 03</li>
                        </ul>
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
