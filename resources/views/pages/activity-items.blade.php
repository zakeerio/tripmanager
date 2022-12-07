@extends('layouts.default')

@section('content')
<div class="row dashboard_col" id="activity-items">

    <div class="col-md-12 dashboard_Sec">

        <div class="row">

            <div class="col-xl-8 col-lg-12">

                <h1>Activity Items</h1>

                <p class="sub-pages-text">This is a list of all the scheduled activities in the Activity Manager system..
                </p>
                <a href="{{ URL::previous() }}" class="btn btn-primary">Go Back</a>


                @if (Session::has('status'))

                @if(Session::get('status'))
                <script>
                    var msg = "{{Session::get('msg')}}";
                    ShowToast(msg, 'success');
                </script>
                @else
                <script>
                    var msg = "{{Session::get('msg')}}";
                    ShowToast(msg, 'error');
                </script>
                @endif

                @endif

            </div>

            <div class="col-xl-4 col-lg-12">

                <div class="teck-btn justify-content-end">

                    <a href="{{ route('activity-items-create') }}"><img src="./assets/images/Activity-Items.png" class="img-fluid">Create new item</a>

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

                                <th class="th-heading">Color</th>

                                <th class="th-heading">Action</th>


                            </tr>

                            @forelse($items as $i)

                            <tr>

                                <td>

                                    <div class="table-div">

                                        <?php

                                            if(isset($i['activitypicture'])){
                                                    ?>
                                                     <img src="./assets/activity-images/<?php echo $i['activitypicture'] ?>" class="img-fluid" alt="">
                                                    <?php
                                            }else{
                                                ?>
                                                  <img src="./assets/images/Picture-01.png" class="img-fluid" alt="">
                                                <?php
                                            }
                                        ?>

                                        <p> <b>{{$i['activityname']}}</b> </p>

                                    </div>

                                </td>



                                <td> {{$i['activitytype']}}</td>

                                <td>{{$i['activitycapacity']}} </td>

                                <td> {{$i['minimumcrew']}}</td>

                                <td> {{$i['rgbcolor']}}</td>


                                <td class="action">
                                    <div class="dropdown">
                                        <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="BtnAction">
                                            <a class="dropdown-item" href="{{ route('activity-items-edit',$i['id']) }}">Edit</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            @empty
                            <p>No posts found</p>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>

        </div>



        {{-- <div class="row btm-row">

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

        </div> --}}


    </div>

</div>
@stop



<script>
    function ShowToast(msg, type) {


        if (type == 'error') {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'error',
                title: msg
            })

        } else if (type == 'success') {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: msg
            })
        }
    }
</script>
