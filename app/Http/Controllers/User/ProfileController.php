<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;
use Hash;

class ProfileController extends Controller
{
    //constructor for checking Clientsay authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__Clientsay review page method___//
    public function review()
    {
        $check=DB::table('clientsays')->where('user_id',Auth::id())->first();
        if ($check) {
            return view('customer.review',compact('check'));
        }
        return view('customer.review');
    }

    //store Clientsay method__//
    public function storeClientsay(Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required',
            'message' => 'required',
        ]);
        $data=array();
        $data['user_id']=Auth::id();
        $data['rating']=$request->rating;
        $data['message']=$request->message;

        DB::table('clientsays')->insert($data);
        $notification = array('message' => 'Thanks For Review!','alert-type'=>'success' );
        return redirect()->route('home')->with($notification);
    }

    //update Clientsay method__//
    public function updateClientsay(Request $request)
    {
        $data=array();
        $data['user_id']=Auth::id();
        $data['rating']=$request->rating;
        $data['message']=$request->message;
        $data['status']=0;

        DB::table('clientsays')->where('id',$request->id)->update($data);
        $notification = array('message' => 'Update your review successfuli!','alert-type'=>'success' );
        return redirect()->route('home')->with($notification);
    }

    //__password change method___//
    public function passwordChange()
    {
        return view('customer.password');
    }

    //___password update method___//
    public function passwordUpdate(Request $request)
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
           return redirect()->to('/')->with($notification);
        }else{
            $notification=array('message' => 'old password not matched!', 'alert-type' => 'error'); 
            return redirect()->back()->with($notification);
        }
    }

    //logout method
    public function logout()
    {
        Auth::logout();
        $notification = array('message' => 'You are logged out!','alert-type'=>'warning' );
        return redirect()->route('login')->with($notification);
    }
}
