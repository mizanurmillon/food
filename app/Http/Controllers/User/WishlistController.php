<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class WishlistController extends Controller
{
    //__Wishlist Add Method__//
    public function AddWishlist($id)
    {
        if (Auth::check()) {
            $check=DB::table('wishlists')->where('user_id',Auth::id())->where('product_id',$id)->first();
            if ($check) {
                return response()->json(['error'=>'Allready Exist!']);
            }else{
                $data=array();
                $data['user_id']=Auth::id();
                $data['product_id']=$id;
                DB::table('wishlists')->insert($data);
                return response()->json(['success'=>'Added on wishlist!']); 
            }
        }else{
            return response()->json(['error'=>'Please login frist!']);
        }
    }
}
