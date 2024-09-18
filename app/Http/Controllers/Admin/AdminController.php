<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;

class AdminController extends Controller
{
    //constructor for checking admin authentication
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Admin After login
    public function admin()
    {
        return view('admin.home');
    }
    //Admin Logout----
    public function Logout()
    {
        Auth::logout();
        $notification = array('message' => 'You are logged out!','alert-type'=>'warning' );
        return redirect()->route('admin.login')->with($notification);
    }
    //Admin Password Change----
    public function PasswordChange()
    {
        return view('admin.profile.password_change');
    }
    //Admin password Update---
    public function Update(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        $current_password=Auth::user()->password;
        $oldpassword=$request->old_password;
        $password=$request->password;
        if (Hash::check($oldpassword, $current_password)) {
            $user=User::findorfail(Auth::id());
            $user->password=Hash::make($request->password);
            $user->save();
            Auth::logout();
            $notification=array('message' => 'Your Password Changed!', 'alert-type' => 'success');
           return redirect()->route('admin.login')->with($notification);
        }else{
            $notification=array('message' => 'old password not matched!', 'alert-type' => 'error'); 
             return redirect()->back()->with($notification);
        }
    }
}
