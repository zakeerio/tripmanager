<?php
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// UPDATE old password into new laravel password

function updateuseroldpasswordtonew(request $request){
    $pwdval = $request->session()->get('passwordtobeupdated');
    $passwordtobeupdated = ( isset($pwdval) && $request->session()->get('passwordtobeupdated') == 'Yes' ) ?  : 'No';

    $new_password = $request->session()->get('newpassword');

    if($passwordtobeupdated == 'Yes' && $new_password !="expired"){

        $checkuser = User::where('id',auth()->user()->id)->whereNotNull('old_password')->first();
        if($checkuser) {

            #Match The Old Password
            if(!Hash::check('12345678', auth()->user()->password)){
                echo 'password not matched';
                // return back()->with("error", "Old Password Doesn't match!");
            }

            #Update the new Password
            $userupdate = User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($new_password),
                'old_password' => null
            ]);

            $request->session()->put('newpassword', 'expired');
            $request->session()->put('passwordtobeupdated', 'No');

        }
    }
}
?>
