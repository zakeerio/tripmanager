@extends('layouts.default')

@section('content')

<div class="row dashboard_col" id="activity-items-edit">
    <div class="col-md-12 dashboard_Sec">

        <h1>Activity Items - Edit existing activity item</h1>

        <p class="sub-pages-text">Please amend any details below and click save changes to submit the updated
            infromation.</p>

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

                <form class="teck-form" method="POST" action="{{route('item-activity-update')}}" enctype="multipart/form-data">

                    @csrf

                    <input type="hidden" value="{{$items->id}}" name="update_id">
                    <div class="form-row">

                        <div class="form-group col-xl-8 col-lg-12">

                            <div class="form-row">

                                <div class="form-group col-xl-4 col-lg-6">

                                    <label for="ActivityName">ACTIVITY NAME</label>
                                    @if($errors->any())
                                    <p style="color:red ;">{{$errors->first('activityname') }}</p>

                                    @endif
                                    <input type="text" class="form-control" id="ActivityName" name="activityname" value="{{$items->activityname}}">

                                </div>

                                <div class="form-group col-xl-4 col-lg-6">

                                    <label for="ActivityType">ACTIVITY TYPE</label>

                                    @if($errors->any())
                                    <p style="color:red ;">{{$errors->first('activitytype') }}</p>
                                    @endif

                                    <select id="ActivityType" class="form-control" name="activitytype">

                                        <option disabled>Please Select...</option>
                                        <option value="type-1">Type-1</option>
                                        <option value="type-2">Type-2</option>
                                        <option value="type-3">Type-3</option>

                                         <?php
                                         /*

                                        $boats = \App\Models\ActivityItem::all();
                                        if (!empty($boats)) {

                                            foreach ($boats as $b) {
                                        ?>
                                                <option value="{{$b->activityname}}" {{$b->activityname == $items->activityname ? 'selected':'' }}>{{$b->activityname}}</option>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <option value="">No Activity Found</option>
                                        <?php
                                        }
                                        */

                                        ?>

                                    </select>

                                </div>

                                <div class="form-group col-xl-4 col-lg-6">

                                    <label for="ActivityCapacity">ACTIVITY CAPACITY</label>

                                    @if($errors->any())
                                    <p style="color:red ;">{{$errors->first('activitycapacity') }}</p>
                                    @endif

                                    <input type="number" class="form-control" name="activitycapacity" value="{{$items->activitycapacity}}">

                                </div>

                                <div class="form-group col-xl-4 col-lg-6">

                                    <label for="MinimumCrewRequired">MINIMUM CREW REQUIRED</label>

                                    @if($errors->any())
                                    <p style="color:red ;">{{$errors->first('minimumcrew') }}</p>
                                    @endif
                                    <input type="number" class="form-control" id="minimumcrew" name="minimumcrew" value="{{$items->minimumcrew}}">

                                </div>

                                <div class="form-group col-xl-4 col-lg-12">

                                    <label for="ColourTag">COLOUR TAG</label>
                                    @if($errors->any())
                                    <p style="color:red ;">{{$errors->first('rgbcolor') }}</p>
                                    @endif
                                    <select id="ColourTag" class="form-control" name="rgbcolor">

                                        <option disabled>__RGB Selector__</option>

                                        <option value="red" {{"red" == $items->rgbcolor ? 'selected':'' }}>Red</option>

                                        <option value="green" {{"green" == $items->rgbcolor ? 'selected':'' }}>Green</option>

                                        <option value="blue" {{"blue" == $items->rgbcolor ? 'selected':'' }}>Blue</option>

                                    </select>

                                </div>

                            </div>

                        </div>



                        <div class="form-group col-xl-4 col-lg-12">

                            <div class="profile-picture">

                                <label>ACTIVITY PICTURE</label>

                                @if($errors->any)
                                <p style="color:red"> {{ $errors->first('image') }}</p>
                                @endif

                                <?php
                                if (isset($items->activitypicture) && file_exists(public_path() . '/assets/activity-images' . '/' . $items->activitypicture)) {
                                ?>
                                    <img src="{{asset('assets/activity-images').'/'.$items->activitypicture}}" class="img-fluid" alt="">
                                <?php
                                } else {
                                ?>

                                    <img src="{{ asset('assets/images/profile-picture.svg') }}" />

                                <?php
                                }
                                ?>


                                <div class="teck-btn bg-white upload-btn">

                                    <input type="file" name="activitypicture"  accept="image/*" />

                                    <a href="#!"><img src="{{ asset('assets/images/camera.svg') }}" class="btn-icon-2" alt=""> Update Image </a>

                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="teck-btn">

                        <button type="submit" class="btn btn-primary"> <img src="{{ asset('assets/images/save.svg') }}" class="img-fluid"> Update Item </button>

                    </div>

                </form>
            </div>

        </div>

    </div>

</div>

@stop
