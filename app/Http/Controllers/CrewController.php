<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crew;
use App\Models\User;
use App\Http\Middleware\Authenticate;


class CrewController extends Controller
{
    //
    // __constructor(){

    // }

    public function index(){

        // $crew_members1 = Crew::where('duplicatevall', 0)->get();
        // foreach($crew_members1 as $member) {
        //     $row = array(
        //         "id" => $member->id,
        //         "name" => $member->fullname,
        //         "username" => $member->username,
        //         "email" => $member->emailaddress,
        //         "old_password" => $member->pswd,
        //         "role_id" => $member->privilege,
        //         "created_at" => date("Y-m-d H:i:s"),
        //         "updated_at" => date("Y-m-d H:i:s"),
        //     );

        //     $users = new User();

        //     $entry = $users->create($row);

        //     echo "<pre>"; print_r($row);
        //     echo "</pre>";

        // }

        $crew_members = Crew::limit(100)->get();
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

        $crew_member = User::findOrFail($user->id);


        return view('pages/my-account')->with("user", $crew_member);

    }

    public function update_crew(Request $request){

        dd($request->all());

        $name = $request->name; //"Zahid Ali"
        $id = $request->id; //"2"
        $emailaddress = $request->emailaddress; //"young-jean1@sky.com"
        $secondarynumber = $request->secondarynumber; //"03120330060"
        $boatpreference = $request->boatpreference; //"Seth Ellis"
        $memnumber = $request->memnumber; //"574"
        $firstaid = ($request->firstaid == "on") ? "Y" : ''; //"Y"
        $keyholder = $request->keyholder; //"S"
        $skipper = ($request->skipper == "on") ? "Y" : ''; //"Y"
        // echo $request->optin;
        $optin = ($request->optin == "on") ? "Y" : ''; //"Y"
        $privilege = $request->privilege; //"2"
        $traveltime = $request->traveltime; //"2021-03-17"


        $fullname = $request->fullname;
        $crewid = $request->crewid;
        $mobile = $request->mobile;
        $user_type = $request->user_type;

        // "password" => null
        // "confirmpassword" => null
        // "profileImage" => null



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
            "privilege" => $privilege,
        );

        ddd($crew_data);
        // $update = $crew->update($crew_data);

        if($update){
            echo  "Updated Successfully";
        }

        $password = $request('password');
        $profileImage = $request('profileImage');
        if($password != "")  {
            // updatde user password here
            echo "Update password as well";
        }


    }
}


// 125,135,254,46,89,142,179,228,234,235,245,247,252,26,196,180,159,193,144,117,108,104,
