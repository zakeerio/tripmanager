@extends('layouts.default')

@section('content')



    <div class="row dashboard_col" id="document">

        <div class="col-md-7 document_Sec">
            <h1>Documents</h1>
            <p>Here you will find all the relevant CCT Activity documents..</p>
        </div>

        <div class="col-md-5 documents_Sec">
            <div class="teck-btn justify-content-end" id="teck-btn-pag-4">
                <a href="{{ route('developer.upload-document') }}"><img src="{{ asset('assets/images/folder.png') }}"
                        class="img-fluid">Create Category</a>
            </div>
        </div>



        <div class="col-lg-12 row-2">
            <div class="row">
                <div class="col-md-3 box-1 ">

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


                </div>

                <div class="col-md-3 box-1">
                    <form>
                        <div class="border-line"><span>Hugh Henshall</span>
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
                            <li class="box-li">Operations Manual (PDF) </li>
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
                </div>

                <div class="col-md-3 box-1 ">
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


                </div>
            </div>


        </div>


    </div>


@stop
