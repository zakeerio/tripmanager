@extends('layouts.default')

@section('content')


<div class="row dashboard_col" id="login">

    <div class="col-md-12 activies_table">

        <div class="row activity_col">
            <div class="teck-btn justify-content-start">

                <a href="{{ route('/activity-types') }}" class="btn btn-primary"><img src="{{ asset('assets/images/go_back.png') }}" class="img-fluid"  style="width:26px; height:28px"> Go Back</a>
            </div>

            <div class="col-md-12 dashboard-heading-desc upcoming_activities">
                <h4>Update Activity Type</h4>
                <p class="col-12-descrapction">Here You can Edit Your Activity Types</p>

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

                <div class="row">
                    <div class="col-lg-12 col-md-12 upcoming_activities">

                    </div>
                </div>
            </div>


            <div class="col-md-12">

                <form class="teck-form upload-form" enctype="multipart/form-data" method="POST" action="{{route('/activity-type-update')}}">

                    @csrf
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <label for="type_name"> Document Name</label>

                            <?php
                                $cat_name = isset($cat[0]->type_name)? $cat[0]->type_name:'';
                            ?>
                            @if($errors->any())
                            <p style="color:red ;">{{$errors->first('type_name') }}</p>

                            @endif
                            <input type="name" class="form-control" name="type_name" id="type_name" value="{{ $cat_name}}">
                            <input type="hidden" name="update_id" value="{{$cat[0]->id}}">
                        </div>

                        <div class=" col-xl-6 col-lg-6">
                            <label for="document-name"> </label>
                            <div class="teck-btn" style="margin-top:5px;">
                                <button type="submit" class="btn btn-primary"> <img src="{{ asset('assets/images/save.svg') }}" class="img-fluid">Update
                                   Type</button>
                            </div>

                        </div>

                    </div>
                </form>


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


            function DeleteDocx(id) {

                if (confirm('Do You Want Delete ?')) {
                    window.location.href = "{{URL::to('create-document-delete')}}/" + id;
                }

            }
        </script>
