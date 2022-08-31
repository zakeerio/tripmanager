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
                                  <h4>Login Form</h4>
                                          <p class="col-12-descrapction">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                  <div class="row">
                                      <div class="col-lg-12 col-md-12 upcoming_activities">

                                      </div>
                                  </div>
                             </div>


                              <div class="col-md-12">

                                {{-- <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Login') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
 --}}


                                  <form class="teck-form" method="POST" action="{{ route('login') }}">

                                    @csrf

                                    <div class="form-row">
                                      <div class="form-group col-xl-6 col-lg-12">
                                        <label for="user-name"> USER NAME</label>
                                        <input id="user-name" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                      </div>

                                      <div class="form-group col-xl-6 col-lg-12">
                                        <label for="ActivityItem">Email Address</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                      </div>

                                      <div class="form-group col-xl-12 col-lg-12">
                                          <label for="ActivityTime">PASSWORD</label>
                                          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                          <a href="{{ route('password.request') }}" class="ml-1 mt-2 d-inline-block">Forget Password</a>
                                      </div>

                                    </div>


                                      <div class="teck-btn">
                                          <button type="submit" class="btn btn-primary"> Login</button>
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
