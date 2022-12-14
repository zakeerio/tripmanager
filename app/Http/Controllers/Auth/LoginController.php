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
use Carbon;

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

    protected $DateTime;
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
        $this->DateTime = Carbon\Carbon::now();
        $this->DateTime->toDateTimeString();
    }

    // Over-riding default auth() username method - changing email to username so user can logged-in by username
    public function username()
    {
        return 'username';
    }

    // Over-riding default auth() login method for handling multi-auth for different types of users
    public function login(Request $request)
    {

        $vals = $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]
        );


        $updatepassword = false;


        $authArray = ['username' => $request->username, 'password' => $request->password];


        if (Auth::attempt($authArray)) {

           // dd(Auth::user()->password);
            //$role = DB::table('roles')->where('user_name', $request->user_type)->pluck('name')->toArray();
            $user = DB::table('users')->where('username', $request->username)->get();

            $request->session()->put('user_id', $user[0]->id);
            $crew = DB::table('crews')->where('user_id', $user[0]->id)->get();
            $request->session()->put('initials', $crew[0]->initials);

            $name= (Auth::user() !== null) ? Auth::user()->name : 'NO NAME';
            $request->session()->put('name',$name);

            if (!empty($user)) {

                // dd($user[0]->id);
                if (isset($crew[0]->profile)) {
                    $request->session()->put('profile', $crew[0]->profile);
                } else {
                    $request->session()->put('profile', NULL);
                }
                // dd($crew[0]->initials);
                $login = DB::table('login_history')->INSERT(['user_id' =>  $user[0]->id, 'created_at' => $this->DateTime]);
                //dd($login);


                $role = DB::table('roles')->where('id', $user[0]->role_id)->get();
                if (!empty($role) && isset($role[0]->name)) {
                    // dd($role[0]->name);
                    $request->session()->put('role', $role[0]->name);

                    // dd($role);

                    if ($role[0]->name == 'admin') {
                        return redirect()->route('dashboard')->with('success', "Welcome to Admin Dashboard");
                    } else if ($role[0]->name == 'crewmember') {
                        return redirect()->route('dashboard')->with('success', "Welcome to Crew Member Dashboard");
                    } elseif ($role[0]->name == 'developer') {
                        return redirect()->route('dashboard')->with('success', "Welcome to Developer Dashboard");
                    } else {
                        return redirect()->back()->with('error', "No Role Assigned To This User");
                    }
                } else {
                    return redirect()->back()->with('error', "No Role Assigned To This User");
                }


                // $request->session()->put('role', $role[0]);
                // $request->session()->put('user_id', $user_id[0]);
            } else {
                return redirect()->back()->with('error', "No User Found");
            }
        } else {
            return redirect()->back()->with('error', "No User Found");
        }

        // dd($request->session()->get('role'));
        // exit;
        // if ($request->has('user_type')) {

        //     // $request->session()->put('user_type', $request->user_type);
        //     $role = DB::table('roles')->where('id', $request->user_type)->pluck('name')->toArray();
        //     $user_id = DB::table('users')->where('username', $request->username)->pluck('id')->toArray();


        //     if (!empty($role) && !empty($user_id) && isset($role[0])) {

        //         $request->session()->put('role', $role[0]);
        //         $request->session()->put('user_id', $user_id[0]);
        //         $crew = DB::table('crews')->where('user_id', $user_id[0])->get()->toArray();
        //         $request->session()->put('initials', $crew[0]->initials);

        //         if (isset($crew[0]->profile)) {
        //             $request->session()->put('profile', $crew[0]->profile);
        //         } else {
        //             $request->session()->put('profile', NULL);
        //         }
        //         // dd($crew[0]->initials);
        //         $login = DB::table('login_history')->INSERT(['user_id' => $user_id[0], 'created_at' => $this->DateTime]);
        //         //dd($login);


        //         $user = DB::table('users')->where('username', $request->username)->where('old_password', md5($request->password))->whereNotNull('old_password')->where('role_id', $request->user_type)->where('password', '!=', $request->password)->first();

        //         if ($user) {
        //             $updatepassword = true;
        //             $authArray['password'] = '12345678';
        //         }

        //         $login = DB::table('login_history')->INSERT(['user_id' => $user_id[0]]);


        //         if ($role[0] == 'admin') {
        //             // config(['auth.defaults.guard' => 'admin']); // Updating default guard to administrator so auth prioritize the administrator table for auth_attempt()
        //             if (Auth::attempt($authArray)) {

        //                 if ($updatepassword == true) {

        //                     $request->session()->put('passwordtobeupdated', 'Yes');
        //                     $request->session()->put('newpassword', $request->password);
        //                 }

        //                 return redirect()->route('dashboard')->with('success', "Welcome to Admin Dashboard");
        //             } else {
        //                 return redirect()->back()->with('error', "Login Failed");
        //             }
        //         } elseif ($role[0] == 'crewmember') {

        //             // config(['auth.defaults.guard' => 'admin']); // Updating default guard to administrator so auth prioritize the administrator table for auth_attempt()
        //             if (Auth::attempt($authArray)) {
        //                 if ($updatepassword == true) {

        //                     $request->session()->put('passwordtobeupdated', 'true');
        //                     $request->session()->put('newpassword', $request->password);
        //                 }


        //                 return redirect()->route('dashboard')->with('success', "Welcome to Crew Member Dashboard");
        //             } else {

        //                 return redirect()->back()->with('error', "Login Failed");
        //             }



        //             // config(['auth.defaults.guard' => 'web']); // Updating default guard to employees so auth prioritize the employees table for auth_attempt()
        //         } elseif ($role[0] == 'developer') {
        //             if (Auth::attempt($authArray)) {

        //                 if ($updatepassword == true) {

        //                     $request->session()->put('passwordtobeupdated', 'Yes');
        //                     $request->session()->put('newpassword', $request->password);
        //                 }

        //                 return redirect()->route('dashboard')->with('success', "Welcome to Developer Dashboard");
        //             } else {
        //                 return redirect()->back()->with('error', "Login Failed");
        //             }

        //             // dd("Guard here");
        //             // config(['auth.defaults.guard' => 'developer']); // Updating default guard to clients so auth prioritize the clients table for auth_attempt()

        //             // if(Auth::guard('developer')->attempt($authArray)){
        //             //     // dd("guard successfully");
        //             //     // return redirect()->route('developer.dashboard')->with('success', "Welcome to Dashboard");

        //             //     // return redirect('');
        //             //     return redirect()->intended('/developer/dashboard');



        //             //     // return redirect()->route('developer.dashboard')->with('success','Success here');

        //             // } else {
        //             //     return redirect()->back()->with('error', "Login Failed");
        //             // }

        //             // dd($authArray); exit;
        //         } else {
        //             $authArray = ['username' => $request->username, 'password' => $request->password];
        //             config(['auth.defaults.guard' => 'web']); // Updating default guard to users so auth prioritize the users table for auth_attempt()
        //         }
        //     }
        //     if (Auth::attempt($authArray)) {
        //         // Updated this line
        //         // return $this->sendLoginResponse($request);


        //         // OR this one
        //         return $this->authenticated($request, auth()->user());
        //     } else {
        //         dd($updatepassword);

        //         return $this->sendFailedLoginResponse($request, 'auth.failed_status');
        //     }
        // } else {
        //     return redirect()->back()->with('error', "This User Has No Role Assigned Yet");
        // }



    }
    protected function authenticated(Request $request, $user)
    {
        return redirect('dashboard'); // Redirects to home route after successful authentication for every user
    }
}
