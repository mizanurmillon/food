<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Admin\Comment;

class FrontendController extends Controller
{
    //welcome page show 
    public function index()
    {
        $category=DB::table('categories')->get();
        $subcategory=DB::table('subcategories')->get();
        $tops=DB::table('foods')
                    ->leftjoin('categories','foods.category_id','categories.id')
                    ->leftjoin('subcategories','foods.subcategory_id','subcategories.id')
                    ->select('foods.*','categories.category_name','subcategories.subcategory_name')
                    ->where('foods.top',1)->orderBy('foods.id','DESC')->limit(6)->get();
        $catwise_product=DB::table('foods')
                    ->leftjoin('categories','foods.category_id','categories.id')
                    ->leftjoin('subcategories','foods.subcategory_id','subcategories.id')
                    ->select('foods.*','categories.category_name','subcategories.subcategory_name')
                    ->where('foods.status',1)->orderBy('foods.id','DESC')->limit(8)->get();
        $slider=DB::table('foods')
                ->leftjoin('categories','foods.category_id','categories.id')
                ->leftjoin('subcategories','foods.subcategory_id','subcategories.id')
                ->select('foods.*','categories.category_name','subcategories.subcategory_name')
                ->where('foods.status',1)->where('foods.slider',1)->latest()->first();

        $clientsay=DB::table('clientsays')->leftjoin('users','clientsays.user_id','users.id')->select('clientsays.*','users.name')->where('clientsays.status',1)->limit(6)->get();

       return view('welcome',compact('category','subcategory','tops','catwise_product','clientsay','slider'));
    }

    //Food Details method
    public function FoodDetails($slug)
    {
        $s_food=DB::table('foods')
                ->leftjoin('categories','foods.category_id','categories.id')
                ->leftjoin('subcategories','foods.subcategory_id','subcategories.id')
                ->select('foods.*','categories.category_name','subcategories.subcategory_name')
                ->where('foods.slug',$slug)->first();
        $realeted_food=DB::table('foods')->where('subcategory_id',$s_food->subcategory_id)->orderBy('id','DESC')->take(10)->get();
        $comment=Comment::where('food_id',$s_food->id)->orderBy('id','DESC')->take(6)->get();
        return view('frontend.food_details',compact('s_food','realeted_food','comment'));
    }

    //storeReservation method
    public function storeReservation(Request $request)
    {
        if (Auth::check()) {
            $check=DB::table('reservations')->where('r_date',$request->r_date)->where('phone',$request->phone)->first();
            if ($check) {
                return response()->json(['errorMsg'=>'This person already reserve this date.']);
            }else{
                $data=array();
                $data['user_id']=Auth::id();
                $data['r_time']=$request->r_time;
                $data['r_date']=$request->r_date;
                $data['people']=$request->people;
                $data['phone']=$request->phone;
                $data['name']=$request->name;
                $data['details']=$request->details;
                $data['status']="Pending";
                $data['r_month']=date('F', strtotime($request->r_date));
                $data['r_year']=date('Y', strtotime($request->r_date));
                DB::table('reservations')->insert($data);
                return response()->json('successful reservation inserted!');
            }
        }else{
            return response()->json(['errorMsg'=>'You need to login your account']);
        }
    }

    //__QuickviewProduct Method___//
    public function QuickviewProduct($id)
    {
        $food=DB::table('foods')
                    ->leftjoin('categories','foods.category_id','categories.id')
                    ->leftjoin('subcategories','foods.subcategory_id','subcategories.id')
                    ->select('foods.*','categories.category_name','subcategories.subcategory_name')
                    ->where('foods.id',$id)->first();
        return view('frontend.quickview',compact('food'));
    }

    //__blog page method___//
    public function BlogPage()
    {
       $blog=DB::table('blogs')->orderBy('id','DESC')->get();
       return view('frontend.blog.blog',compact('blog'));
    }

    //__All Food Page___//
    public function AllFood()
    {
        $sub_category=DB::table('subcategories')->get();
        $all_food=DB::table('foods')
                    ->leftjoin('categories','foods.category_id','categories.id')
                    ->leftjoin('subcategories','foods.subcategory_id','subcategories.id')
                    ->select('foods.*','categories.category_name','subcategories.subcategory_name')
                    ->where('foods.status',1)->orderBy('foods.id','DESC')->get();
        return view('frontend.all_food',compact('all_food','sub_category'));
    }

    
}
