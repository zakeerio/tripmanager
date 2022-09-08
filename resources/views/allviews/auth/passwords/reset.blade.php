@extends('layouts.applogin')

@section('content')

    <section class="banner-section login-page">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-6 col-md-12 m-auto " id="main-login">

                    <div class="row dashboard_col" id="login">

                        <div class="col-md-12 activies_table">

                            <div class="row activity_col">

                                <div class="col-md-12 dashboard-heading-desc upcoming_activities">
                                    <h4>Forget Password Form</h4>
                                    <p class="col-12-descrapction">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever
                                        since the 1500s.</p>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 upcoming_activities">

                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">

                                    <form class="teck-form" method="POST" action="{{ route('password.update') }}">
                                        @csrf

                                        <input type="hidden" name="token" value="{{ $token }}">

                                        <div class="form-row">

                                            <div class="form-group col-xl-12 col-lg-12">
                                                <label for="emailaddress">Email Address</label>
                                                <input id="emailaddress" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ $email ?? old('email') }}" required autocomplete="email"
                                                    autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>


                                            <div class="form-group col-xl-12 col-lg-12">
                                                <label for="password">NEW PASSWORD</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="new-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-xl-12 col-lg-12">
                                                <label for="password-confirm">CONFIRM PASSWORD</label>
                                                <input id="password-confirm" type="password" class="form-control"
                                                    name="password_confirmation" required autocomplete="new-password">
                                            </div>

                                        </div>

                                        <div class="teck-btn">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Reset Password') }}
                                            </button>
                                        </div>
                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
@endsection
