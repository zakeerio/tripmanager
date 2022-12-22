<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crew;
use App\Models\User;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Session;
use Auth;

class CrewController extends Controller
{
    //
    // __constructor(){

    // }
    public function Access()
    {
        if (Session::get('role') == 'crewmember') {
            return true;
        }
    }

    public function index()
    {
        if ($this->Access()) {

            return redirect('/dashboard')->with(['status' => false, 'msg' => 'Access Denied !']);
        }

        $pagetitle = "Crew Members";

        /*
        $users = User::where('role_id', 2)->get();

        foreach($users as $user){


            $crew_members1 = Crew::where('emailaddress', $user->email)->where('username', $user->username)->get();

            // dd($crew_members1);

            foreach($crew_members1 as $member) {

                // print_r($member);
                // $row = array(
                //     "id" => $member->id,
                //     "name" => $member->fullname,
                //     "username" => $member->username,
                //     "email" => $member->emailaddress,
                //     "old_password" => $member->pswd,
                //     "role_id" => $member->privilege,
                //     "created_at" => date("Y-m-d H:i:s"),
                //     "updated_at" => date("Y-m-d H:i:s"),
                // );

                $entry = $member->update(['user_id' => $user->id]);
                if($entry){

                    // $entry = $users->update($row);

                    echo "<pre>"; print_r($member);
                    echo "</pre>";

                }



            }
        }

        */

        $crew_members = Crew::with('user')->paginate(250);
        // dd($crew_members);
        //  $crew_members = Crew::whereId('30')->get()->toArray();
        //  dd($crew_members);

        return view('pages/crew-members')->with("crew_members", $crew_members)->with('pagetitle', $pagetitle);
    }


    public function edit($id)
    {

        if ($this->Access()) {

            return redirect('/dashboard')->with(['status' => false, 'msg' => 'Access Denied !']);
        }

        $pagetitle = "Edit Crew member";
        // dd($id);
        $crew_member = Crew::findOrFail($id);
        // dd($crew_member);
        return view('pages/crew-members-edit')->with("crew_member", $crew_member)->with('pagetitle', $pagetitle);
    }

    public function myaccount()
    {
        $pagetitle = "My Account";

        $user = auth()->user();

        $crew_member = Crew::where('user_id', $user->id)->first();
        if (!$crew_member) {
            abort(403);
        }

        // dd($crew_member);
        return view('pages/my-account')->with("user", $user)->with('crew_member', $crew_member)->with('pagetitle', $pagetitle);
    }




    public function save_crew(Request $request)
    {

        // dd($request->all());

        $name = $request->name;
        $emailaddress = $request->email;
        $secondarynumber = $request->secondarynumber;
        $boatpreference = $request->boatpreference;
        $memnumber = $request->memnumber;
        $firstaid = ($request->firstaid == "on") ? "Y" : '';
        $keyholder = $request->keyholder;
        $skipper = ($request->skipper == "on") ? "Y" : '';
        // echo $request->optin;
        $optin = ($request->optin == "on") ? "Y" : '';
        $iwa = ($request->iwa == "on") ? "Y" : '';
        $rya = ($request->rya == "on") ? "Y" : '';
        $cba = ($request->cba == "on") ? "Y" : '';

        // $privilege = $request->privilege;
        $traveltime = $request->traveltime;
        $role_id = $request->role_id;
        $initials = $request->initials;

        $fullname = $request->fullname;
        $mobile = $request->mobile;
        $user_type = $request->user_type;

        $password = $request->password;
        $confirmpassword = $request->confirmpassword;


        if ($password != "" && ($password == $confirmpassword)) {

            $this->validate(request(), [
                'name' => 'required',
                'email' => 'required|email',
                'username' => 'required',
                'role_id' => 'required',
                'password' => 'required',
                'initials' => 'required',
            ]);

            // dd($request->all());

            $password = Hash::make($password);

            $userdata = [
                'role_id' => $request->role_id,
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password
            ];



            $user = User::create($userdata)->id;

            // $userdat = auth()->login($user);
            // dd($user);

            if ($user) {

                $crew_data = array(
                    "fullname" => $name,
                    'initials' => $initials,
                    'username' => $request->username,
                    "emailaddress" => $emailaddress,
                    "secondarynumber" => $secondarynumber,
                    "boatpreference" => $boatpreference,
                    "memnumber" => $memnumber,
                    "firstaid" => $firstaid,
                    "keyholder" => $keyholder,
                    "mobile" => $mobile,
                    "skipper" => $skipper,
                    "optin" => $optin,
                    'iwa' => $iwa,
                    'rya' => $rya,
                    'cba' => $cba,
                    'user_id' => $user,
                    'suspended' => 0,
                    'role_id' => $role_id,
                    'traveltime' => $traveltime
                );

                // print_r($crew_data);
                $crewupdate = Crew::create($crew_data)->id;

                if ($crewupdate) {
                    $messages[] =  "User Data Updated Successfully";

                    $profileImage = $request->profileImage;

                    if ($request->has('profileImage')) {
                        //path will be after choosing any directory inside public folder
                        $path =  $this->UploadSingleImage($request->file('profileImage'), 'assets/profile-images');

                        if ($path == 'File Extension Error' || $path == 'Image Found Empty') {
                            return redirect()->back()->withErrors(['image' => 'Please Select a Suitable Image']);
                        } else {
                            $crewuser = Crew::WHERE('id', $crewupdate)->get()->toArray();
                            if (!empty($crewuser) && isset($path)) {
                                $image = $crewuser[0]['profile'];
                                $profileimg = ['profile' => $path];

                                $update = Crew::WHERE('id', $crewupdate)->UPDATE($profileimg);
                                if ($update) {
                                    $messages[] =  "User profile photo Updated Successfully";

                                }

                                // print_r($messages);

                                //  dd($update);
                            }
                        }
                    }


                    // echo "TEST3";

                    // dd($request->all());

                    return redirect()->back()->with(['success', $messages, 'status' => true, 'msg' => 'Success ! User Created']);

                }
            } else {
                // echo "TEST1";
                // dd($request->all());

                $messages[] =  "Something went wrong!";

                return redirect()->back()->with('error', $messages);
            }
        }

        // echo "TEST";

        // dd($request->all());
    }


    public function UploadSingleImage($img, $path)
    {
        // return  $img;
        if (isset($img)) {
            $name  = uniqid() . $img->getClientOriginalName();
            $extension  = $img->getClientOriginalExtension();
            $arr = array('jpg', 'png', 'jpeg', 'PNG', 'JPEG', 'JPG', 'TIFF');
            if (in_array($extension, $arr)) {

                $save_path       = public_path($path);
                $url = $img->move($save_path, $name);
                return $name;
            } else {
                return 'File Extension Error';
            }
        } else {
            return 'Image Found Empty';
        }
    }

    // '/assets/profile-images/'
    public function RemoveFile($file_name, $path)
    {
        try {
            if (file_exists(public_path() . $path . '/' . $file_name)) {
                $res = unlink(public_path() . $path . '/' . $file_name);
                return $res;
            } else {
                return '404';
            }
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    public function update_crew(Request $request)
    {

        // dd($request->all());


        try {

            $emailaddress = $request->emailaddress;
            $secondarynumber = $request->secondarynumber;
            $boatpreference = $request->boatpreference;
            $memnumber = $request->memnumber;

            $firstaid = ($request->firstaid == "on") ? "Y" : '';
            $skipper = ($request->skipper == "on") ? "Y" : '';
            $rya = ($request->rya == "on") ? "Y" : '';
            // echo $request->optin;
            $optin = ($request->optin == "on") ? "Y" : '';
            $cba = ($request->cba == "on") ? "Y" : '';
            $iwa = ($request->iwa == "on") ? "Y" : '';

            //  dd($request->rya == "on");
            // $privilege = $request->privilege;
            $keyholder = $request->keyholder;
            $traveltime = $request->traveltime;

            $fullname = $request->fullname;
            $crewid = $request->crewid;
            $mobile = $request->mobile;
            $user_type = $request->user_type;
            //$crew = Crew::findOrFail($id);
            $password = $request->password;
            // $old_password = $request->old_password;
            // $password = $request->password;
            $confirmpassword = $request->confirmpassword;

         // dd($request->all());

            if (isset($password)) {
                if ($password != $confirmpassword) {
                    return redirect()->back()->withErrors(['msg' => 'Confirm Password Does Not Match']);
                }
                $password = Hash::make($password);

                $crew = Crew::WHERE('id', $crewid)->get();

                if (!empty($crew) && isset($crew[0]->user_id)) {

                    $update_pass_user_table = User::whereId($crew[0]->user_id)->Update(['password' => $password]);
                    $update_pass_crew_table = Crew::where('user_id', $crew[0]->user_id)->Update(['pswd' => $password]);
                    //dd('t');
                } else {
                    return redirect()->back()->withErrors(['msg' => 'Access Denied']);
                }
            } else {
                $crew = Crew::WHERE('id', $crewid)->get()->toArray();
                if (!empty($crew) && isset($crew[0]['pswd'])) {
                    $password = $crew[0]['pswd'];
                } else {
                    $password = Hash::make($request->password);
                }
            }


            if ($request->has('profileImage')) {
                //path will be after choosing any directory inside public folder
                $path =  $this->UploadSingleImage($request->file('profileImage'), 'assets/profile-images');

                if ($path == 'File Extension Error' || $path == 'Image Found Empty') {
                    return redirect()->back()->withErrors(['image' => 'Please Select a Suitable Image']);
                } else {
                    $user = Crew::WHERE('id', $crewid)->get()->toArray();
                    if (!empty($user) && isset($path)) {
                        $image = $user[0]['profile'];
                        $result = $this->RemoveFile($image, '/assets/profile-images/');

                        //  dd($result);
                    }
                }
            } else {
                $user = Crew::WHERE('id', $crewid)->get()->toArray();
                $path = $user[0]['profile'];
            }




            $crew_data = array(
                "fullname" => $fullname,
                'mobile' => $mobile,
                'pswd' => $password,
                "emailaddress" => $emailaddress,
                "secondarynumber" => $secondarynumber,
                "boatpreference" => $boatpreference,
                "memnumber" => $memnumber,
                "firstaid" => $firstaid,
                "keyholder" => $keyholder,
                "skipper" => $skipper,
                "optin" => $optin,
                "rya" => $rya,
                "cba" => $cba,
                "iwa" => $iwa,
                'profile' => $path,
                // "traveltime" => $traveltime,
                "faexpire" => $request->faexpiry
            );

            // dd($crew_data);

            $update = Crew::WHERE('id', $crewid)->UPDATE($crew_data);

           //dd($update);

            if ($update) {
                $messages[] =  "User Data Updated Successfully";
                return redirect('/crew-members')->with(['status' => true, 'msg' => 'Success ! Member Updated']);
            } else {
                return redirect('/crew-members')->with(['status' => false, 'msg' => 'Error ! Member Update Failed']);
            }
        } catch (\Exception $e) {

             //dd($e->getMessage());

            return redirect('/crew-members')->with(['status' => false, 'msg' => $e->getMessage()]);
        }


        // $password = $request->password;
        // $old_password = $request->old_password;
        // $password = $request->password;
        // $confirmpassword = $request->confirmpassword;


        // if ($password != "" && $old_password != "" && ($password == $confirmpassword)) {


        //     #Match The Old Password
        //     if (!Hash::check($old_password, auth()->user()->password)) {
        //         echo 'password not matched';
        //         // return back()->with("error", "Old Password Doesn't match!");
        //     }

        //     #Update the new Password
        //     $userupdate = User::whereId(auth()->user()->id)->update([
        //         'password' => Hash::make($password),
        //     ]);
        //     if ($userupdate) {
        //         $messages[] =  "Password Updated";
        //     }
        // }



        //$profileImage = $request->profileImage;


        //return redirect()->back()->with('success', $messages);
        // return view('pages/my-account')->with("user", $user)->with('crew_member', $crew_member)->with('pagetitle', $pagetitle);

    }

    public function delete_crew($id)
    {

        if ($this->Access()) {

            return redirect('/dashboard')->with(['status' => false, 'msg' => 'Access Denied !']);
        }

        $delete = Crew::whereId($id)->delete();

        if ($delete) {
            return redirect('/crew-members')->with(['status' => true, 'msg' => 'Success! Member Deleted']);
        } else {
            return redirect('/crew-members')->with(['status' => false, 'msg' => 'Error! Member Delete Failed']);
        }
    }


    public function update_my_account(Request $request)
    {
        try {

            //  dd($request->all());

            $emailaddress = $request->emailaddress;
            $secondarynumber = $request->secondarynumber;
            $username = $request->username;
            $boatpreference = $request->boatpreference;
            $memnumber = $request->memnumber;
            $primary_no = $request->primary_no;
            $faexpire = $request->faexpire;
            // dd($request->faexpire);

            $firstaid = ($request->firstaid == "on") ? "Y" : '';
            $keyholder = $request->keyholder;
            $skipper = ($request->skipper == "on") ? "Y" : '';

            // dd($skipper);
            $rya = ($request->rya == "on") ? "Y" : '';
            $cba = ($request->cba == "on") ? "Y" : '';
            $iwa = ($request->iwa == "on") ? "Y" : '';
            $optin = ($request->optin == "on") ? "Y" : '';

            // $privilege = $request->privilege;
            $keyholder = $request->keyholder;
            $traveltime = $request->traveltime;
            $fullname = $request->name;

            // dd($fullname);
            $crewid = $request->id;
            //$mobile = $request->mobile;
            // $user_type = $request->user_type;
            //$crew = Crew::findOrFail($id);
            $password = $request->password;
            $old_password = $request->old_password;
            // $password = $request->password;
            $confirmpassword = $request->confirmpassword;

            $user_id = Auth::user()->id;


            if (isset($password)) {
                if ($password != $confirmpassword) {
                    return redirect()->back()->withErrors(['msg' => 'Confirm Password Does Not Match']);
                }

                if (isset($old_password)) {


                    $user = User::WHERE('id', $crewid)->get();

                    if (!empty($user)) {

                        if (Hash::check($old_password, Auth::user()->password)) {
                            $updated_password = Hash::make($password);
                            $up = User::whereId(Auth::user()->id)->update(['password' => $updated_password]);
                        } else {

                            return redirect()->back()->withErrors(['msg' => 'Old Password Does not Match']);
                        }
                    }
                } else {

                    return redirect()->back()->withErrors(['msg' => 'Enter Old password']);
                }
            } else {
                $user = Crew::WHERE('id', $crewid)->get()->toArray();
                $updated_password = $user[0]['pswd'];
            }
            // dd($password);
            if ($request->has('profileImage')) {
                //path will be after choosing any directory inside public folder
                $path =  $this->UploadSingleImage($request->file('profileImage'), 'assets/profile-images');
                if ($path == 'File Extension Error' || $path == 'Image Found Empty') {

                    return redirect()->back()->withErrors(['image' => 'Please Select a Suitable Image']);
                } else {
                    $user = Crew::WHERE('id', $crewid)->get()->toArray();
                    if (!empty($user) && isset($path)) {
                        $image = $user[0]['profile'];
                        $result = $this->RemoveFile($image, '/assets/profile-images/');

                        //  dd($result);
                    }
                }
            } else {
                $user = Crew::WHERE('id', $crewid)->get()->toArray();
                $path = $user[0]['profile'];
            }


            $crew_data = array(
                "fullname" => $fullname,
                'username' => $username,
                'pswd' => $updated_password,
                "emailaddress" => $emailaddress,
                "mobile" => $primary_no,
                "secondarynumber" => $secondarynumber,
                "boatpreference" => $boatpreference,
                "memnumber" => $memnumber,
                "firstaid" => $firstaid,
                "keyholder" => $keyholder,
                "skipper" => $skipper,
                "optin" => $optin,
                "cba" => $cba,
                "rya" => $rya,
                "iwa" => $iwa,
                'profile' => $path,
                // "traveltime" => $traveltime,
                'faexpire' => $faexpire,
            );

            // dd($crew_data);

            //dd( Auth::user()->id);
            $update = Crew::WHERE('id', $crewid)->UPDATE($crew_data);

            $user = Crew::WHERE('id', $crewid)->get();

            $update_name = User::whereId(Auth::user()->id)->update(['name' => $fullname]);

            if (!empty($user) || isset($user[0]->profile)) {
                $path = $user[0]->profile;
                $request->session()->put('profile', $path);
                $request->session()->put('name', $user[0]->fullname);
            }



            //dd($update_name);
            if ($update || $update_name) {
                $messages[] =  "User Data Updated Successfully";
                return redirect('/my-account')->with(['status' => true, 'msg' => 'Success ! Account Updated']);
            } else {
                return redirect('/my-account')->with(['status' => false, 'msg' => 'Error ! Account Update Failed 22']);
            }
        } catch (\Exception $e) {

            return redirect('/my-account')->with(['status' => false, 'msg' => 'Error ! Account Update Failed 11']);
            // dd($e->getMessage());

            //return redirect('/my-account');
        }
    }
}
