@extends('layouts.default')

@section('content')


<div class="row dashboard_col" id="login">

    <div class="col-md-12 activies_table">

        <div class="row activity_col">
            <div class="teck-btn justify-content-start">

                <a href="{{ URL::previous() }}" class="btn btn-primary"><img src="{{ asset('assets/images/clander icon.png') }}" class="img-fluid"> Go Back</a>
            </div>

            <div class="col-md-12 dashboard-heading-desc upcoming_activities">
                <h4>Create Category </h4>
                <p class="col-12-descrapction">Here You can Categorize Your Documents By Assigning Name to A Category</p>

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

                <form class="teck-form upload-form" enctype="multipart/form-data" method="POST" action="{{route('/create-document-add')}}">

                    @csrf
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <label for="document-name"> Document Name</label>
                            <input type="name" class="form-control" name="doc_name" id="doc_name" value="">
                        </div>

                        <div class=" col-xl-6 col-lg-6">
                            <label for="document-name"> </label>
                            <div class="teck-btn" style="margin-top:5px;">
                                <button type="submit" class="btn btn-primary"> <img src="http://127.0.0.1:8000/assets/images/save.svg" class="img-fluid"> Create
                                    Category</button>
                            </div>

                        </div>

                    </div>
                </form>

                <div class="col-md-12 activies_table">
                    <div class="row activity_col">

                        <div class="col-md-12">
                            <div class="teck-table">

                                <table class="rwd-table">

                                    <thead>
                                        <tr>
                                            <th class="th-heading">Cateogry Name</th>
                                            <th class="th-heading">Created At</th>
                                            <th class="th-heading-brief">Action</th>

                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php

                                        $docx = \App\Models\DocumentCategory::all();

                                        // print_r($docx);
                                        // exit;

                                        if ($docx->isNotEmpty()) {

                                            foreach ($docx as $d) {
                                        ?>
                                                <tr>
                                                    <td>{{$d->name}}</td>
                                                    <td>{{$d->created_at}}</td>
                                                    <td class="action">

                                                        <div class="dropdown">
                                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span></span>
                                                                <span></span>
                                                                <span></span>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                                <a class="dropdown-item" href="{{route('/create-document-edit',[$d->id])}}">Edit</a>


                                                                <a class="dropdown-item" href="#" onclick="DeleteDocx('{{$d->id}}')">Delete</a>

                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }


                                        ?>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
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