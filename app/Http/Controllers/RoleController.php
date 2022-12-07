<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleController extends Controller
{
    //

    public function view_roles(Request $request)
    {
       
        return view('pages/roles-permissions');
    }

    public function add_role(Request $request){
       
        if(isset($request->add_role)){

           $added= Role::CREATE(['name'=>$request->add_role]);
           if(isset($added->id)){
                echo json_encode(['status'=>true,'msg'=>'Success ! Role Added']);
           }
        }
    }
}
