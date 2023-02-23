@extends('layouts.default')

@section('content')


    <div class="row dashboard_col" id="login">

        <div class="col-md-12 activies_table">

            <div class="row activity_col">

                <div class="col-md-12 dashboard-heading-desc upcoming_activities">
                    <h4>Upload Document</h4>
                    <p class="col-12-descrapction">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 upcoming_activities">

                        </div>
                    </div>
                </div>


                <div class="col-md-12">



                    <form class="teck-form upload-form">
                        <div class="form-row">
                            <div class="form-group col-xl-6 col-lg-12 name-doc">
                                <label for="document-name"> Document Name</label>
                                <input type="name" class="form-control" id="user-name" value="">
                            </div>

                            <div class="form-group col-xl-6 col-lg-12 uploading">

                                <div class="upload-picture">
                                    <img src="{{ asset('assets/images/up-icon.png') }}" class="uplod-image">
                                    <div class="teck-btn bg-white upload-btn">
                                        <input type="file" />
                                        <a href="#!" class="apload-btn"><img
                                                src="{{ asset('assets/images/document.png') }}" class="btn-icon-2"
                                                alt=""> Upload document </a>
                                    </div>
                                </div>

                                <div class="form-group col-xl-12 col-lg-12">

                                </div>
                            </div>



                            <div class="teck-btn">
                                <a href="#" class="Save-Document"><img src="{{ asset('assets/images/') }}"
                                        class="save-icon" alt="">Save Document</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
