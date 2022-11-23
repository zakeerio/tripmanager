@extends('layouts.default')

@section('content')
    <div class="row dashboard_col" id="my-activities">
        <div class="col-md-12 dashboard_Sec">
            <div class="row">
                <div class="col-xl-8 col-lg-12 teck-acticites">
                    <h1>Role and Permissions</h1>
                    <p>This is a list of all the scheduled activities in the Activity Manager system..</p>
                </div>

                <div class="col-xl-4 col-lg-12">
                    <div class="teck-btn justify-content-end" id="teck-btn-pag-3">
                        <a href="{{ route('all-activities-create',2) }}"><img src="{{ 'assets/images/clander icon.png' }}" class="img-fluid">Create Permission</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Roles and permissions section --}}
        <div class="col-md-12 activies_table">
            <div class="row activity_col">
                <div class="col-md-12">

                
                    @can('Permission write-artical')

                        <button class="btn btn-primary">Test</button>


                    @endcan
                    <div class="teck-table">
                        <h2>Admin</h2>
                        <div class="modelname">
                            <h3>App\Posts</h3>
                            <div class="persmissions">
                                <div class="permissionitem">
                                    <h4>Permisison name</h4>
                                    <div class="permissionvalue d-flex ">
                                        <div class="form-group"><input type="checkbox" class="form-inpt-control" name="create"> Create </div>
                                        <div class="form-group"><input type="checkbox" class="form-inpt-control" name="edit"> Edit </div>
                                        <div class="form-group"><input type="checkbox" class="form-inpt-control" name="delete"> Delete </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

@stop
