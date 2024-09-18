<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class CouponController extends Controller
{
    //constructor for checking admin authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    //___index method__//
    public function index(Request $request)
    {
       if ($request->ajax()) {
           $data=DB::table('coupons')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status',function($row){
                    if ($row->status=="Active") {
                        return '<span class="badge badge-success">Active</span>';
                    }else{
                        return '<span class="badge badge-danger">Inactive</span>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('coupon.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true); 
        }
       return view('admin.coupon.index');
    }

    //__coupon store method__//
    public function store(Request $request)
    {
        $validated = $request->validate([
            'coupon_code' => 'required',
            'coupon_amount' => 'required',
            'valid_date' => 'required',
        ]);

        $data=array();
        $data['coupon_code']=$request->coupon_code;
        $data['coupon_amount']=$request->coupon_amount;
        $data['valid_date']=$request->valid_date;
        $data['type']=$request->type;
        $data['status']=$request->status;

        DB::table('coupons')->insert($data);
        return response()->json('successfully inserted coupon!');
    }

    //__coupon edit method__//
    public function edit($id)
    {
        $data=DB::table('coupons')->where('id',$id)->first();
        return view('admin.coupon.edit',compact('data'));
    }

    //__coupon update method__//
    public function update(Request $request)
    {
        $data=array();
        $data['coupon_code']=$request->coupon_code;
        $data['coupon_amount']=$request->coupon_amount;
        $data['valid_date']=$request->valid_date;
        $data['type']=$request->type;
        $data['status']=$request->status;

        DB::table('coupons')->where('id',$request->id)->update($data);
        return response()->json('successfully updated coupon!');
    }


    //___coupon delete method___//
    public function destroy($id)
    {
       DB::table('coupons')->where('id',$id)->delete();
       return response()->json('successfully deleted coupon!');
    }
}
