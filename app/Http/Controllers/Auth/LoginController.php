<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Over-riding default auth() username method - changing email to username so user can logged-in by username
    public function username()
    {
        return 'username';
    }

    // Over-riding default auth() login method for handling multi-auth for different types of users
    public function login(Request $request)
    {
        $authArray = ['username' => $request->username, 'password' => $request->password, 'status'=>1];
        if($request->has('user_type'))
        {

            // dd($request->all());

            if($request->user_type == 'administrator')
            {
                config(['auth.defaults.guard' => 'administrator']); // Updating default guard to administrator so auth prioritize the administrator table for auth_attempt()

            }
            elseif($request->user_type == 'crewmember')
            {
                config(['auth.defaults.guard' => 'crewmember']); // Updating default guard to employees so auth prioritize the employees table for auth_attempt()
            }
            elseif($request->user_type == 'developer')
            {
                config(['auth.defaults.guard' => 'developer']); // Updating default guard to clients so auth prioritize the clients table for auth_attempt()
            }
            else
            {
                $authArray = ['username' => $request->username, 'password' => $request->password];
                config(['auth.defaults.guard' => 'web']); // Updating default guard to users so auth prioritize the users table for auth_attempt()
            }
        }
        if (Auth::attempt($authArray))
        {
            // Updated this line
            // return $this->sendLoginResponse($request);

            // OR this one
            return $this->authenticated($request, auth()->user());
        }
        else
        {
            return $this->sendFailedLoginResponse($request, 'auth.failed_status');
        }

    }


    protected function authenticated(Request $request, $user)
    {
     return redirect('/'); // Redirects to home route after successful authentication for every user
    }



}
