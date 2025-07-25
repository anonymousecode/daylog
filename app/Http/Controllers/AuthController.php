<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function register(Request $request){
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $result = $user->save();

        if($result){
            return redirect('/')->with('success', 'Registered successfully');
        } else {
            return back()->with('fail', 'Something went wrong, try again');
        }

    }

    function login(Request $request){

        $user = User::where('email',$request->email)->first();
        if($user && hash::check($request->password,$user->password)){

            Auth()->login($user); // Log in the user

            return redirect('dashboard')->with('success', 'Login successful');
        }else
        {
            return back()->with('fail', 'Invalid credentials, try again');
        }
    }

    function logout()
    {
        Auth::logout(); // Log out the user
        return redirect('/')->with('success', 'Logged out successfully');
    }
}
