<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class ShippingController extends Controller
{
    //___Shipping Store Method____//
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_country' => 'required',
            'shipping_name' => 'required',
            'shipping_phone' => 'required',
            'shipping_address' => 'required',
            'shipping_email' => 'required',
            'shipping_city' => 'required',
        ]);
        if (Auth::check()) {
            $data=array();
            $data['user_id']=Auth::id();
            $data['shipping_country']=$request->shipping_country;
            $data['shipping_name']=$request->shipping_name;
            $data['shipping_phone']=$request->shipping_phone;
            $data['shipping_email']=$request->shipping_email;
            $data['shipping_city']=$request->shipping_city;
            $data['shipping_address']=$request->shipping_address;
            $data['shipping_zipcode']=$request->shipping_zipcode;

            DB::table('shippings')->insert($data);
            $notification = array('message' => 'successfuly inserted!','alert-type'=>'success' );
            return redirect()->back()->with($notification);
        }else{
            $notification = array('message' => 'Please login frist!','alert-type'=>'error' );
            return redirect()->back()->with($notification);
        }
    }
}
