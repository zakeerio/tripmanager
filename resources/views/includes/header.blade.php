<div class="row">

    <div class="col-lg-6 col-6" id="logo-col">

        <div class="logo">

            <a href="{{ route('dashboard') }}">

                <img src="{{ asset('/assets/images/logo.png'); }}" class="img-fluid" alt="">

            </a>

        </div>

    </div>

    <div class="col-lg-6 col-6" id="icon-col">

        <div class="icon-div">

            <ul>

                <!-- <li class="notification">
                    <span>12</span>

                    <a href="#!"><img src="{{ asset('/assets/images/notify.svg'); }}" class="alrt-img" alt=""></a>

                </li> -->

                <li>

                    <div class="profile">




                        @if(Session::has('profile') && Session::get('profile') != NULL)
                        <?php

                        if (file_exists(public_path() . '/assets/profile-images' . '/' . Session::get('profile'))) {
                        ?>
                            <img src="{{ asset('/assets/profile-images').'/'.Session::get('profile') }}" class="img-fluid userprofileimg" alt="">
                        <?php
                        } else {
                        ?>
                            <img src="{{ asset('/assets/images/Chacha.png'); }}" class="img-fluid userprofileimg" alt="">
                        <?php
                        }
                        ?>

                        @else
                        <img src="{{ asset('/assets/images/Chacha.png'); }}" class="img-fluid userprofileimg" alt="">
                        @endif


                        <div class="profile-matter">
                            <p> <strong>{{Session::get('name')}} </strong></p>
                            {{-- <p class="teck-name-color" >{{ (Auth::user() !== null) ? Auth::user()->role['name'] : ""  }}</p> --}}
                            <p class="teck-name-color">{{Session::get('role')}}</p>

                        </div>

                    </div>

                </li>

            </ul>

        </div>

    </div>

</div>
