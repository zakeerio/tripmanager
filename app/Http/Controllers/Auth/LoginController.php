<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
// use App\Models\Developer;
use DB;
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
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = 'dashboard';


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
        $vals = $request->validate([
                'username' => 'required',
                'password' => 'required',
                'user_type' => "required",
            ]
        );

        $updatepassword = false;

        $authArray = ['username' => $request->username, 'password' => $request->password, 'role_id' => $request->user_type];
        if($request->has('user_type'))
        {

            $user = DB::table('users')->where('username', $request->username)->where('old_password', md5($request->password))->whereNotNull('old_password')->where('role_id', $request->user_type)->where('password','!=', $request->password )->first();

            if($user){
                $updatepassword = true;
                $authArray['password'] = '12345678';
            }


            if($request->user_type == 1)
            {
                // config(['auth.defaults.guard' => 'admin']); // Updating default guard to administrator so auth prioritize the administrator table for auth_attempt()
                if(Auth::attempt($authArray)){

                    if($updatepassword == true){

                        $request->session()->put('passwordtobeupdated', 'Yes');
                        $request->session()->put('newpassword', $request->password);

                    }

                    return redirect()->route('dashboard')->with('success', "Welcome to Admin Dashboard");
                } else {
                    return redirect()->back()->with('error', "Login Failed");
                }

            }
            elseif($request->user_type == 2)
            {

                // config(['auth.defaults.guard' => 'admin']); // Updating default guard to administrator so auth prioritize the administrator table for auth_attempt()
                if(Auth::attempt($authArray)){
                    if($updatepassword == true){

                        $request->session()->put('passwordtobeupdated', 'true');
                        $request->session()->put('newpassword', $request->password);

                    }

                    return redirect()->route('dashboard')->with('success', "Welcome to Admin Dashboard");
                } else {

                    return redirect()->back()->with('error', "Login Failed");
                }



                // config(['auth.defaults.guard' => 'web']); // Updating default guard to employees so auth prioritize the employees table for auth_attempt()
            }
            elseif($request->user_type == 3)
            {
                // dd("Guard here");
                // config(['auth.defaults.guard' => 'developer']); // Updating default guard to clients so auth prioritize the clients table for auth_attempt()

                // if(Auth::guard('developer')->attempt($authArray)){
                //     // dd("guard successfully");
                //     // return redirect()->route('developer.dashboard')->with('success', "Welcome to Dashboard");

                //     // return redirect('');
                //     return redirect()->intended('/developer/dashboard');



                //     // return redirect()->route('developer.dashboard')->with('success','Success here');

                // } else {
                //     return redirect()->back()->with('error', "Login Failed");
                // }

                // dd($authArray); exit;
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
            return $this->authenticated($request, au\th()->user());
        }
        else
        {
            dd($updatepassword);

            return $this->sendFailedLoginResponse($request, 'auth.failed_status');
        }

    }


    protected function authenticated(Request $request, $user)
    {
     return redirect('dashboard'); // Redirects to home route after successful authentication for every user
    }


}
