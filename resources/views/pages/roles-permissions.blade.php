@extends('layouts.default')

@section('content')



<div class="row dashboard_col" id="my-account">



    <div class="col-md-12 dashboard_Sec">

        <h1>Roles & Permissions</h1>

        <p class="sub-pages-text">This is your roles & persmissons area, please make sure your information is up to date.</p>
    </div>

    @if (Session::has('success'))
    <div class="alert alert-success col-12 mb-2 mt-3">
        @foreach (Session::get('success') as $msg )

        <li>{{ $msg }}</li>

        @endforeach
    </div>

    @endif

    <div class="col-md-12 activies_table">

        <div class="row activity_col">

            <div class="col-md-12 dashboard-heading-desc">
                <div class="col-lg-12 col-md-12 upcoming_activities">

                    <h4>Create Role</h4>

                    <!-- <p class="col-12-descrapction">You can freely ammend the information below to keep your records up to
                        date on our system.</p> -->
                </div>

            </div>

            <div class="col-md-12">

                <form class="teck-form" action="#" method="post" id="AddRole">
                    @csrf
                    <div class="form-row">

                        <div class="form-group col-md-12">

                            <div class="form-row">

                                <div class="form-group col-xl-6 col-lg-6">

                                    <label for="Name">Role Name</label>

                                    <input type="text" class="form-control" id="add_role" name="add_role" value="" autocomplete="off">

                                </div>

                                <div class="col-xl-6 col-lg-6 mt-2">
                                    <label for="Name"></label>
                                    <div class="teck-btn">
                                        <button type="submit" class="btn btn-primary"> <img src="{{ asset('assets/images/save.svg') }}" class="img-fluid"> Create Role</button>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </form>
            </div>

            <div class="col-md-12 dashboard-heading-desc">
                <div class="col-lg-12 col-md-12 upcoming_activities">

                    <h4>Create Permissions</h4>

                    <!-- <p class="col-12-descrapction">You can freely ammend the information below to keep your records up to
                        date on our system.</p> -->
                </div>
            </div>

            <div class="col-md-12">

                <form class="teck-form" action="{{ route('update-account') }}" method="post">
                    @csrf
                    <div class="form-row">

                        <div class="form-group col-md-12">

                            <div class="form-row">

                                <div class="form-group col-xl-6 col-lg-6">

                                    <label for="Name">Permission Name</label>

                                    <input type="text" class="form-control" id="Name" name="name" value="" autocomplete="off">

                                    <input type="hidden" name="id" value="">

                                </div>

                                <div class="col-xl-6 col-lg-6 mt-2">
                                    <label for="Name"></label>
                                    <div class="teck-btn">
                                        <button type="submit" class="btn btn-primary"> <img src="{{ asset('assets/images/save.svg') }}" class="img-fluid"> Create Role</button>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </form>
            </div>

        </div>


    </div>
</div>

@stop

 <!-- jquery -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <!-- jquery -->
<script>
    $(document).on('submit', '#AddRole', function(e) {

        e.stopPropagation();
        e.preventDefault();

        if ($('#add_role').val() == '') {

            ShowToast('Role Name Can not be Empty', 'error')
            return false;
        }
        let formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '{{ route("add-role") }}',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            crossDomain: true,
            success: (response) => {


                if (response.status) {
                    ShowAlert(response.data, 'success');
                    LoadProductGird();
                    this.reset()
                } else {
                    ShowAlert(response.data, 'error');
                }


            },
            error: function(response) {
                console.log("Error Message " + response.responseText);
                //alert(response.statusText);
            }

        });
    });

    $(document).on('click', '#product_close_btn', function(e) {

        LoadProductGird();
    });


    $(document).on('click', '.edit_product', function(e) {

        e.preventDefault();
        e.stopImmediatePropagation();
        e.stopPropagation();
        var item_id = $(this).attr('id');
        var flag = 'EditProduct'
        //alert(product_id)
        const settings = {
            "async": true,
            "crossDomain": true,
            "url": 'product_executive.php',
            "data": {
                flag: flag,
                item_id: item_id

            },
            'dataType': 'json',
            "method": "GET",
        };
        $.ajax(settings).done(function(response) {
            // alert(response.data)
            $('#load_content').html(response.data);
            $('#load_content').hide();
            $('#load_content').show(500);

        });

        $.ajax(settings).fail(function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        });

    });


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