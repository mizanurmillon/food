<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Admin\Reservation;
use DataTables;
use Auth;

class ReservationController extends Controller
{
   //constructor for checking admin authentication
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Index method
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $reservation="";
               $query=DB::table('reservations');
               if ($request->r_date) {
                   $query->where('r_date',$request->r_date);
               }
               if ($request->r_month) {
                   $query->where('r_month',$request->r_month);
               }
               if ($request->status) {
                   $query->where('status',$request->status);
               }
            $reservation=$query->latest()->get();
            return DataTables::of($reservation)
                ->addIndexColumn()
                ->editColumn('status', function($row){
                    if ($row->status=="Approved") {
                        return '<span class="badge badge-info">Approved</span>';
                    }elseif($row->status=="Success"){
                        return '<span class="badge badge-success">Success</span>';
                    }elseif($row->status=="Reject"){
                        return '<span class="badge badge-danger">Reject</span>';
                    }else{
                        return '<span class="badge badge-warning">Pending</span>';
                    }
                })
                ->addColumn('action', function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('reservation.delete',[$row->id]).'" class="m-1" id="reservation_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true); 
        }
       return view('admin.reservation.index');
    }
    //Pending Reservation method
    public function PendingReservation(Request $request)
    {
       if ($request->ajax()) {
            $reservation=DB::table('reservations')->where('status','Pending')->latest()->get();
            return DataTables::of($reservation)
                ->addIndexColumn()
                ->editColumn('status', function($row){
                    if ($row->status=="Approved") {
                        return '<span class="badge badge-info">Approved</span>';
                    }elseif($row->status=="Success"){
                        return '<span class="badge badge-success">Success</span>';
                    }elseif($row->status=="Reject"){
                        return '<span class="badge badge-danger">Reject</span>';
                    }else{
                        return '<span class="badge badge-warning">Pending</span>';
                    }
                })
                ->addColumn('action', function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa-regular fa-edit text-primary"></i></a>
                    <a href="'.route('reservation.delete',[$row->id]).'" class="m-1" id="reservation_delete"><i class="fa-solid fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true); 
        }
       return view('admin.reservation.pending');
    }

    //store method
    public function store(Request $request)
    {
        $check=DB::table('reservations')->where('r_date',$request->r_date)->where('phone',$request->phone)->first();
        if ($check) {
            return response()->json('This person already reserve this date.');
        }else{
            $data=array();
            $data['user_id']=Auth::id();
            $data['r_time']=$request->r_time;
            $data['r_date']=$request->r_date;
            $data['people']=$request->people;
            $data['phone']=$request->phone;
            $data['name']=$request->name;
            $data['details']=$request->details;
            $data['status']=$request->status;
            $data['r_month']=date('F', strtotime($request->r_date));
            $data['r_year']=date('Y', strtotime($request->r_date));
            DB::table('reservations')->insert($data);
            return response()->json('successful inserted!');
        }
    }
    //edit method 
    public function edit($id)
    {
        $data=DB::table('reservations')->where('id',$id)->first();
        return view('admin.reservation.edit',compact('data'));
    } 
    //Update method
    public function update(Request $request)
    {
        $data=array();
        $data['user_id']=Auth::id();
        $data['r_time']=$request->r_time;
        $data['r_date']=$request->r_date;
        $data['people']=$request->people;
        $data['phone']=$request->phone;
        $data['name']=$request->name;
        $data['details']=$request->details;
        $data['status']=$request->status;
        $data['r_month']=date('F', strtotime($request->r_date));
        $data['r_year']=date('Y', strtotime($request->r_date));
        DB::table('reservations')->where('id',$request->id)->update($data);
        return response()->json('successful updated!');
    }
    //delete method
    public function destroy($id)
    {
       DB::table('reservations')->where('id',$id)->delete();
       return response()->json('successful deleted!');
    }

}
