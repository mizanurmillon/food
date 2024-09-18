<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Models\Admin\Food;
use DB;
use Session;

class CartController extends Controller
{
    //__add to cart Qv method__//
    public function AddToCart(Request $request)
    {
       $food=DB::table('foods')->where('id',$request->id)->first();
        Cart::add([
            'id'=>$request->id,
            'name'=>$food->food_name,
            'qty'=>$request->quantity,
            'price'=>$request->price,
            'weight'=>'1',
            'options'=>['image'=>$food->image]
        ]);
        return response()->json('food added on cart!');
    }

    //__Add to Singel food cart__//
    public function Cart(Request $request)
    {
        $food=DB::table('foods')->where('id',$request->id)->first();
        Cart::add([
            'id'=>$request->id,
            'name'=>$food->food_name,
            'qty'=>$request->quantity,
            'price'=>$request->price,
            'weight'=>'1',
            'options'=>['image'=>$food->image]
        ]);
        return response()->json('food added on cart!');
    }

    //__cart Add___/
    public function AddCart($id)
    {
        $food=DB::table('foods')->where('id',$id)->first();
        Cart::add([
            'id'=>$food->id,
            'name'=>$food->food_name,
            'qty'=>1,
            'price'=>$food->price,
            'weight'=>'1',
            'options'=>['image'=>$food->image]
        ]);
        return response()->json('food added on cart!');
    }

    //__All Cart___//
    public function AllCart()
    {
        $data=array();
        $data['cart_qty']=Cart::count();
        $data['cart_total']=Cart::total();
        return response()->json($data);
    }

    //__Remove Cart method__//
    public function RemoveCart($rowId)
    {
        Cart::remove($rowId);
        return response()->json('cart remove!');
    }  

    //__My Cart Method__//
    public function Mycart()
    {
        $content=Cart::content();
        return view('frontend.cart.index',compact('content'));
    }

    //__cart qty update method__//
    public function updatecart($rowId , $qty)
    {
        Cart::update($rowId,['qty'=>$qty]);
        return response()->json('successful updated!');
    }

    //___Delete cart method___//
    public function destroy()
    {
        Cart::destroy();
        $notification=array('message' => 'Cart itmes clear!','alert-type' => 'error'); 
        return redirect()->to('/')->with($notification);
    }

}
