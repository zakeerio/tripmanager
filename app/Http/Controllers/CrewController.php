<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crew;
use App\Models\User;


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
}


// 125,135,254,46,89,142,179,228,234,235,245,247,252,26,196,180,159,193,144,117,108,104,
