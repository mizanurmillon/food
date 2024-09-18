<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
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
            $data=DB::table('users')->where('type','customer')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status',function($row){
                    if ($row->status==1) {
                        return '<span class="badge badge-success">Active</span>';
                    }else{
                        return '<span class="badge badge-danger">Deactive</span>';
                    }
                })
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>';
                    if ($row->status==1) {
                       $actionBtn.='<a href="'.route('customer.delete',[$row->id]).'" class="m-1" id="customer_delete"><i class="fa fa-trash text-danger"></i></a>
                        ';
                    }else{
                        $actionBtn.='<a href="javascript:void(0)" class="m-1 active" data-id="'.$row->id.'"><i class="fa fa-thumbs-up text-success"></i></a>
                        ';
                    }
                    

                    return $actionBtn;
                })
                ->rawColumns(['action','status'])
                ->make(true); 
        }
       return view('admin.customer.index');
    }
    //store method
    public function store(Request $request)
    {
         $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
        ]);
        $data=array(
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
        );
        DB::table('users')->insert($data);
        return response()->json('successful inserted!');
    }
    //edit method
    public function edit($id)
    {
        $data=DB::table('users')->where('id',$id)->first();
        return view('admin.customer.edit',compact('data'));
    }
    //update method
    public function update(Request $request)
    {
        $data=array(
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
        );
        DB::table('users')->where('id',$request->id)->update($data);
        return response()->json('successful updated!');
    }


    //delete method
    public function destroy($id)
    {
        DB::table('users')->where('id',$id)->update(['status'=>0]);
        return response()->json('successful Deactive!');
    }
    //Active method
    public function Active($id)
    {
        DB::table('users')->where('id',$id)->update(['status'=>1]);
        return response()->json('successful Active!');
    }
}
