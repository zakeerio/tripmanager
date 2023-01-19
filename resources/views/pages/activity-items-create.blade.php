@extends('layouts.default')

@section('content')

<div class="row dashboard_col" id="activity-items-create">
    <div class="col-md-12 dashboard_Sec">

        <h1>Activity Items - Create a new activity item</h1>

        <p class="sub-pages-text">These details will be added to all lcreation pages where an activity is selected.</p>

        <div class="teck-btn justify-content-start">

            <a href="{{ route('activity-items') }}" class="btn btn-primary"><img src="{{ asset('assets/images/go_back.png') }}" class="img-fluid" style="width:20px;"> Go Back</a>
        </div>

        @if(Session::get('status'))

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

    <div class="col-md-12 activies_table">

        <div class="row activity_col">

            <div class="col-md-12 dashboard-heading-desc">

                <div class="row">

                    <div class="col-lg-12 col-md-12 upcoming_activities">

                        <h4>Activity Information</h4>

                        <p class="col-12-descrapction">These details are used within the Activity Manager.</p>

                    </div>
                </div>

            </div>

            <div class="col-md-12">

                <form class="teck-form" method="POST" action="{{route('item-activity-add')}}" enctype="multipart/form-data">

                    @csrf

                    <div class="form-row">

                        <div class="form-group col-xl-8 col-lg-12">

                            <div class="form-row">

                                <div class="form-group col-xl-4 col-lg-6">

                                    <label for="ActivityName">ACTIVITY NAME</label>
                                    <input type="text" class="form-control" id="ActivityName" value="{{ old('activityname')}}" name="activityname">
                                    @if($errors->any())
                                    <p style="color:red ;">{{$errors->first('activityname') }}</p>

                                    @endif


                                </div>

                                <div class="form-group col-xl-4 col-lg-6">

                                    <label for="ActivityType">ACTIVITY TYPE</label>

                                    <select id="ActivityType" class="form-control" name="activitytype">

                                        <option disabled >Please Select...</option>

                                        @foreach ($activitytypes as $activitytype )
                                            <option value="{{ $activitytype->type_name }}"
                                                {{ (old('activitytype') &&  old('activitytype') == $activitytype->type_name ) ? "selected" : '' }}
                                            >
                                                {{  $activitytype->type_name }}
                                            </option>


                                        @endforeach

                                    </select>

                                    @if($errors->any())
                                    <p style="color:red ;">{{$errors->first('activitytype') }}</p>
                                    @endif

                                </div>

                                <div class="form-group col-xl-4 col-lg-6">

                                    <label for="ActivityCapacity">ACTIVITY CAPACITY</label>

                                    <input type="number" class="form-control"  name="activitycapacity" value="{{old('activityname')}}">

                                    @if($errors->any())
                                    <p style="color:red ;">{{$errors->first('activitycapacity') }}</p>
                                    @endif

                                </div>

                                <div class="form-group col-xl-4 col-lg-6">

                                    <label for="MinimumCrewRequired">MINIMUM CREW REQUIRED</label>

                                    <input type="number" class="form-control" id="minimumcrew" name="minimumcrew">
                                    @if($errors->any())
                                    <p style="color:red ;">{{$errors->first('minimumcrew') }}</p>
                                    @endif

                                </div>

                                <div class="form-group col-xl-4 col-lg-12">

                                    <label for="ColourTag">COLOUR TAG</label>

                                    <div class="d-flex justify-content-center">
                                        <input type="color" id="colorpicker" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#bada55">

                                        <input type="text" class="form-control" name="rgbcolor" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#bada55" id="hexcolor">
                                    </div>

                                    @if($errors->any())
                                    <p style="color:red ;">{{$errors->first('rgbcolor') }}</p>
                                    @endif

                                </div>

                            </div>

                        </div>



                        <div class="form-group col-xl-4 col-lg-12">

                            <div class="profile-picture">

                                <label>ACTIVITY PICTURE</label>

                                <img src="{{ asset('assets/images/profile-picture.png') }}" style="width: 220px; height: 220px;" class="img-fluid preview"/>

                                <div class="teck-btn bg-white upload-btn">

                                    <input type="file" name="activitypicture" accept="image/*" onchange="previewFile(this)" />

                                    <a href="#!"><img src="{{ asset('assets/images/camera.svg') }}" class="btn-icon-2" alt=""> Update Image </a>

                                </div>

                                @if($errors->any())
                                <p style="color:red ;">{{$errors->first('activitypicture') }}</p>
                                @endif

                            </div>

                        </div>

                    </div>



                    <div class="teck-btn">

                        <button type="submit" class="btn btn-primary"> <img src="{{ asset('assets/images/save.svg') }}" class="img-fluid"> Create Activity </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
@stop


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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


    // mehthod 1    onclick="previewFile(this);"


    function previewFile(input) {
        var file = $("input[type=file]").get(0).files[0];

        if (file) {
            var reader = new FileReader();

            reader.onload = function() {
                $(".preview").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    }
</script>

