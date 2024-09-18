<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use Auth;
use DB;
use Session;

class CheckoutController extends Controller
{
    //__checkout Page method___//
    public function CheckoutCart($value='')
    {
        if(!Auth::check()){
            $notification=array('message' => 'Login Your Account!','alert-type' => 'error'); 
            return redirect()->back()->with($notification);
        }

        $content=Cart::content();
        return view('frontend.cart.checkout',compact('content'));
    }

    //___apply coupon method___//
    public function ApplyCoupon(Request $request)
    {
        $check=DB::table('coupons')->where('coupon_code',$request->coupon)->first();
        if ($check) {
          if (date('Y-m-d' , strtotime(date('d-m-Y'))) <= date('Y-m-d' , strtotime($check->valid_date))) {
            session::put('coupon', [
                'name'=>$check->coupon_code,
                'discount'=>$check->coupon_amount,
                'after_discount'=>Cart::subtotal()-$check->coupon_amount
            ]);
            $notification=array('message' => 'Coupon Applied!','alert-type' => 'success'); 
            return redirect()->back()->with($notification);
          }else{
            $notification=array('message' => 'Expire coupon code!','alert-type' => 'error'); 
            return redirect()->back()->with($notification);
          }
        }else{
            $notification=array('message' => 'Invalid coupon code! try again','alert-type' => 'error'); 
            return redirect()->back()->with($notification);
        }
    }

    //___coupon remove methode___//
    public function RemoveCoupon()
    {
        Session::forget('coupon');
        $notification=array('message' => 'Coupon Removed!','alert-type' => 'warning'); 
        return redirect()->back()->with($notification);
    }
}
