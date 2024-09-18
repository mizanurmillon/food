<?php

namespace App\Http\Controllers\Admin\Hrm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Admin\Designation;
use App\Models\Admin\Department;
use DataTables;
use Illuminate\Support\Str;

class DesignationController extends Controller
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
            $data=Designation::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('designation.delete',[$row->id]).'" class="m-1" id="designation_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true); 
        }
       return view('admin.hrm.employee.designation.index');
    }
    //store method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'designation_name' => 'required|max:255',
        ]);
        $data=array();
        $data['designation_name']=$request->designation_name;
        DB::table('designations')->insert($data);
        return response()->json('successful inserted!');
    }
    //edit method
    public function edit($id)
    {
       $data=DB::table('designations')->where('id',$id)->first();
       return view('admin.hrm.employee.designation.edit',compact('data'));
    }
    //update method
    public function update(Request $request)
    {
        $data=array();
        $data['designation_name']=$request->designation_name;
        DB::table('designations')->where('id',$request->id)->update($data);
        return response()->json('successful updated!');
    }
    //delete method
    public function destroy($id)
    {
        DB::table('designations')->where('id',$id)->delete();
        return response()->json('successful deleted!');
    }

   // Department Start
        //Department index method
    public function indexDepartment(Request $request)
    {
        if ($request->ajax()) {
            $data=Department::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionBtn='
                    <a href="javascript:void(0)" data-id="'.$row->id.'" class="m-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit text-primary"></i></a>
                    <a href="'.route('delete.department',[$row->id]).'" class="m-1" id="department_delete"><i class="fa fa-trash text-danger"></i></a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true); 
        }
       return view('admin.hrm.employee.department.index');
    }

    //Department store
    public function storeDepartment(Request $request)
    {
        $validated = $request->validate([
            'department_name' => 'required|max:255',
        ]);
        $data=array();
        $data['department_name']=$request->department_name;
        DB::table('departments')->insert($data);
        return response()->json('successful inserted!');
    }
    //Department edit
    public function editDepartment($id)
    {
        $data=DB::table('departments')->where('id',$id)->first();
        return view('admin.hrm.employee.department.edit',compact('data'));
    }
    //Department Update
    public function updateDepartment(Request $request)
    {
        $data=array();
        $data['department_name']=$request->department_name;
        DB::table('departments')->where('id',$request->id)->update($data);
        return response()->json('successful updated!');
    }
    //Department delete
    public function destroyDepartment($id)
    {
       DB::table('departments')->where('id',$id)->delete();
       return response()->json('successful deleted!');
    }
}
