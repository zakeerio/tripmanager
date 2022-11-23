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
        // dd(Role::all());


        $user =      User::WHERE('id', 3)->get();

        //           dd($user[0]['id']);
        // $permission= Permission::create(['name'=>'view post']);

        $role = Role::Where('name', 'reader')->get();


        //     $t = $user->assignRole(['writer']);


        //     dd($t);

        //     $superAdmin = User::create([
        //         'name'=>'SuperAmdin',
        //         'email'=>'superadmin@gmail.com',
        //         'username'=>'super@gmail.com',
        //         'role_id'=>1,
        //         'password'=>bcrypt('12345'),
        //     ]);

        //     $role = Role::create(['name' => 'superadmin']);
        //     $permission = Permission::create(['name' => 'write-artical']);
        //     $permission->assignRole($role);

        //   $d=  $superAdmin->assignRole($role);

        $permission = Permission::all()->toArray();
        return view('pages/roles-permissions');
    }
}
