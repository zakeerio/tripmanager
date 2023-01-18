@extends('layouts.default')

@section('content')



<div class="row dashboard_col" id="document">

    <div class="col-md-7 document_Sec">
        {{-- <div class="teck-btn justify-content-start">

            <a href="{{ URL::previous() }}" class="btn btn-primary"><img src="{{ asset('assets/images/go_back.png') }}" class="img-fluid" style="width:20px;"> Go Back</a>
        </div> --}}
        <br>
        <h1>Documents</h1>
        <p>Here you will find all the relevant CCT Activity documents..</p>

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

    @if(Session::get('role')!='crewmember')
    <div class="col-md-5 documents_Sec">
        <div class="teck-btn justify-content-end" id="teck-btn-pag-4">
            <a href="{{ route('/create-document-category') }}"><img src="{{ asset('assets/images/folder.png') }}" class="img-fluid">Create Category</a>
        </div>
    </div>
    @endif



    <div class="col-lg-12 row-2">
        <div class="row">

            <!-- <div class="col-md-3 box-1 ">
                    <form>
                        <div class="border-line"><span>All Documents</span></div>


                        <ul>
                            <li class="box-li">Boaters Handbook Video (Link) </li>
                            <li>
                                <div class="dropdown">
                                    <button class="btn" type="button" id="BtnAction" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="BtnAction">
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>

                            </li>
                        </ul>


                        <ul>
                            <li class="box-li">Boaters Handbook Video (Link) </li>
                            <li>
                                <div class="dropdown">
                                    <button class="btn" type="button" id="BtnAction" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="BtnAction">
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>

                            </li>
                        </ul>
                    </form>


                </div> -->


            <?php

            if (!empty($files)) {
                foreach ($files as $category) {
            ?>

                    <div class="col-md-3 box-1" style="height:auto !important;">
                        @if(Session::get('role')!='crewmember')
                            <div class="d-flex justify-content-end">
                                <a href="javascript:;" onclick="DeleteCategory('{{$category->id}}')" title="Delete Category" >
                                    <button type="button" class="badge badge-danger" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>

                        @endif

                        <form method="POST" action="{{route('/documents-save',$category->id)}}" enctype="multipart/form-data">

                            @csrf
                            <div class="col-md-12">
                                <h3><?php echo $category->name ?></h3>
                                {{-- <img src="{{ asset('assets/images/document.png') }}" class="document-icon-2"> --}}
                                <br>
                            </div>
                            @if(Session::get('role')!='crewmember')
                            <div class="row">

                                <div class="col-sm-6 col-xl-6">
                                    <input type="file" name="files[]" multiple >
                                </div>


                                <div class="col-sm-6 col-xl-6">
                                    <button class="btn btn-danger" type="submit" id="BtnAction" style="float:right">
                                        Upload
                                    </button>
                                </div>

                            </div>

                            @endif
                            <?php

                            if (!empty($category->GetFiles)) {
                                foreach ($category->GetFiles as $items) {

                                    if (isset($items->file_name)) {
                                        $fn = explode('@_@', $items->file_name);
                                        $filename = explode('.', $fn[1]);
                                        $ext = explode('.', $items->file_name);
                                    } else {
                                        $filename[0] = 'No File';
                                    }
                                    // print_r($ext[0]);
                                    // ( {{ucwords($ext[1])}} )
                            ?>
                                    <ul>
                                        <li class="box-li"><?php echo $filename[0].".".$ext[1] ?> </li>
                                        <li>
                                            <div class="dropdown">
                                                <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                    @if(Session::get('role')!='crewmember')
                                                    <a class="dropdown-item" href="{{route('/documents-delete',$items->id)}}">Delete</a>
                                                    @endif
                                                    <a class="dropdown-item" href="{{route('/documents-download',$items->file_name)}}">Download</a>
                                                </div>
                                            </div>

                                        </li>
                                    </ul>

                                <?php
                                }
                            } else {
                                ?>
                                <ul>
                                    <li class="box-li">No File Exits</li>
                                    <li>
                                        <div class="dropdown">
                                            <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <!-- <div class="dropdown-menu" aria-labelledby="BtnAction">
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div> -->
                                        </div>

                                    </li>
                                </ul>
                            <?php
                            }


                            ?>
                        </form>
                    </div>

                <?php
                }
            } else {
                ?>

                <div class="col-md-3 box-1 ">
                    <form>
                        <div class="border-line">
                            <span>No Category Found</span>
                            <a href="#!">
                                <img src="{{ asset('assets/images/document.png') }}" class="document-icon-2">
                                <input type="file" class="input-document-file">
                            </a>
                            <ul>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </button>
                                        <!-- <div class="dropdown-menu" aria-labelledby="BtnAction">
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div> -->
                                    </div>

                                </li>
                            </ul>
                        </div>


                        <ul>
                            <li class="box-li">No File Found </li>
                            <li>
                                <div class="dropdown">
                                    <button class="btn" type="button" id="BtnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </button>
                                    <!-- <div class="dropdown-menu" aria-labelledby="BtnAction">
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div> -->
                                </div>

                            </li>
                        </ul>

                    </form>


                </div>
            <?php
            }

            ?>




            <!-- <div class="col-md-3 box-1 ">
                    <form>
                        <div class="border-line">
                            <span>Seth Ellis</span>
                            <a href="#!">
                                <img src="{{ asset('assets/images/document.png') }}" class="document-icon-2">
                                <input type="file" class="input-document-file">
                            </a>
                            <ul>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn" type="button" id="BtnAction" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="BtnAction">
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>

                                </li>
                            </ul>
                        </div>


                        <ul>
                            <li class="box-li">Trip Guidelines (PDF) </li>
                            <li>
                                <div class="dropdown">
                                    <button class="btn" type="button" id="BtnAction" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="BtnAction">
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>

                            </li>
                        </ul>

                    </form>


                </div> -->
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

    function ShowWarningAlert(msg) {


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
                // Swal.fire(
                //     'Deleted!',
                //     'Category has been deleted.',
                //     'success'
                // )
            }

            return result.isConfirmed
        });


    }

    function DeleteCategory(id) {

        if (confirm('Do You Want Delete ?')) {
            window.location.href = "{{URL::to('document-category-delete')}}/" + id;
        }

        // if (ShowWarningAlert('Do You Want Delete ?')) {
        //     window.location.href = "{{URL::to('document-category-delete')}}/" + id;
        // }

    }
</script>
