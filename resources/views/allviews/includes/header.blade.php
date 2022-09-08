
        <div class="row">

            <div class="col-lg-6 col-6" id="logo-col">

                <div class="logo">

                    <a href="#!">

                        <img src="{{ asset('/assets/images/logo.png'); }}" class="img-fluid" alt="">

                    </a>

                </div>

            </div>

            <div class="col-lg-6 col-6" id="icon-col">

                <div class="icon-div">

                    <ul>

                        <li class="notification">
                            <span>12</span>
                            <a href="#!"><img src="{{ asset('/assets/images/notify.svg'); }}" class="alrt-img" alt=""></a>

                        </li>

                        <li>

                            <div class="profile">

                                <img src="{{ asset('/assets/images/Chacha.png'); }}" class="img-fluid" alt="">

                                   <div class="profile-matter">
                                    <p> <strong> {{ Auth::user()->name }} </strong></p>
                                    <p class="teck-name-color" >{{ Auth::user()->role['role_name'] }}</p>

                                   </div>

                               </div>

                        </li>

                    </ul>

                </div>

            </div>

        </div>


