<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use DataTables;

class ClientController extends Controller
{
    //constructor for checking admin authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    //index method
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=DB::table('clientsays')->leftjoin('users','clientsays.user_id','users.id')->select('clientsays.*','users.name')->where('clientsays.status',0)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status',function($row){
                    if ($row->status==0) {
                        return '<span class="badge badge-danger">Pending</span>';
                    }else{
                        return '<span class="badge badge-success">Approved</span>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('category.delete',[$row->id]).'" class="m-1" id="delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true); 
        }
       return view('admin.client.index');
    }
    //edit method
    public function edit($id)
    {
        $data=DB::table('clientsays')->leftjoin('users','clientsays.user_id','users.id')->select('clientsays.*','users.name')->where('clientsays.id',$id)->first();
        return view('admin.client.edit',compact('data'));
    }

    //update method 
    public function update(Request $request)
    {
        $data=array();
        $data['status']=$request->status;

        DB::table('clientsays')->where('id',$request->id)->update($data);
        return response()->json('successful updated!');
    }
}
