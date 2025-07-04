<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function update(Request $request){

        $user = Auth::user();        

        if($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('profile_picture','public');
            $user->profile_pic = $path;;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio; 

        if(filled($request->password)){
            $user->password = $request->password;
        }
        
        $res = $user->save();

        if($res){
            return back()->with('success', 'Profile updated successfully');
        } else {
            return back()->with('fail', 'Something went wrong, try again');
        }



    }
}
