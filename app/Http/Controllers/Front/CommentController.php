<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Admin\Comment;


class CommentController extends Controller
{
    // //constructor for checking admin authentication
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    //__Comment method__//
    public function Comment(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required',
            'rating' => 'required',
        ]);
        if (Auth::check()) {
            $check=DB::table('comments')->where('user_id',Auth::id())->where('food_id',$request->food_id)->first();
            if ($check) {
               $notification=array('message' => 'Already you have a comments with this food !','alert-type' => 'error'); 
                return redirect()->back()->with($notification); 
            }else{
                $data=array();
                $data['user_id']=Auth::id();
                $data['food_id']=$request->food_id;
                $data['comment']=$request->comment;
                $data['rating']=$request->rating;
                $data['comment_date']=date('d-m-Y');
                $data['comment_month']=date('F');
                $data['comment_year']=date('Y');

                DB::table('comments')->insert($data);
                $notification=array('message' => 'Thank for your comments !','alert-type' => 'success'); 
                return redirect()->back()->with($notification);
            }
        }else{
            $notification=array('message' => 'You need to login your account!','alert-type' => 'warning'); 
            return redirect()->route('login')->with($notification);
        }
        
    }
}
