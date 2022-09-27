<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crew;
use App\Models\User;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Hash;


class CrewController extends Controller
{
    //
    // __constructor(){

    // }

    public function index(){

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


        return view('pages/crew-members')->with("crew_members", $crew_members);

    }
    public function edit($id){
        // dd($id);
        $crew_member = Crew::findOrFail($id);
        // dd($crew_member);
        return view('pages/crew-members-edit')->with("crew_member", $crew_member);

    }

    public function myaccount(){

        $user = auth()->user();


        $crew_member = Crew::where('user_id',$user->id)->first();
        if(!$crew_member) {
            abort(403);
        }

        return view('pages/my-account')->with("user", $user)->with('crew_member', $crew_member);

    }

    public function update_crew(Request $request){

        // dd($request->all());

        $name = $request->name;
        $id = $request->id;
        $emailaddress = $request->emailaddress;
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


        $fullname = $request->fullname;
        $crewid = $request->crewid;
        $mobile = $request->mobile;
        $user_type = $request->user_type;

        $crew = Crew::findOrFail($id);

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

        // dd($crew_data);
        $update = $crew->update($crew_data);

        if($update){
            $messages[] =  "User Data Updated Successfully";
        }

        $password = $request->password;
        $old_password = $request->old_password;
        $password = $request->password;
        $confirmpassword = $request->confirmpassword;


        if($password != "" && $old_password != "" && ($password == $confirmpassword))  {


            #Match The Old Password
            if(!Hash::check($old_password, auth()->user()->password)){
                echo 'password not matched';
                // return back()->with("error", "Old Password Doesn't match!");
            }

            #Update the new Password
            $userupdate = User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($password),
            ]);
            if($userupdate){
                $messages[] =  "Password Updated";
            }

        }

        $profileImage = $request->profileImage;

        return redirect()->back()->with('success', $messages);






    }
}


// 125,135,254,46,89,142,179,228,234,235,245,247,252,26,196,180,159,193,144,117,108,104,
