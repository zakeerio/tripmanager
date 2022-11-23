<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crew;
use App\Models\User;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Session;

class CrewController extends Controller
{
    //
    // __constructor(){

    // }

    public function index()
    {
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

        $crew_members = Crew::with('user')->get();
        // dd($crew_members);
      //  $crew_members = Crew::whereId('30')->get()->toArray();
      //  dd($crew_members);

        return view('pages/crew-members')->with("crew_members", $crew_members)->with('pagetitle', $pagetitle);
    }
    public function edit($id)
    {
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
        $privilege = $request->privilege;
        $traveltime = $request->traveltime;
        $role_id = $request->role_id;


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
                'password' => 'required|confirmed'
            ]);

            dd($request->all());


            $user = User::create(request(['name', 'email', 'password']));

            // auth()->login($user);


            if ($user) {

                $crew_data = array(
                    "fullname" => $name,
                    "emailaddress" => $emailaddress,
                    "secondarynumber" => $secondarynumber,
                    "boatpreference" => $boatpreference,
                    "memnumber" => $memnumber,
                    "firstaid" => $firstaid,
                    "keyholder" => $keyholder,
                    "skipper" => $skipper,
                    "optin" => $optin,
                    "privilege" => $privilege
                );

                dd($crew_data);
                $update = $crew->create($crew_data);

                if ($update) {
                    $messages[] =  "User Data Updated Successfully";

                    $profileImage = $request->profileImage;

                    echo "TEST3";

                    dd($request->all());

                    // return redirect()->back()->with('success', $messages);

                }
            } else {
                echo "TEST1";
                dd($request->all());

                $messages[] =  "Something went wrong!";
                $profileImage = $request->profileImage;

                //return redirect()->back()->with('error', $messages);
            }
        }

        echo "TEST";

        dd($request->all());
    }


    public function UploadSingleImage($img, $path)

    {
        // return  $img;
        if (isset($img)) {
            $name  = uniqid() . $img->getClientOriginalName();
            $extension  = $img->getClientOriginalExtension();
            $arr = array('jpg', 'png', 'jpeg', 'TIFF');
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

    public function update_crew(Request $request)
    {

        //dd($request->all());


        try {


            $emailaddress = $request->emailaddress;
            $secondarynumber = $request->secondarynumber;
            $boatpreference = $request->boatpreference;
            $memnumber = $request->memnumber;
            $firstaid = ($request->firstaid == "on") ? "Y" : '';
            $keyholder = $request->keyholder;
            $skipper = ($request->skipper == "on") ? "Y" : '';
            $rya = ($request->rya == "on") ? "Y" : '';
            // echo $request->optin;
            $optin = ($request->optin == "on") ? "Y" : '';
            $privilege = $request->privilege;
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
            if (isset($password)) {
                if ($password != $confirmpassword) {
                    return redirect()->back()->withErrors(['msg' => 'Confirm Password Does Not Match']);
                }
                $password = Hash::make($password);
            } else {
                $user = Crew::WHERE('id', $crewid)->get()->toArray();
                $password = $user[0]['pswd'];
            }

            if ($request->has('profileImage')) {
                //path will be after choosing any directory inside public folder
                $path =  $this->UploadSingleImage($request->file('profileImage'), 'assets/profile-images');
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
                'profile' => $path,
                // "traveltime" => $traveltime,
                "privilege" => $privilege
            );

            // dd($crew_data);

            $update = Crew::WHERE('id', $crewid)->UPDATE($crew_data);

            if ($update) {
                $messages[] =  "User Data Updated Successfully";

                return redirect('/crew-members')->with(['status' => true, 'msg' => 'Success ! Member Updated']);
            } else {
                return redirect('/crew-members')->with(['status' => false, 'msg' => 'Error ! Member Update Failed']);
            }
        } catch (\Exception $e) {
            return redirect('/crew-members');
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

        $delete = Crew::whereId($id)->delete();

        if ($delete) {
            return redirect('/crew-members')->with(['status' => true, 'msg' => 'Success! Member Deleted']);
        } else {
            return redirect('/crew-members')->with(['status' => false, 'msg' => 'Error! Member Delete Failed']);
        }
    }
}


// 125,135,254,46,89,142,179,228,234,235,245,247,252,26,196,180,159,193,144,117,108,104,
