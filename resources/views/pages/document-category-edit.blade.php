@extends('layouts.default')

@section('content')


<div class="row dashboard_col" id="login">

    <div class="col-md-12 activies_table">

        <div class="row activity_col">
            <div class="teck-btn justify-content-start">

                <a href="{{ URL::previous() }}" class="btn btn-primary"><img src="{{ asset('assets/images/clander icon.png') }}" class="img-fluid"> Go Back</a>
            </div>

            <div class="col-md-12 dashboard-heading-desc upcoming_activities">
                <h4>Update Category </h4>
                <p class="col-12-descrapction">Here You can Edit Your Documents Cateogry Titles</p>

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

                <form class="teck-form upload-form" enctype="multipart/form-data" method="POST" action="{{route('/create-document-update')}}">

                    @csrf
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <label for="document-name"> Document Name</label>

                            <?php 

                                $cat_name = isset($cat[0]->name)? $cat[0]->name:'';

                              
                            
                            ?>
                            <input type="name" class="form-control" name="doc_name" id="doc_name" value="{{ $cat_name}}">
                            <input type="hidden" name="update_id" value="{{$cat[0]->id}}">
                        </div>

                        <div class=" col-xl-6 col-lg-6">
                            <label for="document-name"> </label>
                            <div class="teck-btn" style="margin-top:5px;">
                                <button type="submit" class="btn btn-primary"> <img src="http://127.0.0.1:8000/assets/images/save.svg" class="img-fluid">Update
                                    Category Name</button>
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