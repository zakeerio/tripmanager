@extends('layouts.default')

@section('content')


<div class="row dashboard_col" id="login">

    <div class="col-md-12 activies_table">

        <div class="row activity_col">
            <div class="teck-btn justify-content-start">

                <a href="{{ URL::previous() }}" class="btn btn-primary"><img src="{{ asset('assets/images/go_back.png') }}" class="img-fluid" style="width:20px;"> Go Back</a>
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
                             @if($errors->any())
                             <p style="color:red ;">{{$errors->first('doc_name') }}</p>

                             @endif
                            <input type="name" class="form-control" name="doc_name" id="doc_name" value="{{ $cat_name}}">
                            <input type="hidden" name="update_id" value="{{$cat[0]->id}}">
                        </div>

                        <div class=" col-xl-6 col-lg-6">
                            <label for="document-name"> </label>
                            <div class="teck-btn" style="margin-top:5px;">
                                <button type="submit" class="btn btn-primary"> <img src="{{ asset('assets/images/save.svg') }}" class="img-fluid">Update Category Name</button>
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

            function ShowWarningAlert(msg,id) {


                Swal.fire({
                    title: 'Are you sure?',
                    text: msg,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('deleteID');
                        window.location.href = "{{URL::to('create-document-delete')}}/" + id;
                        // Swal.fire(
                        //     'Deleted!',
                        //     'Your file has been deleted.',
                        //     'success'
                        // )
                    }
                    return result.isConfirmed
                });


            }

            function DeleteDocx(id) {

                if (ShowWarningAlert('Do You Want Delete ?', id)) {
                    // window.location.href = "{{URL::to('create-document-delete')}}/" + id;

                }

            }


            // function DeleteDocx(id) {

            //     if (confirm('Do You Want Delete ?')) {
            //         window.location.href = "{{URL::to('create-document-delete')}}/" + id;
            //     }

            // }
        </script>
